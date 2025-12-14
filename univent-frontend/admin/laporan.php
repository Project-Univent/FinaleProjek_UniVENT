<?php
$required_role = 'admin';
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Laporan Event — Admin</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Admin Shell -->
  <script src="../assets/js/admin/admin-shell.js" defer></script>

  <!-- Halaman Logic -->
  <script src="../assets/js/admin/admin-laporan.js" defer></script>
</head>

<body class="bg-gray-100">

  <!-- Injected by JS -->
  <div id="sidebar-container"></div>
  <header id="admin-topbar"></header>

  <!-- MAIN CONTENT -->
  <main id="admin-main" class="p-6 transition-all duration-300">

    <!-- TITLE -->
    <h1 class="text-2xl font-semibold mb-1">Laporan Event</h1>
    <p class="text-gray-600 mb-6">Analitik lengkap & ringkasan aktivitas event mahasiswa.</p>

    <!-- SUMMARY CARDS -->
    <div id="summary-cards"
         class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <!-- cards injected by JS -->
    </div>

    <!-- ROW: EVENT & PESERTA -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

      <div class="bg-white rounded-lg shadow p-6">
        <h2 class="font-semibold mb-4">Jumlah Event per Bulan</h2>
        <canvas id="chartEvent"></canvas>
      </div>

      <div class="bg-white rounded-lg shadow p-6">
        <h2 class="font-semibold mb-4">Jumlah Peserta per Bulan</h2>
        <canvas id="chartPeserta"></canvas>
      </div>

    </div>

    <!-- KATEGORI PALING DIMINATI -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
      <h2 class="font-semibold mb-4">Kategori Event Paling Diminati</h2>
      <canvas id="chartKategori"></canvas>
    </div>

    <!-- INSIGHT TEKS -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
      <h2 class="font-semibold mb-3">Insight & Rekomendasi</h2>
      <div id="insight-text" class="text-gray-700 text-sm leading-relaxed">
        <!-- injected by JS -->
      </div>
    </div>

    <!-- TABEL LAPORAN -->
    <div class="bg-white rounded-lg shadow p-6 mb-6 overflow-x-auto">
      <h2 class="font-semibold mb-4">Tabel Laporan Lengkap</h2>

      <table class="w-full text-sm">
        <thead>
          <tr class="border-b bg-gray-100 text-gray-700">
            <th class="p-2 text-left">Nama Event</th>
            <th class="p-2 text-left">Tanggal</th>
            <th class="p-2 text-left">Kategori</th>
            <th class="p-2 text-left">Peserta</th>
            <th class="p-2 text-left">Status</th>
            <th class="p-2 text-left">Aksi</th>
          </tr>
        </thead>

        <tbody id="table-laporan">
          <!-- rows injected by JS -->
        </tbody>
      </table>
    </div>

    <!-- DOWNLOAD CSV BUTTON -->
    <div class="flex justify-end">
      <button id="downloadCSV"
              class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Download CSV
      </button>
    </div>

  </main>

</body>
</html>
