<?php
$required_role = 'admin';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";
require "../classes/AnalyticsService.php";

$analytics = new AnalyticsService($conn);
$analytics->exportCSV();
