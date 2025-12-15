<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";

/*
  Ambil ID event dari URL
*/
$event_id = $_GET['id'] ?? null;

/*
  DUMMY DATA TIKET
  Backend nanti:
  - cek peserta terdaftar di event
  - ambil data event + tiket dari DB
*/
$tiket = [
  'id_tiket' => 'TKT-2024-001',
  'nama_event' => 'Tech Conference 2024',
  'nama_peserta' => $_SESSION['nama'],
  'tanggal_event' => '2024-03-15',
  'waktu' => '09:00 - 12:00 WIB',
  'lokasi' => 'Aula FTI Universitas',
  'kategori' => 'Seminar / Teknologi'
];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket Event - UniVENT</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- AUTH USER -->
  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Shell Peserta -->
  <script src="../assets/js/peserta/peserta-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- injected by shell -->
  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <!-- MAIN -->
  <main id="peserta-main"
        class="p-6 max-w-xl mx-auto transition-all duration-300">

    <!-- TITLE -->
    <section class="mb-6">
      <h1 class="text-2xl font-bold">Tiket Event</h1>
      <p class="text-gray-500 text-sm">
        Simpan tiket ini dan tunjukkan saat registrasi acara
      </p>
    </section>

    <!-- TICKET CARD -->
    <section class="bg-white rounded-2xl shadow border border-gray-200 overflow-hidden">

      <!-- HEADER -->
      <div class="bg-blue-600 text-white px-6 py-4">
        <div class="text-lg font-semibold"><?= htmlspecialchars($tiket['nama_event']) ?></div>
        <div class="text-sm opacity-90"><?= htmlspecialchars($tiket['kategori']) ?></div>
      </div>

      <!-- BODY -->
      <div class="p-6 space-y-4">

        <div>
          <p class="text-sm text-gray-500">Nama Peserta</p>
          <p class="font-semibold"><?= htmlspecialchars($tiket['nama_peserta']) ?></p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Tanggal & Waktu</p>
          <p class="font-semibold">
            <?= $tiket['tanggal_event'] ?> • <?= $tiket['waktu'] ?>
          </p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Lokasi</p>
          <p class="font-semibold"><?= htmlspecialchars($tiket['lokasi']) ?></p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Kode Tiket</p>
          <p class="font-mono text-sm bg-gray-100 inline-block px-3 py-1 rounded">
            <?= $tiket['id_tiket'] ?>
          </p>
        </div>

      </div>

      <!-- FOOTER -->
      <div class="bg-gray-50 px-6 py-4 flex gap-3">
        <button onclick="window.print()"
          class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
          Print Tiket
        </button>

        <a href="event-diikuti.php"
          class="flex-1 text-center border border-gray-300 py-2 rounded-lg hover:bg-gray-100">
          Kembali
        </a>
      </div>

    </section>

  </main>

</body>
</html>
