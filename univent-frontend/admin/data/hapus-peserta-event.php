<?php
require "../../config/koneksi.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$id_event   = $data['id_event'] ?? null;
$id_peserta = $data['id_peserta'] ?? null;

if (!$id_event || !$id_peserta) {
  echo json_encode(["success" => false]);
  exit;
}

$stmt = $conn->prepare("
  DELETE FROM tiket
  WHERE id_event = ? AND id_peserta = ?
");

$stmt->bind_param("ii", $id_event, $id_peserta);

echo json_encode([
  "success" => $stmt->execute()
]);
