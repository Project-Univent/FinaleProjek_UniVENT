<?php
session_start();
require "../config/koneksi.php";

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    header("Location: login.php?error=1");
    exit;
}

/* ================= ADMIN ================= */
$stmt = $conn->prepare(
    "SELECT id_admin AS id, username AS nama, password
     FROM admin WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['admin_id']   = $user['id'];
    $_SESSION['admin_nama'] = $user['nama'];

    header("Location: ../admin/dashboard.php");
    exit;
}

/* ================= PANITIA ================= */
$stmt = $conn->prepare(
    "SELECT id_panitia AS id, username AS nama, password
     FROM panitia WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['panitia_id']   = $user['id'];
    $_SESSION['panitia_nama'] = $user['nama'];

    header("Location: ../panitia/dashboard.php");
    exit;
}

/* ================= PESERTA ================= */
$stmt = $conn->prepare(
    "SELECT id_peserta AS id, username AS nama, password
     FROM peserta WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['peserta_id']   = $user['id'];
    $_SESSION['peserta_nama'] = $user['nama'];

    header("Location: ../peserta/dashboard.php");
    exit;
}

/* ================= GAGAL ================= */
header("Location: login.php?error=1");
exit;

