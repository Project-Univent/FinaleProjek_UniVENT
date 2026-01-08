<?php
class Auth {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function login($email, $password, $table, $idField, $redirect, $role) {
    $stmt = $this->conn->prepare(
      "SELECT $idField AS id, username AS nama, password
       FROM $table WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['nama']    = $user['nama'];
      $_SESSION['role']    = $role;

      header("Location: $redirect");
      exit;
    }

    return false;
  }

  public function registerPeserta($nama, $email, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $this->conn->prepare(
      "INSERT INTO peserta (username, email, password)
       VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $nama, $email, $hash);
    return $stmt->execute();
  }
}
