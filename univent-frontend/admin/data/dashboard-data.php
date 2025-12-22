<?php
require "../../config/koneksi.php";
require "../../classes/AnalyticsService.php";

/* =====================
   INIT RESPONSE
===================== */
$data = [
  "stats" => [
    "totalEvent" => 0,
    "totalPeserta" => 0,
    "totalVerified" => 0
  ],
  "kategori" => [],
  "time_series" => [],
  "analytics" => []
];

/* =====================
   SUMMARY
===================== */

// total event
$q = $conn->query("SELECT COUNT(*) AS total FROM event");
$data["stats"]["totalEvent"] = (int) $q->fetch_assoc()["total"];

// total event approved
$q = $conn->query("SELECT COUNT(*) AS total FROM event WHERE status = 'approved'");
$data["stats"]["totalVerified"] = (int) $q->fetch_assoc()["total"];

// total peserta (dari tiket)
$q = $conn->query("SELECT COUNT(*) AS total FROM tiket");
$data["stats"]["totalPeserta"] = (int) $q->fetch_assoc()["total"];


/* =====================
   EVENT PER KATEGORI
===================== */
$q = $conn->query("
  SELECT 
    k.nama_kategori,
    COUNT(e.id_event) AS total_event
  FROM kategori_event k
  LEFT JOIN event e 
    ON e.id_kategori = k.id_kategori
  GROUP BY k.id_kategori
");

while ($row = $q->fetch_assoc()) {
  $data["kategori"][] = $row;
}


/* =====================
   ANALITIK:
   EVENT PALING DIMINATI
===================== */
$analyticsService = new AnalyticsService($conn);
$data["analytics"] = $analyticsService->getEventPalingDiminati();


/* =====================
   REGISTRASI PESERTA PER TANGGAL
   (BERDASARKAN TIKET)
===================== */
$q = $conn->query("
  SELECT 
    DATE(created_at) AS tanggal,
    COUNT(*) AS jumlah
  FROM tiket
  GROUP BY DATE(created_at)
  ORDER BY tanggal
");

while ($row = $q->fetch_assoc()) {
  $data["time_series"][] = $row;
}


/* =====================
   OUTPUT JSON
===================== */
header("Content-Type: application/json");
echo json_encode($data);
