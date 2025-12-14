<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Event - Univent</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../assets/css/style.css" />

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Inject sidebar + topbar + layout offset -->
  <script src="../assets/js/peserta/peserta-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- injected via JS -->
  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <!-- MAIN (isi konten event) -->
  <main id="peserta-main" class="p-6 max-w-4xl mx-auto space-y-10 transition-all duration-300">

    <!-- HEADER TITLE -->
    <section>
      <h1 class="text-2xl font-bold">Detail Event</h1>
    </section>

    <!-- POSTER EVENT -->
    <div class="w-full h-64 rounded-xl overflow-hidden shadow">
      <img src="../assets/img/poster1.jpg" class="w-full h-full object-cover" />
    </div>

    <!-- TITLE + INFO -->
    <section class="space-y-4">

      <h2 class="text-2xl font-bold">Tech Conference 2024</h2>

      <!-- INFO GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="flex items-center space-x-3">
          <span class="text-xl">📅</span>
          <div>
            <p class="font-medium">Tanggal</p>
            <p class="text-gray-600">15 Maret 2024</p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">⏰</span>
          <div>
            <p class="font-medium">Waktu</p>
            <p class="text-gray-600">09:00 - 12:00 WIB</p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">📍</span>
          <div>
            <p class="font-medium">Lokasi</p>
            <p class="text-gray-600">Aula FTI Universitas</p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">🏷</span>
          <div>
            <p class="font-medium">Kategori</p>
            <p class="text-gray-600">Seminar / Teknologi</p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">👥</span>
          <div>
            <p class="font-medium">Kuota</p>
            <p class="text-gray-600">450 / 500 Peserta</p>
          </div>
        </div>

      </div>

    </section>

    <!-- TOMBOL DAFTAR -->
    <div>
      <a href="event-diikuti.php"
         class="block text-center bg-blue-600 text-white py-3 rounded-xl text-lg font-semibold hover:bg-blue-700">
        Daftar Event
      </a>
    </div>

    <!-- DESKRIPSI -->
    <section class="space-y-3">
      <h3 class="font-semibold text-lg">Deskripsi Event</h3>

      <p class="text-gray-700 leading-relaxed">
        Tech Conference 2024 adalah acara tahunan yang menghadirkan para ahli industri 
        teknologi untuk membahas inovasi terbaru di bidang artificial intelligence, 
        cybersecurity, software development, dan banyak lagi.
      </p>

      <p class="text-gray-700 leading-relaxed">
        Acara ini bertujuan memberikan wawasan mendalam kepada mahasiswa dan profesional 
        dalam dunia teknologi untuk meningkatkan pemahaman dan mengembangkan kemampuan mereka 
        di bidang terkait.
      </p>
    </section>

    <!-- LINK KEMBALI -->
    <div class="pt-4">
      <a href="event-list.php" class="text-blue-600 hover:underline">
        ← Kembali ke Lihat Event
      </a>
    </div>

  </main>

</body>
</html>
