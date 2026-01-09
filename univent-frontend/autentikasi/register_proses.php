<?php
session_start();

require "../config/koneksi.php";
require "../classes/auth.php";

$fullname = $_POST['fullname'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($fullname === '' || $email === '' || $password === '') {
  header("Location: register.php?error=1");
  exit;
}

// cek duplikat username / email
$cek = $conn->prepare(
  "SELECT id_peserta FROM peserta WHERE username = ? OR email = ?"
);
$cek->bind_param("ss", $fullname, $email);
$cek->execute();
$cek->store_result();

if ($cek->num_rows > 0) {
  header("Location: register.php?error=duplicate");
  exit;
}

$auth = new Auth($conn);
$auth->registerPeserta($fullname, $email, $password);

header("Location: login.php?register=success");
exit;
