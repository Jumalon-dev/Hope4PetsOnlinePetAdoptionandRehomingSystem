<?php
session_start();
require_once __DIR__ . '/../include/db_connection.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-login.php?error=' . urlencode('Email and password are required.'));
  exit;
}

$stmt = $conn->prepare('SELECT user_id, name, email, password_hash, role, status FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-login.php?error=' . urlencode('Invalid credentials.'));
  exit;
}

if (!password_verify($password, $user['password_hash'])) {
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-login.php?error=' . urlencode('Invalid credentials.'));
  exit;
}

if ($user['status'] !== 'active') {
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-login.php?error=' . urlencode('Account is not active.'));
  exit;
}

$_SESSION['user_id'] = (int)$user['user_id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['auth_provider'] = 'local';

header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/admin-dashboard.php');
exit;
