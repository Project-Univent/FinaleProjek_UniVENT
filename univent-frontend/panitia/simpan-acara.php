<?php
session_start();
require "../config/koneksi.php";

$id_panitia = $_SESSION['user_id'];

$nama   = $_POST['nama_event'];
$desk   = $_POST['deskripsi'];
$tgl    = $_POST['tanggal_event'];
$waktu  = $_POST['waktu_mulai'];
$lokasi = $_POST['lokasi'];
$kuota  = $_POST['kuota'];
$id_kat = $_POST['id_kategori'];

$posterName = null;
if (!empty($_FILES['poster']['name'])) {
  $posterName = time() . '_' . $_FILES['poster']['name'];

  $targetDir = __DIR__ . "/../assets/img/";
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
  }

  move_uploaded_file(
    $_FILES['poster']['tmp_name'],
    $targetDir . $posterName
  );
}

$sql = "
INSERT INTO event (
  id_panitia,
  id_kategori,
  nama_event,
  deskripsi,
  tanggal_event,
  waktu_mulai,
  lokasi,
  kuota,
  poster,
  status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
  $stmt,
  "iisssssis",
  $id_panitia,
  $id_kat,
  $nama,
  $desk,
  $tgl,
  $waktu,
  $lokasi,
  $kuota,
  $posterName
);

mysqli_stmt_execute($stmt);

header("Location: ../panitia/status-acara.php");
exit;



