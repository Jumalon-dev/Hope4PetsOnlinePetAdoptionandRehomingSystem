<?php
session_start();
require_once __DIR__ . '/../include/oauth_config.php';

if (!google_oauth_is_configured()) {
    http_response_code(500);
    $diagUrl = '/Hope4PetsOnlinePetAdoptionandRehomingSystem/api/oauth_diag.php';
    $reasons = function_exists('google_oauth_config_errors') ? google_oauth_config_errors() : [];
    echo 'Google OAuth is not configured. Please set GOOGLE_CLIENT_ID/SECRET and REDIRECT in include/oauth_config.php';
    if (!empty($reasons)) {
        echo '<br>Problems detected:';
        echo '<ul>';
        foreach ($reasons as $r) {
            echo '<li>' . htmlspecialchars($r) . '</li>';
        }
        echo '</ul>';
    }
    echo '<br>See diagnostics: <a href="' . htmlspecialchars($diagUrl) . '">' . htmlspecialchars($diagUrl) . '</a>';
    exit;
}

// Generate a CSRF state token
$state = bin2hex(random_bytes(16));
$_SESSION['oauth2_state'] = $state;

$params = [
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => 'openid email profile',
    'access_type' => 'offline',
    'include_granted_scopes' => 'true',
    'state' => $state,
    // optional: prompt to ensure account chooser
    'prompt' => 'select_account',
];

$authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
header('Location: ' . $authUrl);
exit;
