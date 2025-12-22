<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';
require '../config/koneksi.php';

$id_event = $_GET['id'] ?? null;
if (!$id_event || !is_numeric($id_event)) {
  die('ID event tidak valid');
}

if (!isset($_SESSION['google_token'])) {
  header("Location: login-google.php");
  exit;
}

/* ambil data event */
$stmt = $conn->prepare("
  SELECT nama_event, tanggal_event, waktu_mulai, lokasi
  FROM event
  WHERE id_event = ?
");
$stmt->bind_param("i", $id_event);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

if (!$event) {
  die('Event tidak ditemukan');
}

$start = $event['tanggal_event'] . ' ' . ($event['waktu_mulai'] ?? '08:00');
$end   = date('Y-m-d H:i:s', strtotime($start . ' +2 hours'));

$client = new Google_Client();
$client->setAccessToken($_SESSION['google_token']);

$service = new Google_Service_Calendar($client);

$gEvent = new Google_Service_Calendar_Event([
  'summary' => $event['nama_event'],
  'location' => $event['lokasi'],
  'start' => [
    'dateTime' => date('c', strtotime($start)),
    'timeZone' => 'Asia/Jakarta',
  ],
  'end' => [
    'dateTime' => date('c', strtotime($end)),
    'timeZone' => 'Asia/Jakarta',
  ],
  'reminders' => [
    'useDefault' => false,
    'overrides' => [
      ['method' => 'popup', 'minutes' => 60],
      ['method' => 'email', 'minutes' => 1440],
    ],
  ],
]);

$service->events->insert('primary', $gEvent);

header("Location: ../peserta/event-diikuti.php?id=$id_event&calendar=success");
exit;
