<?php
session_start();
require "../../config/koneksi.php";

header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo json_encode(["count" => 0]);
  exit;
}

$sql = "SELECT COUNT(*) AS total FROM event WHERE status = 'pending'";
$res = $conn->query($sql);
$row = $res->fetch_assoc();

echo json_encode([
  "count" => (int)$row['total']
]);
