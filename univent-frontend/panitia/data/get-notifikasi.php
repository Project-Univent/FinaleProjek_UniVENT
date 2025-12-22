<?php
session_start();
require "../../config/koneksi.php";

header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'panitia') {
  echo json_encode([]);
  exit;
}

$idPanitia = $_SESSION['user_id'];

$sql = "
  SELECT title, message, created_at
  FROM notifikasi
  WHERE user_role = 'panitia'
    AND user_id = ?
  ORDER BY created_at DESC
  LIMIT 10
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idPanitia);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$data = [];
while ($row = mysqli_fetch_assoc($res)) {
  $data[] = $row;
}

echo json_encode($data);
