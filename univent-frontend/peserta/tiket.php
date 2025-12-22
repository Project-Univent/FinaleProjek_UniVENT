<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* =========================
   VALIDASI SESSION
========================= */
$id_peserta = $_SESSION['user_id'] ?? null;
$id_event   = $_GET['id'] ?? null;

if (!$id_peserta || !$id_event || !is_numeric($id_event)) {
  die("Akses tidak valid");
}

/* =========================
   AMBIL DATA TIKET MILIK PESERTA
========================= */
$sql = "
  SELECT
    t.kode_tiket,
    e.nama_event,
    e.tanggal_event,
    e.waktu_mulai,
    e.lokasi,
    k.nama_kategori,
    e.poster
  FROM tiket t
  JOIN event e ON t.id_event = e.id_event
  JOIN kategori_event k ON e.id_kategori = k.id_kategori
  WHERE t.id_event = ? AND t.id_peserta = ?
  LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_event, $id_peserta);
$stmt->execute();
$result = $stmt->get_result();
$tiket = $result->fetch_assoc();

if (!$tiket) {
  die("Tiket tidak ditemukan atau bukan milik kamu");
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket Event - UniVENT</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <script src="../assets/js/peserta/peserta-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <main id="peserta-main"
        class="p-6 max-w-xl mx-auto transition-all duration-300">

    <section class="mb-6">
      <h1 class="text-2xl font-bold">Tiket Event</h1>
      <p class="text-gray-500 text-sm">
        Simpan tiket ini dan tunjukkan saat registrasi acara
      </p>
    </section>

    <section class="bg-white rounded-2xl shadow border overflow-hidden">

      <div class="bg-blue-600 text-white px-6 py-4">
        <div class="text-lg font-semibold">
          <?= htmlspecialchars($tiket['nama_event']) ?>
        </div>
        <div class="text-sm opacity-90">
          <?= htmlspecialchars($tiket['nama_kategori']) ?>
        </div>
      </div>

      <div class="p-6 space-y-4">

        <div>
          <p class="text-sm text-gray-500">Nama Peserta</p>
          <p class="font-semibold"><?= htmlspecialchars($_SESSION['nama']) ?></p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Tanggal & Waktu</p>
          <p class="font-semibold">
            <?= htmlspecialchars($tiket['tanggal_event']) ?>
            • <?= htmlspecialchars($tiket['waktu_mulai'] ?? '-') ?>
          </p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Lokasi</p>
          <p class="font-semibold"><?= htmlspecialchars($tiket['lokasi']) ?></p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Kode Tiket</p>
          <p class="font-mono text-sm bg-gray-100 inline-block px-3 py-1 rounded">
            <?= htmlspecialchars($tiket['kode_tiket']) ?>
          </p>
        </div>

      </div>

      <div class="bg-gray-50 px-6 py-4 flex flex-col gap-3">

        <button onclick="window.print()"
          class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
          Print Tiket
        </button>

        <a href="event-diikuti.php"
          class="w-full text-center border border-gray-300 py-2 rounded-lg hover:bg-gray-100">
          Kembali
        </a>

      </div>


    </section>

  </main>

</body>
</html>
