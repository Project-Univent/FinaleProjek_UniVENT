<?php
$required_role = 'admin';
require __DIR__ . "/../../autentikasi/cek_login.php";
require __DIR__ . "/../../config/koneksi.php";

$id_event = $_GET['id'] ?? null;

if (!$id_event || !is_numeric($id_event)) {
    echo "ID event tidak valid";
    exit;
}

/* 1. HAPUS TIKET TERKAIT */
$stmt = $conn->prepare("DELETE FROM tiket WHERE id_event = ?");
$stmt->bind_param("i", $id_event);
$stmt->execute();

/* 2. HAPUS EVENT */
$stmt = $conn->prepare("DELETE FROM event WHERE id_event = ?");
$stmt->bind_param("i", $id_event);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "OK";
} else {
    echo "Event tidak ditemukan";
}
