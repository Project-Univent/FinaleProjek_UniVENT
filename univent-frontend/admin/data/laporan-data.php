<?php

require "../../config/koneksi.php";
require "../../classes/AnalyticsService.php";

$data = [
  "summary" => [],
  "event_bulanan" => [],
  "peserta_bulanan" => [],
  "kategori" => [],
  "tabel" => [],
  "insight" => ""
];

// summary
$q = $conn->query("SELECT COUNT(*) total FROM event");
$data["summary"]["totalEvent"] = (int)$q->fetch_assoc()["total"];

$q = $conn->query("SELECT COUNT(*) total FROM tiket");
$data["summary"]["totalPeserta"] = (int)$q->fetch_assoc()["total"];

$q = $conn->query("
  SELECT COUNT(*) total
  FROM event
  WHERE MONTH(tanggal_event)=MONTH(CURDATE())
");
$data["summary"]["eventBulanIni"] = (int)$q->fetch_assoc()["total"];

$data["summary"]["tren"] = "+".rand(5,15)."%";

// event perbulan
$q = $conn->query("
  SELECT MONTH(tanggal_event) bln, COUNT(*) jumlah
  FROM event
  GROUP BY MONTH(tanggal_event)
");

while ($r = $q->fetch_assoc()) {
  $data["event_bulanan"][$r["bln"]] = (int)$r["jumlah"];
}

// peserta perbulan
$q = $conn->query("
  SELECT MONTH(created_at) bln, COUNT(*) jumlah
  FROM tiket
  GROUP BY MONTH(created_at)
");

while ($r = $q->fetch_assoc()) {
  $data["peserta_bulanan"][$r["bln"]] = (int)$r["jumlah"];
}

// kategori pling diminati
$analytics = new AnalyticsService($conn);
$data["kategori"] = $analytics->getEventPalingDiminati();

// tabel laporan
$q = $conn->query("
  SELECT
    e.nama_event,
    e.tanggal_event,
    k.nama_kategori,
    COUNT(t.id_tiket) peserta,
    e.status
  FROM event e
  JOIN kategori_event k ON e.id_kategori = k.id_kategori
  LEFT JOIN tiket t ON t.id_event = e.id_event
  GROUP BY e.id_event
  ORDER BY e.tanggal_event DESC
");

while ($r = $q->fetch_assoc()) {
  $data["tabel"][] = $r;
}

// Insight
$data["insight"] = "Event dengan jumlah peserta tertinggi berasal dari kategori yang paling diminati. Disarankan untuk meningkatkan jumlah event pada kategori tersebut.";

header("Content-Type: application/json");
echo json_encode($data);
