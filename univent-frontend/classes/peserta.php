<?php
class Peserta {
  private $conn;
  private $id_peserta;

  public function __construct($conn, $id_peserta) {
    $this->conn = $conn;
    $this->id_peserta = $id_peserta;
  }

  // function daftar event
  public function daftarEvent($id_event) {
    // cek event approved + ambil kuota
    $cekEvent = $this->conn->prepare("
      SELECT kuota
      FROM event
      WHERE id_event = ? AND status = 'approved'
    ");
    $cekEvent->bind_param("i", $id_event);
    $cekEvent->execute();
    $event = $cekEvent->get_result()->fetch_assoc();

    if (!$event) {
      return "EVENT_TIDAK_VALID";
    }

    // cek sudah daftar
    $cek = $this->conn->prepare("
      SELECT 1 FROM tiket
      WHERE id_event = ? AND id_peserta = ?
    ");
    $cek->bind_param("ii", $id_event, $this->id_peserta);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
      return "SUDAH_DAFTAR";
    }

    // hitung kuota terpakai
    $hitung = $this->conn->prepare("
      SELECT COUNT(*) AS total
      FROM tiket
      WHERE id_event = ?
    ");
    $hitung->bind_param("i", $id_event);
    $hitung->execute();
    $total = $hitung->get_result()->fetch_assoc()['total'];

    if ($total >= $event['kuota']) {
      return "KUOTA_PENUH";
    }

    // generate tiket
    $kode_tiket = 'TKT-' . strtoupper(bin2hex(random_bytes(4)));

    // insert tiket
    $stmt = $this->conn->prepare("
      INSERT INTO tiket (id_event, id_peserta, kode_tiket)
      VALUES (?, ?, ?)
    ");
    $stmt->bind_param("iis", $id_event, $this->id_peserta, $kode_tiket);
    $stmt->execute();

    return "SUKSES";
  }

// event diikuti
  public function getEventDiikuti() {
    $sql = "
      SELECT
        e.id_event,
        e.nama_event,
        e.tanggal_event,
        e.lokasi,
        e.poster
      FROM tiket t
      JOIN event e ON t.id_event = e.id_event
      WHERE t.id_peserta = ?
      ORDER BY e.tanggal_event ASC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->id_peserta);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
