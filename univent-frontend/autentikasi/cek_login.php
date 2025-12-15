<?php
session_start();

/* ======================
   DEV MODE (sementara)
====================== */
$DEV_MODE = true;

if ($DEV_MODE) {
  $_SESSION['user_id'] = 1;
  $_SESSION['nama'] = 'DEV USER';
  $_SESSION['role'] = $required_role ?? 'panitia';
}

/* ======================
   AUTH CHECK
====================== */
if (!isset($_SESSION['user_id'])) {
  header("Location: ../autentikasi/login.php");
  exit;
}

if (isset($required_role) && $_SESSION['role'] !== $required_role) {
  header("Location: ../autentikasi/login.php");
  exit;
}
