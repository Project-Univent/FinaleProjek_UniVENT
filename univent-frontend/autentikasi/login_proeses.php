<?php
session_start();
require "../config/db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
  header("Location: login.php?error=1");
  exit;
}

$stmt = $conn->prepare("SELECT id, nama, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
  header("Location: login.php?error=1");
  exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['nama'] = $user['nama'];
$_SESSION['role'] = $user['role'];

if ($user['role'] === 'admin') {
  header("Location: ../admin/dashboard.php");
} elseif ($user['role'] === 'panitia') {
  header("Location: ../panitia/dashboard.php");
} else {
  header("Location: ../peserta/dashboard.php");
}
exit;
