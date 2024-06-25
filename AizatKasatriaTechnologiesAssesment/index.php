<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
require_once 'vendor/autoload.php';

session_start();

// Initialize Google Client
$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/client_secret.json');
//$client->setRedirectUri('http://localhost/AizatKasatriaTechnologiesAssesment/google-callback.php');
$client->setRedirectUri('https://d9a3-2001-f40-970-201d-895d-ac0d-5c96-1a58.ngrok-free.app/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

// Generate Auth URL
$authUrl = $client->createAuthUrl();

echo '<a href="' . htmlspecialchars($authUrl) . '">Login with Googleaaa</a>';
?>
