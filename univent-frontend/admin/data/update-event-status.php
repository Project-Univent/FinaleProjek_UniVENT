<?php
session_start();
require "../../config/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo json_encode(["error" => "Unauthorized"]);
  exit;
}

$id_event = $_POST['id_event'] ?? null;
$status   = $_POST['status'] ?? null;
$catatan  = $_POST['catatan'] ?? null;
$id_admin = $_SESSION['admin_id'] ?? null;

if (!$id_event || !$status) {
  http_response_code(400);
  echo json_encode(["error" => "Data tidak lengkap"]);
  exit;
}

if (!in_array($status, ['disetujui', 'ditolak'])) {
  http_response_code(400);
  echo json_encode(["error" => "Status tidak valid"]);
  exit;
}

$sql = "
  UPDATE event
  SET status = ?, catatan_admin = ?, id_admin = ?
  WHERE id_event = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $status, $catatan, $id_admin, $id_event);

if ($stmt->execute()) {
  echo json_encode(["success" => true]);
} else {
  http_response_code(500);
  echo json_encode(["error" => "Gagal update event"]);
}
