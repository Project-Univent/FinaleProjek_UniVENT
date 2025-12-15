<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../autentikasi/login.php");
  exit;
}

if (!isset($required_role)) {
  return;
}

if ($_SESSION['role'] !== $required_role) {
  header("Location: ../autentikasi/login.php");
  exit;
}

$DEV_MODE = true;

if ($DEV_MODE) {
  $_SESSION['role'] = $required_role;
  $_SESSION['nama'] = 'DEV USER';
  return;
}

