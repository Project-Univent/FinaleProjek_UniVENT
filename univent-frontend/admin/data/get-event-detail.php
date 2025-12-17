<?php
session_start();
require "../../config/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo json_encode(["error" => "Unauthorized"]);
  exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
  http_response_code(400);
  echo json_encode(["error" => "ID event tidak ada"]);
  exit;
}

$sql = "
  SELECT
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.waktu_mulai,
    e.lokasi,
    e.kuota,
    e.deskripsi,
    e.status,
    k.nama_kategori,
    p.username AS panitia_username,
    p.email AS panitia_email
  FROM event e
  JOIN kategori_event k ON e.id_kategori = k.id_kategori
  JOIN panitia p ON e.id_panitia = p.id_panitia
  WHERE e.id_event = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  http_response_code(404);
  echo json_encode(["error" => "Event tidak ditemukan"]);
  exit;
}

echo json_encode($result->fetch_assoc());
