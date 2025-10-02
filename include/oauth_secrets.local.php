<?php
// Local overrides for Google OAuth credentials (do not commit real secrets)
// Paste your actual Client ID and Client Secret from Google Cloud Console > Credentials.

define('GOOGLE_CLIENT_ID', '375118041490-9gh5vfl3u6k3ql4c3a7v09f6fn2tbu78.apps.googleusercontent.com');
// IMPORTANT: Replace the placeholder below with your real Client secret
// from Google Console (not the client ID). Leaving a placeholder will keep
// OAuth disabled until you paste the correct secret.
define('GOOGLE_CLIENT_SECRET', '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');

// Must exactly match the Authorized redirect URI configured in Google Console
define('GOOGLE_REDIRECT_URI', 'http://localhost/Hope4PetsOnlinePetAdoptionandRehomingSystem/api/google_oauth_callback.php');

?>
