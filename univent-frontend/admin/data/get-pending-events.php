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
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.lokasi
  FROM event e
  WHERE e.status = 'pending'
  ORDER BY e.tanggal_event DESC
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
