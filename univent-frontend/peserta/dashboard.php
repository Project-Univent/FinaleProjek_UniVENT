<?php
$required_role = 'peserta';
require "../auth/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Peserta - Univent</title>

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

  <!-- INJEK otomatis oleh JS -->
  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <!-- MAIN CONTENT -->
  <main id="peserta-main" class="p-6 space-y-10 transition-all duration-300">

    <!-- HIGHLIGHT EVENT -->
         <!-- HEADER -->
    <section>
      <h1 class="text-2xl font-bold">Event Terdekat</h1>
      <p class="text-gray-500 text-sm">Event yang akan mulai. Ayo dapatkan tiketnya!!!.</p>
    </section>
    
    <section>
      <h2 class="text-lg font-semibold mb-4"></h2>

      <div class="relative w-full h-56 rounded-xl shadow overflow-hidden">
        <img src="../assets/img/poster1.jpg"
             class="w-full h-full object-cover">

        <div class="absolute top-3 left-3 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
          Seminar
        </div>

        <div class="absolute bottom-4 left-4 text-white text-xl font-semibold drop-shadow-lg">
          Tech Conference 2024
        </div>
      </div>
    </section>

    <!-- EVENT REKOMENDASI -->
    <section>
      <h2 class="text-lg font-semibold mb-4">Rekomendasi Event</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

        <!-- KARTU EVENT -->
        <div class="bg-white rounded-xl border shadow overflow-hidden">
          <img src="../assets/img/poster2.jpg" class="h-40 w-full object-cover">

          <div class="p-4 space-y-2">
            <div class="font-semibold text-lg">Marketing Workshop</div>
            <div class="text-sm text-gray-600">📅 10 Februari 2024</div>
            <div class="text-sm text-gray-600">📍 Gedung FTI Lt. 3</div>

            <a href="event-detail.html"
               class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
              Lihat Detail
            </a>
          </div>
        </div>

        <!-- COPY KARTU LAINNYA -->
        <div class="bg-white rounded-xl border shadow overflow-hidden">
          <img src="../assets/img/poster3.jpg" class="h-40 w-full object-cover">
          <div class="p-4 space-y-2">
            <div class="font-semibold text-lg">UI/UX Seminar 2024</div>
            <div class="text-sm text-gray-600">📅 21 Mei 2024</div>
            <div class="text-sm text-gray-600">📍 Aula Perpustakaan</div>
            <a href="event-detail.html"
               class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
              Lihat Detail
            </a>
          </div>
        </div>

      </div>
    </section>

  </main>

</body>
</html>
