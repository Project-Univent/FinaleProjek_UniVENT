<?php

class Database {
  private $conn;

  public function __construct($host, $user, $pass, $db) {
    $this->conn = mysqli_connect($host, $user, $pass, $db);

    if (!$this->conn) {
      die("Koneksi gagal: " . mysqli_connect_error());
    }
  }

  public function getConnection() {
    return $this->conn;
  }
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db";

$database = new Database($host, $user, $pass, $db);

//expose koneksi
$conn = $database->getConnection();
