<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit;
}

require '../config/koneksi.php';
require '../classes/AnalyticsService.php';

$analytics = new AnalyticsService($conn);

$analytics->exportCSV();
