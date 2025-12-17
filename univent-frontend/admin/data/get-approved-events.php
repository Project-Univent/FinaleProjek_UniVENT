<?php
session_start();
require "../../config/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo json_encode(["error" => "Unauthorized"]);
  exit;
}

$sql = "
  SELECT
    id_event AS id,
    nama_event AS nama,
    tanggal_event AS tanggal,
    lokasi
  FROM event
  WHERE status = 'approved'
  ORDER BY tanggal_event DESC
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
