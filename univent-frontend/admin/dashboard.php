<?php
$required_role = 'admin';
require "../autentikasi/cek_login.php";
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard Admin — Univent</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Shell & Logic -->
  <script src="../assets/js/admin/admin-shell.js" defer></script>
  <script src="../assets/js/admin/admin-dashboard.js" defer></script>

  <style>
    .card-radius { border-radius: .75rem; }
  </style>
</head>

<body class="bg-gray-100">

  <!-- injected -->
  <div id="sidebar-container"></div>
  <header id="admin-topbar"></header>

  <main id="admin-main" class="p-6 transition-all duration-300">

    <!-- SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white card-radius shadow p-5">
        <div class="text-sm text-gray-500">Total Event</div>
        <div class="text-2xl font-bold" id="stat-total-event">—</div>
      </div>
      <div class="bg-white card-radius shadow p-5">
        <div class="text-sm text-gray-500">Total Peserta</div>
        <div class="text-2xl font-bold" id="stat-total-peserta">—</div>
      </div>
      <div class="bg-white card-radius shadow p-5">
        <div class="text-sm text-gray-500">Event Terverifikasi</div>
        <div class="text-2xl font-bold" id="stat-total-verified">—</div>
      </div>
    </div>

    <!-- KATEGORI + HERO -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

      <!-- KATEGORI -->
      <div class="bg-white card-radius shadow p-6">
        <h3 class="font-semibold mb-4">Kategori Event</h3>
        <div id="kategori-list" class="space-y-3">
          <!-- diisi JS -->
        </div>
      </div>

      <!-- HERO ANALITIK -->
      <div class="lg:col-span-2">
        <div class="bg-white card-radius shadow p-6 h-full">

          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-lg font-semibold">
                Analitik: Jenis Event Paling Diminati
              </h2>
              <p class="text-sm text-gray-500">
                Berdasarkan jumlah peserta terdaftar
              </p>
            </div>

            <a href="export-analytics.php"
              class="text-sm bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
              ⬇️ CSV
            </a>
          </div>

          <div id="hero-analytics"
              class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- diisi JS -->
          </div>

        </div>
      </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

      <div class="bg-white card-radius shadow p-6 h-72 flex flex-col">
        <h3 class="font-semibold mb-4">Jumlah Event per Tanggal</h3>
        <div class="flex-1">
          <canvas id="chart-event-tanggal"></canvas>
        </div>
      </div>

      <div class="bg-white card-radius shadow p-6 h-72 flex flex-col">
        <h3 class="font-semibold mb-4">Jumlah Event per Kategori</h3>
        <div class="flex-1">
          <canvas id="chart-kategori"></canvas>
        </div>
      </div>

    </div>
  </main>

</body>
</html>
