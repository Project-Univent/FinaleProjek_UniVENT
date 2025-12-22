<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";
require "../classes/peserta.php";

/* =========================
   VALIDASI SESSION & INPUT
========================= */
$id_peserta = $_SESSION['user_id'] ?? null;
$id_event   = $_GET['id'] ?? null;

if (!$id_peserta || !$id_event || !is_numeric($id_event)) {
  die("Data tidak valid");
}

/* =========================
   PROSES DAFTAR EVENT
========================= */
$peserta = new Peserta($conn, $id_peserta);
$result  = $peserta->daftarEvent((int)$id_event);

/* =========================
   HANDLE HASIL
========================= */
if ($result === "SUKSES") {
  header("Location: event-diikuti.php");
  exit;
}

if ($result === "SUDAH_DAFTAR") {
  header("Location: event-diikuti.php");
  exit;
}

if ($result === "KUOTA_PENUH") {
  die("Kuota event sudah penuh");
}

if ($result === "EVENT_TIDAK_VALID") {
  die("Event tidak ditemukan atau belum disetujui");
}

die("Terjadi kesalahan");
