<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../config/env.php';

$client = new Google_Client();

$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

if (!isset($_GET['code'])) {
    die('Google auth gagal');
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    die('Error token Google');
}

$_SESSION['google_token'] = $token;

header('Location: ../peserta/event-diikuti.php');
exit;
