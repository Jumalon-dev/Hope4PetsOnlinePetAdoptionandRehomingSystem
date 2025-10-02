<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../include/oauth_config.php';

$clientId = defined('GOOGLE_CLIENT_ID') ? GOOGLE_CLIENT_ID : '375118041490-9gh5vfl3u6k3ql4c3a7v09f6fn2tbu78.apps.googleusercontent.com';
$secretSet = defined('GOOGLE_CLIENT_SECRET') && GOOGLE_CLIENT_SECRET !== '375118041490-9gh5vfl3u6k3ql4c3a7v09f6fn2tbu78.apps.googleusercontent.com';
$redirect = defined('GOOGLE_REDIRECT_URI') ? GOOGLE_REDIRECT_URI : '';

$maskedClient = $clientId ? substr($clientId, 0, 8) . '...' . substr($clientId, -12) : '';

$diag = [
  'configured' => google_oauth_is_configured(),
  'client_id_masked' => $maskedClient,
  'client_secret_set' => $secretSet,
  'client_secret_suspect' => ($secretSet && $clientId && GOOGLE_CLIENT_SECRET === $clientId),
  'redirect_uri' => $redirect,
  'auth_url_preview' => (function() {
      if (!google_oauth_is_configured()) return null;
      $params = [
          'client_id' => GOOGLE_CLIENT_ID,
          'redirect_uri' => GOOGLE_REDIRECT_URI,
          'response_type' => 'code',
          'scope' => 'openid email profile',
          'access_type' => 'offline',
          'include_granted_scopes' => 'true',
          'state' => 'example_state',
          'prompt' => 'select_account',
      ];
      return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
  })(),
];

echo json_encode($diag, JSON_PRETTY_PRINT);
