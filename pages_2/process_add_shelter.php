<?php
// Handle Add Shelter form submission
// Ensure user is authenticated and no output is sent before redirects
include __DIR__ . '/../include/auth_guard.php';
require_once __DIR__ . '/../include/db_connection.php';

function redirect_back(string $query): void {
    header('Location: ./shelter.php' . ($query !== '' ? ('?' . $query) : ''));
    exit;
}

function redirect_error(string $msg): void {
    redirect_back('error=' . urlencode($msg));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_back('');
}

// Collect and validate input
$name = trim($_POST['name'] ?? '');
$location = trim($_POST['location'] ?? '');
$contact_info = trim($_POST['contact_info'] ?? '');
$verification_status = $_POST['verification_status'] ?? 'pending';

if ($name === '' || mb_strlen($name) > 150) {
    redirect_error('Invalid name.');
}
if ($location !== '' && mb_strlen($location) > 255) {
    redirect_error('Invalid location.');
}
if ($contact_info !== '' && mb_strlen($contact_info) > 255) {
    redirect_error('Invalid contact info.');
}
$allowed_status = ['pending', 'verified', 'rejected'];
if (!in_array($verification_status, $allowed_status, true)) {
    $verification_status = 'pending';
}

try {
    // Use mysqli connection from db_connection.php
    if (isset($conn) && $conn instanceof mysqli) {
        $stmt = $conn->prepare(
            'INSERT INTO shelters (name, location, contact_info, verification_status)
             VALUES (?, ?, ?, ?)'
        );
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $loc = ($location !== '' ? $location : null);
        $contact = ($contact_info !== '' ? $contact_info : null);
        $stmt->bind_param('ssss', $name, $loc, $contact, $verification_status);
        $stmt->execute();
        if ($stmt->errno) {
            throw new Exception($stmt->error);
        }
        $stmt->close();
    } else {
        redirect_error('Database connection not initialized.');
    }

    redirect_back('success=1');
} catch (Throwable $e) {
    // TODO: log error $e->getMessage()
    redirect_error('Database error.');
}
