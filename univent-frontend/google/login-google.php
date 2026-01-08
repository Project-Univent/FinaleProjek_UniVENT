<?php
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/credentials.json');
$client->setRedirectUri('https://univent.web.id/google/callback.php');
$client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
$client->setAccessType('offline');
$client->setPrompt('consent');

header('Location: ' . $client->createAuthUrl());
exit;
