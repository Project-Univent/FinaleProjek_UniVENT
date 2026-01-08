<?php
session_start();
require "../config/koneksi.php";
require "../classes/panitia.php";

$id_panitia = $_SESSION['user_id'] ?? null;
if (!$id_panitia) {
  die("Panitia tidak valid");
}

// data form
$data = [
  'nama_event'    => $_POST['nama_event'],
  'deskripsi'     => $_POST['deskripsi'],
  'tanggal_event' => $_POST['tanggal_event'],
  'waktu_mulai'   => $_POST['waktu_mulai'],
  'lokasi'        => $_POST['lokasi'],
  'kuota'         => $_POST['kuota'],
  'id_kategori'   => $_POST['id_kategori']
];

// oop
$panitia = new Panitia($conn, $id_panitia);
$panitia->buatEvent($data, $_FILES);

header("Location: ../panitia/status-acara.php");
exit;
