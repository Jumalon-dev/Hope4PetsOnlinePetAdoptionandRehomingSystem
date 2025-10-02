<?php
session_start();
require_once __DIR__ . '/../include/db_connection.php';
require_once __DIR__ . '/../include/oauth_config.php';

function http_post_form_curl(string $url, array $data): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 20,
    ]);
    $body = curl_exec($ch);
    $err = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ['code' => $code, 'body' => $body, 'error' => $err];
}

function http_get_bearer_curl(string $url, string $accessToken): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $accessToken],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 20,
    ]);
    $body = curl_exec($ch);
    $err = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ['code' => $code, 'body' => $body, 'error' => $err];
}

if (!google_oauth_is_configured()) {
    http_response_code(500);
    echo 'Google OAuth is not configured.';
    exit;
}

// Validate state
if (!isset($_GET['state']) || !isset($_SESSION['oauth2_state']) || $_GET['state'] !== $_SESSION['oauth2_state']) {
    http_response_code(400);
    echo 'Invalid OAuth state.';
    exit;
}
unset($_SESSION['oauth2_state']);

if (!isset($_GET['code'])) {
    http_response_code(400);
    echo 'Missing authorization code.';
    exit;
}

// Handle Google error callback
if (isset($_GET['error'])) {
    http_response_code(400);
    echo 'Authorization error: ' . htmlspecialchars($_GET['error']) . (isset($_GET['error_description']) ? ' - ' . htmlspecialchars($_GET['error_description']) : '');
    exit;
}

$code = $_GET['code'];

// Exchange code for tokens
$tokenResp = http_post_form_curl('https://oauth2.googleapis.com/token', [
    'code' => $code,
    'client_id' => GOOGLE_CLIENT_ID,
    'client_secret' => GOOGLE_CLIENT_SECRET,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'grant_type' => 'authorization_code',
]);

if ($tokenResp['error']) {
    http_response_code(502);
    echo 'Token request failed (cURL): ' . htmlspecialchars($tokenResp['error']);
    exit;
}

$tokenData = json_decode($tokenResp['body'] ?? '', true);
if ($tokenResp['code'] !== 200 || !is_array($tokenData) || !isset($tokenData['access_token'])) {
    http_response_code(400);
    echo 'Invalid token response: ' . htmlspecialchars($tokenResp['body'] ?? '') . ' (HTTP ' . (int)$tokenResp['code'] . ')';
    exit;
}

$accessToken = $tokenData['access_token'];

// Get user info
$uiResp = http_get_bearer_curl('https://www.googleapis.com/oauth2/v3/userinfo', $accessToken);
if ($uiResp['error']) {
    http_response_code(502);
    echo 'Failed to fetch user info (cURL): ' . htmlspecialchars($uiResp['error']);
    exit;
}

$userinfo = json_decode($uiResp['body'] ?? '', true);
if ($uiResp['code'] !== 200 || !is_array($userinfo) || empty($userinfo['email'])) {
    http_response_code(400);
    echo 'Invalid user info response: ' . htmlspecialchars($uiResp['body'] ?? '') . ' (HTTP ' . (int)$uiResp['code'] . ')';
    exit;
}

$googleId = $userinfo['sub'] ?? null;
$email = $userinfo['email'];
$name = $userinfo['name'] ?? ($userinfo['given_name'] ?? 'Google User');

// Upsert user
// Ensure users table can store google_id and nullable password_hash
$checkColumns = $conn->query("SHOW COLUMNS FROM users LIKE 'google_id'");
if ($checkColumns && $checkColumns->num_rows === 0) {
    // Add google_id column and make password_hash nullable for social accounts
    $conn->query("ALTER TABLE users ADD COLUMN google_id varchar(64) DEFAULT NULL");
    $conn->query("ALTER TABLE users MODIFY password_hash varchar(255) NULL");
}
// Ensure a unique index on google_id (allowing multiple NULLs is fine)
$idxRes = $conn->query("SHOW INDEX FROM users WHERE Key_name = 'idx_users_google_id'");
if ($idxRes && $idxRes->num_rows === 0) {
    $conn->query("CREATE UNIQUE INDEX idx_users_google_id ON users(google_id)");
}

// Find existing user by google_id or email
$stmt = $conn->prepare("SELECT user_id, name, email, role, status FROM users WHERE google_id = ? OR email = ? LIMIT 1");
$stmt->bind_param('ss', $googleId, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $userId = (int)$row['user_id'];
    // If existing by email but no google_id, attach it
    if (!empty($googleId)) {
        $stmtUpd = $conn->prepare("UPDATE users SET google_id = ? WHERE user_id = ? AND (google_id IS NULL OR google_id = '')");
        $stmtUpd->bind_param('si', $googleId, $userId);
        $stmtUpd->execute();
        $stmtUpd->close();
    }
} else {
    // Create minimal user with default role 'adopter'
    $role = 'adopter';
    $status = 'active';
    $stmtIns = $conn->prepare("INSERT INTO users(name, email, password_hash, role, status, google_id) VALUES(?, ?, NULL, ?, ?, ?)");
    $stmtIns->bind_param('sssss', $name, $email, $role, $status, $googleId);
    $stmtIns->execute();
    $userId = $stmtIns->insert_id;
    $stmtIns->close();
}
$stmt->close();

// Start session
$_SESSION['user_id'] = $userId;
$_SESSION['user_name'] = $name;
$_SESSION['user_email'] = $email;
$_SESSION['auth_provider'] = 'google';

// Redirect to dashboard/home - derive base path from configured redirect URI
$u = parse_url(GOOGLE_REDIRECT_URI);
$path = $u['path'] ?? '/';
// remove trailing '/api/google_oauth_callback.php'
$base = rtrim(str_replace('/api/google_oauth_callback.php', '', $path), '/');
if ($base === '') { $base = '/'; }
header('Location: ' . $base . '/pages_2/admin-dashboard.php');
exit;
