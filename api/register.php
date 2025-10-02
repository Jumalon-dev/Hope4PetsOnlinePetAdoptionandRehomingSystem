<?php
session_start();
require_once __DIR__ . '/../include/db_connection.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '' || $password === '') {
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-register.php?error=' . urlencode('All fields are required.'));
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-register.php?error=' . urlencode('Invalid email address.'));
  exit;
}

// Check if email exists
$stmt = $conn->prepare('SELECT user_id FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
  $stmt->close();
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-register.php?error=' . urlencode('Email already registered.'));
  exit;
}
$stmt->close();

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$role = 'adopter';
$status = 'active';

$stmt = $conn->prepare('INSERT INTO users (name, email, password_hash, role, status) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('sssss', $name, $email, $passwordHash, $role, $status);
if (!$stmt->execute()) {
  $stmt->close();
  header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/authentication-register.php?error=' . urlencode('Failed to create account.'));
  exit;
}
$userId = $stmt->insert_id;
$stmt->close();

// Auto-login after registration
$_SESSION['user_id'] = (int)$userId;
$_SESSION['user_name'] = $name;
$_SESSION['user_email'] = $email;
$_SESSION['auth_provider'] = 'local';

header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/pages_2/admin-dashboard.php');
exit;
