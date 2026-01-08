<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/credentials.json');
$client->setRedirectUri('https://univent.web.id/google/callback.php');
$client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
$client->setAccessType('offline');
$client->setPrompt('consent');

// code redirect dari Google
if (!isset($_GET['code'])) {
    exit('Google auth gagal: code tidak ada');
}

// tukar code → token
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    exit('Error token Google: ' . $token['error']);
}

$_SESSION['google_token'] = $token;

header('Location: ../peserta/event-diikuti.php');
exit;
