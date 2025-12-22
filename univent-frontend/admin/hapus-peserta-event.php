<?php
$required_role = 'admin';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

$id_tiket = $_POST['id_tiket'] ?? null;
$id_event = $_POST['event'] ?? null;

if (!$id_tiket || !$id_event) {
  die("Aksi tidak valid");
}

$stmt = $conn->prepare("DELETE FROM tiket WHERE id_tiket = ?");
$stmt->bind_param("i", $id_tiket);
$stmt->execute();

header("Location: peserta-event.php?event=" . $id_event);
exit;
