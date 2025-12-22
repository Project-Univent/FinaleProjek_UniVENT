<?php
session_start();
require "../../config/koneksi.php";

header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo json_encode([]);
  exit;
}

$sql = "
  SELECT id_event, nama_event, created_at
  FROM event
  WHERE status = 'pending'
  ORDER BY created_at DESC
  LIMIT 10
";

$res = $conn->query($sql);

$data = [];
while ($row = $res->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
