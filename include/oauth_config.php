<?php
// Google OAuth 2.0 configuration
// 1) Create OAuth credentials at https://console.cloud.google.com/apis/credentials
// 2) Set Authorized redirect URI to the value below (GOOGLE_REDIRECT_URI)
// 3) Fill in your Client ID and Client Secret

// IMPORTANT: Update these values for your environment.
// Example redirect for XAMPP on Windows (no spaces in folder name):
// http://localhost/Hope4PetsOnlinePetAdoptionandRehomingSystem/api/google_oauth_callback.php

// Optional: load local secrets override if present (do not commit this file)
$__secrets = __DIR__ . '/oauth_secrets.local.php';
if (file_exists($__secrets)) {
    require_once $__secrets;
}

// Helper: define from environment if available
if (!function_exists('__def_from_env')) {
    function __def_from_env(string $const, string $envKey): void {
        if (!defined($const)) {
            $v = getenv($envKey);
            if ($v !== false && $v !== '') {
                define($const, $v);
            }
        }
    }
}

// Attempt to source from environment
__def_from_env('GOOGLE_CLIENT_ID', 'GOOGLE_CLIENT_ID');
__def_from_env('GOOGLE_CLIENT_SECRET', 'GOOGLE_CLIENT_SECRET');
__def_from_env('GOOGLE_REDIRECT_URI', 'GOOGLE_REDIRECT_URI');

// Fallback defaults (empty until set via env or local secrets)
if (!defined('GOOGLE_CLIENT_ID')) {
    define('GOOGLE_CLIENT_ID', '');
}
if (!defined('GOOGLE_CLIENT_SECRET')) {
    define('GOOGLE_CLIENT_SECRET', '');
}
if (!defined('GOOGLE_REDIRECT_URI')) {
    define('GOOGLE_REDIRECT_URI', 'http://localhost/Hope4PetsOnlinePetAdoptionandRehomingSystem/api/google_oauth_callback.php');
}

function google_oauth_is_configured(): bool {
    // Client ID/Secret must be non-empty and redirect must be http(s)
    $redirectOk = stripos(GOOGLE_REDIRECT_URI, 'http://') === 0 || stripos(GOOGLE_REDIRECT_URI, 'https://') === 0;
    $clientOk = GOOGLE_CLIENT_ID !== '';
    $secretOk = GOOGLE_CLIENT_SECRET !== '' && GOOGLE_CLIENT_SECRET !== GOOGLE_CLIENT_ID;
    return $clientOk && $secretOk && $redirectOk;
}

// Optional helper to explain why configuration is invalid
function google_oauth_config_errors(): array {
    $errors = [];
    if (GOOGLE_CLIENT_ID === '') {
        $errors[] = 'GOOGLE_CLIENT_ID is empty';
    }
    if (GOOGLE_CLIENT_SECRET === '') {
        $errors[] = 'GOOGLE_CLIENT_SECRET is empty';
    } elseif (GOOGLE_CLIENT_SECRET === GOOGLE_CLIENT_ID) {
        $errors[] = 'GOOGLE_CLIENT_SECRET must not equal GOOGLE_CLIENT_ID (paste the actual secret)';
    }
    $redirect = GOOGLE_REDIRECT_URI;
    if (!($redirect && (stripos($redirect, 'http://') === 0 || stripos($redirect, 'https://') === 0))) {
        $errors[] = 'GOOGLE_REDIRECT_URI must start with http:// or https://';
    }
    return $errors;
}
