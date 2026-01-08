<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit;
}

require '../config/koneksi.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="laporan_event.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, ['Nama Event', 'Tanggal', 'Kategori', 'Peserta', 'Status']);

$query = "
SELECT
  e.nama_event,
  e.tanggal_event,
  k.nama_kategori,
  COUNT(t.id_tiket) AS peserta,
  e.status
FROM event e
LEFT JOIN kategori_event k
  ON e.id_kategori = k.id_kategori
LEFT JOIN tiket t
  ON t.id_event = e.id_event
GROUP BY e.id_event
ORDER BY e.tanggal_event DESC
";


$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
