<?php
require_once __DIR__ . "/../config/koneksi.php";

$token   = $_POST['token'] ?? '';
$pw1     = $_POST['password'] ?? '';
$pw2     = $_POST['password_confirm'] ?? '';

if ($token === '' || $pw1 === '' || $pw2 === '') {
    header("Location: reset_password.php?error=empty");
    exit;
}

if ($pw1 !== $pw2) {
    header("Location: reset_password.php?error=notmatch&token=" . $token);
    exit;
}

/* === CEK TOKEN === */
$stmt = $conn->prepare(
    "SELECT id_peserta FROM peserta
     WHERE reset_token = ?
     AND reset_expired > NOW()"
);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: reset_password.php?error=invalid");
    exit;
}

$user = $result->fetch_assoc();

/* === UPDATE PASSWORD === */
$hash = password_hash($pw1, PASSWORD_DEFAULT);

$update = $conn->prepare(
    "UPDATE peserta
     SET password = ?, reset_token = NULL, reset_expired = NULL
     WHERE id_peserta = ?"
);
$update->bind_param("si", $hash, $user['id_peserta']);
$update->execute();

header("Location: login.php?reset=success");
exit;
