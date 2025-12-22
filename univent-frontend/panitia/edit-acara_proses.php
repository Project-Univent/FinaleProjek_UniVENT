<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* ======================
   VALIDASI PANITIA
====================== */
$id_panitia = $_SESSION['user_id'] ?? null;
if (!$id_panitia) {
    die("Panitia tidak valid");
}

/* ======================
   AMBIL DATA POST
====================== */
$id_event      = $_POST['id_event'] ?? null;
$nama_event    = $_POST['nama_event'] ?? '';
$deskripsi     = $_POST['deskripsi'] ?? '';
$tanggal_event = $_POST['tanggal_event'] ?? '';
$waktu_mulai   = $_POST['waktu_mulai'] ?? '';
$lokasi        = $_POST['lokasi'] ?? '';
$kuota         = $_POST['kuota'] ?? '';

if (
    !$id_event || !is_numeric($id_event) ||
    $nama_event === '' ||
    $deskripsi === '' ||
    $tanggal_event === '' ||
    $waktu_mulai === '' ||
    $lokasi === '' ||
    $kuota === ''
) {
    header("Location: edit-acara.php?id=$id_event&error=empty");
    exit;
}

/* ======================
   CEK KEPEMILIKAN EVENT
====================== */
$cek = $conn->prepare(
    "SELECT poster FROM event
     WHERE id_event = ? AND id_panitia = ?"
);
$cek->bind_param("ii", $id_event, $id_panitia);
$cek->execute();
$result = $cek->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Event tidak ditemukan atau bukan milik kamu");
}

/* ======================
   HANDLE UPLOAD POSTER (OPSIONAL)
====================== */
$poster_baru = $event['poster'];

if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {

    $ext = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
    $nama_file = uniqid('poster_') . '.' . $ext;

    $target_dir = "../uploads/poster/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . $nama_file;

    move_uploaded_file($_FILES['poster']['tmp_name'], $target_file);

    $poster_baru = $nama_file;
}

/* ======================
   UPDATE EVENT
====================== */
$update = $conn->prepare(
    "UPDATE event
     SET nama_event = ?, deskripsi = ?, tanggal_event = ?, waktu_mulai = ?,
         lokasi = ?, kuota = ?, poster = ?
     WHERE id_event = ? AND id_panitia = ?"
);

$update->bind_param(
    "sssssisii",
    $nama_event,
    $deskripsi,
    $tanggal_event,
    $waktu_mulai,
    $lokasi,
    $kuota,
    $poster_baru,
    $id_event,
    $id_panitia
);

$update->execute();

header("Location: status-acara.php?edit=success");
exit;
