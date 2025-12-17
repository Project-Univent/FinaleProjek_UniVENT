<?php
require "../config/koneksi.php";
header('Content-Type: application/json');

// total event
$qTotal = $conn->query("SELECT COUNT(*) total FROM event");
$totalEvent = $qTotal->fetch_assoc()['total'];

// total peserta
$qPeserta = $conn->query("SELECT COUNT(*) total FROM peserta_event");
$totalPeserta = $qPeserta->fetch_assoc()['total'];

// total verified
$qVerified = $conn->query("SELECT COUNT(*) total FROM event WHERE status = 'approved'");
$totalVerified = $qVerified->fetch_assoc()['total'];

// event pending (buat admin ACC)
$qPending = $conn->query("
  SELECT id_event, judul, kategori, tanggal
  FROM event
  WHERE status = 'pending'
  ORDER BY created_at DESC
");

$pendingEvents = [];
while ($row = $qPending->fetch_assoc()) {
  $pendingEvents[] = $row;
}

echo json_encode([
  "stats" => [
    "totalEvent" => (int)$totalEvent,
    "totalPeserta" => (int)$totalPeserta,
    "totalVerified" => (int)$totalVerified
  ],
  "pendingEvents" => $pendingEvents
]);
