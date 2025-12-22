<?php
/* =====================
   INIT & CONFIG
===================== */
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

session_start();
require "../../config/koneksi.php";
require "../../config/env.php";
require $_SERVER['DOCUMENT_ROOT'] . "/FinalProjek/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* =====================
   VALIDASI ADMIN
===================== */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo json_encode(["success" => false, "error" => "Unauthorized"]);
  exit;
}

/* =====================
   AMBIL DATA POST
===================== */
$id_event = $_POST['id_event'] ?? null;
$status   = $_POST['status'] ?? null;
$catatan  = $_POST['catatan'] ?? null;

/* =====================
   VALIDASI INPUT
===================== */
if (!$id_event || !is_numeric($id_event)) {
  echo json_encode(["success" => false, "error" => "ID event tidak valid"]);
  exit;
}

$allowedStatus = ['pending', 'approved', 'rejected'];
if (!in_array($status, $allowedStatus)) {
  echo json_encode(["success" => false, "error" => "Status tidak valid"]);
  exit;
}

/* =====================
   UPDATE STATUS EVENT
===================== */
$stmt = $conn->prepare("
  UPDATE event
  SET status = ?, catatan_admin = ?
  WHERE id_event = ?
");
$stmt->bind_param("ssi", $status, $catatan, $id_event);

if (!$stmt->execute()) {
  echo json_encode(["success" => false, "error" => "Gagal update event"]);
  exit;
}

/* =====================
   AMBIL DATA PANITIA
===================== */
$q = "
  SELECT e.nama_event, p.id_panitia, p.email
  FROM event e
  JOIN panitia p ON e.id_panitia = p.id_panitia
  WHERE e.id_event = ?
";
$st = $conn->prepare($q);
$st->bind_param("i", $id_event);
$st->execute();
$data = $st->get_result()->fetch_assoc();

/* =====================
   KIRIM EMAIL + LOG
===================== */
if ($data) {
  $judul = "";
  $pesan = "";

  if ($status === 'approved') {
    $judul = "Event Disetujui";
    $pesan =
      "Halo Panitia,\n\n" .
      "Event \"{$data['nama_event']}\" TELAH DISETUJUI oleh admin.\n\n" .
      "Silakan lanjutkan persiapan acara.\n\n" .
      "– UniVENT";
  }

  if ($status === 'rejected') {
    $judul = "Event Ditolak";
    $pesan =
      "Halo Panitia,\n\n" .
      "Event \"{$data['nama_event']}\" DITOLAK oleh admin.\n\n" .
      "Catatan Admin:\n$catatan\n\n" .
      "Silakan perbaiki dan ajukan kembali.\n\n" .
      "– UniVENT";
  }

  $notifStatus = "failed";
  $errorMsg = null;

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $_ENV['MAIL_PORT'];

    $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
    $mail->addAddress($data['email']);

    $mail->Subject = $judul;
    $mail->Body    = $pesan;

    $mail->send();
    $notifStatus = "sent";

  } catch (Exception $e) {
    $errorMsg = $mail->ErrorInfo;
  }

  // log notifikasi
  $log = $conn->prepare("
    INSERT INTO notifikasi
    (user_role, user_id, channel, title, message, status, error_message)
    VALUES ('panitia', ?, 'email', ?, ?, ?, ?)
  ");
  $log->bind_param(
    "issss",
    $data['id_panitia'],
    $judul,
    $pesan,
    $notifStatus,
    $errorMsg
  );
  $log->execute();
}

/* =====================
   RESPONSE
===================== */
echo json_encode(["success" => true]);
exit;
