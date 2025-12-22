<?php
session_start();


/* ======================
   AUTH CHECK
====================== */

if (!isset($_SESSION['user_id'], $_SESSION['role'])) {
  header("Location: ../autentikasi/login.php");
  exit;
}

if (isset($required_role) && $_SESSION['role'] !== $required_role) {
  header("Location: ../autentikasi/login.php");
  exit;
}

