<?php
require "../../config/koneksi.php";
header("Content-Type: application/json");

$id_event = $_GET['event'] ?? null;
if (!$id_event) {
  echo json_encode([]);
  exit;
}

$stmt = $conn->prepare("
  SELECT
    p.id_peserta,
    p.username AS nama,
    p.email
  FROM tiket t
  JOIN peserta p ON t.id_peserta = p.id_peserta
  WHERE t.id_event = ?
  ORDER BY p.username ASC
");

$stmt->bind_param("i", $id_event);
$stmt->execute();

$result = $stmt->get_result();
echo json_encode($result->fetch_all(MYSQLI_ASSOC));
