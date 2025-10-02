<?php
// Simple session guard to protect authenticated pages
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /Hope4PetsOnlinePetAdoptionandRehomingSystem/admin/authentication-login.php');
    exit;
}
