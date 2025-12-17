<?php
require_once __DIR__ . "/../config/koneksi.php";

$fullname = $_POST['fullname'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($fullname === '' || $email === '' || $password === '') {
    header("Location: register.php?error=1");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO peserta (username, email, password)
     VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $fullname, $email, $hash);
$stmt->execute();

header("Location: ../autentikasi/login.php");
exit;

