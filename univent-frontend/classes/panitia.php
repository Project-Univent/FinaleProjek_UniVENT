<?php
class Panitia {
  private $conn;
  private $id_panitia;

  public function __construct($conn, $id_panitia) {
    $this->conn = $conn;
    $this->id_panitia = $id_panitia;
  }

  // function buat event
  public function buatEvent($data, $file) {
    $posterName = null;

    // upload poster
    if (!empty($file['poster']['name'])) {
      $posterName = time() . '_' . $file['poster']['name'];
      $targetDir = __DIR__ . "/../assets/img/";

      if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
      }

      move_uploaded_file(
        $file['poster']['tmp_name'],
        $targetDir . $posterName
      );
    }

    $sql = "
      INSERT INTO event (
        id_panitia,
        id_kategori,
        nama_event,
        deskripsi,
        tanggal_event,
        waktu_mulai,
        lokasi,
        kuota,
        poster,
        status
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param(
      "iisssssis",
      $this->id_panitia,
      $data['id_kategori'],
      $data['nama_event'],
      $data['deskripsi'],
      $data['tanggal_event'],
      $data['waktu_mulai'],
      $data['lokasi'],
      $data['kuota'],
      $posterName
    );

    return $stmt->execute();
  }

  // ambil event panitia
  public function getEventSaya() {
    $sql = "
      SELECT
        id_event,
        nama_event,
        tanggal_event,
        lokasi,
        poster,
        status
      FROM event
      WHERE id_panitia = ?
      ORDER BY tanggal_event DESC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->id_panitia);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
