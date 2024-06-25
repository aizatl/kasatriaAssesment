<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/client_secret.json');
$client->setRedirectUri('https://d9a3-2001-f40-970-201d-895d-ac0d-5c96-1a58.ngrok-free.app/google-callback.php'); // Update with your ngrok HTTPS URL
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    try {
        $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $accessToken = $client->getAccessToken();

        // You may store the access token in session for later use (e.g., making API requests)
        $_SESSION['access_token'] = $accessToken;

        // Get user info if needed
        $googleOAuth = new Google_Service_Oauth2($client);
        $userInfo = $googleOAuth->userinfo->get();

        // Example: Print user info
        echo '<pre>';
        var_dump($userInfo);
        echo '</pre>';

        // Example: Access specific user info
        echo 'Logged in as: ' . htmlspecialchars($userInfo->getEmail());

        // Example: Redirect to a logged-in page or perform other application logic
        // header('Location: /logged-in.php');
        // exit;

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid callback request. Please try again.';
}
?>
