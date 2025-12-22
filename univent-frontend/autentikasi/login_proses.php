<?php
session_start();
require "../config/koneksi.php";
require "../classes/auth.php"; // sesuaikan nama file (lowercase)

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
  header("Location: login.php?error=1");
  exit;
}

$auth = new Auth($conn);

// coba login berurutan: admin → panitia → peserta
$auth->login($email, $password, "admin",   "id_admin",   "../admin/dashboard.php",   "admin")
|| $auth->login($email, $password, "panitia","id_panitia","../panitia/dashboard.php", "panitia")
|| $auth->login($email, $password, "peserta","id_peserta","../peserta/dashboard.php", "peserta");

// kalau semua gagal
header("Location: login.php?error=1");
exit;
