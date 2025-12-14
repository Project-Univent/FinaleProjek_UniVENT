<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

if (!isset($required_role)) {
  return;
}

if ($_SESSION['role'] !== $required_role) {
  header("Location: ../auth/login.php");
  exit;
}
