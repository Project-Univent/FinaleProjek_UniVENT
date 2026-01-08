<?php
require_once __DIR__ . "/../config/koneksi.php";

$email = $_POST['email'] ?? '';

if ($email === '') {
    header("Location: lupa_password.php?error=empty");
    exit;
}

/* CEK EMAIL DI DATABASE */
$stmt = $conn->prepare(
    "SELECT id_peserta FROM peserta WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // email tidak ditemukan
    header("Location: lupa_password.php?error=notfound");
    exit;
}

/* GENERATE TOKEN RESET */
$token = bin2hex(random_bytes(32));
$expired = date("Y-m-d H:i:s", strtotime("+30 minutes"));

/* SIMPAN TOKEN*/
$update = $conn->prepare(
    "UPDATE peserta 
     SET reset_token = ?, reset_expired = ?
     WHERE email = ?"
);
$update->bind_param("sss", $token, $expired, $email);
$update->execute();

header("Location: reset_pw.php?token=" . $token);
exit;
