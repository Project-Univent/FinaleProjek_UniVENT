<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Event - UniVENT</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Sidebar + Shell -->
  <script src="../assets/js/peserta/peserta-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Injected via JS -->
  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <!-- MAIN -->
  <main id="peserta-main" class="p-6 space-y-10 transition-all duration-300">

    <!-- HEADER -->
    <section>
      <h1 class="text-2xl font-bold">Browse Events</h1>
      <p class="text-sm text-gray-500">Temukan berbagai event menarik</p>
    </section>

    <!-- HIGHLIGHT EVENT -->
    <section>
      <div class="relative w-full h-56 rounded-xl overflow-hidden shadow">
        <img src="../assets/img/poster1.jpg"
             class="w-full h-full object-cover">
        <span class="absolute top-3 left-3 bg-blue-100 text-blue-700 px-3 py-1 text-sm rounded-full">
          International
        </span>
        <div class="absolute bottom-4 left-4 text-white text-xl font-semibold drop-shadow-lg">
          Tech Conference 2024
        </div>
      </div>
    </section>

    <!-- SEARCH + FILTER -->
    <section>
      <div class="flex items-center justify-between mb-6">
        <input type="text" placeholder="Search events..."
               class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

        <button class="flex items-center ml-4 space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
          <span>⚙️</span>
          <span>Filters</span>
        </button>
      </div>
    </section>

    <!-- EVENT GRID -->
    <section>
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

        <!-- CARD 1 -->
        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
          <div class="h-40 overflow-hidden">
            <img src="../assets/img/poster1.jpg" class="w-full h-full object-cover">
          </div>

          <div class="p-4 space-y-2">
            <div class="text-gray-800 font-semibold text-lg">Tech Conference 2024</div>

            <div class="flex items-center text-gray-600 text-sm">
              📅 <span class="ml-2">2024-03-15</span>
            </div>

            <div class="flex items-center text-gray-600 text-sm">
              📍 <span class="ml-2">San Francisco, CA</span>
            </div>

            <div class="flex items-center text-gray-600 text-sm">
              👥 <span class="ml-2">450 / 500 attendees</span>
            </div>

            <a href="event-detail.php"
               class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
              Lihat Detail
            </a>

            <a href="event-diikuti.php"
              class="block mt-2 text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
              Daftar Acara
            </a>

          </div>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
          <div class="h-40 overflow-hidden">
            <img src="../assets/img/poster2.jpg" class="w-full h-full object-cover">
          </div>
          <div class="p-4 space-y-2">
            <div class="text-gray-800 font-semibold text-lg">Summer Music Festival</div>

            <div class="flex items-center text-gray-600 text-sm">
              📅 <span class="ml-2">2024-06-20</span>
            </div>

            <div class="flex items-center text-gray-600 text-sm">
              📍 <span class="ml-2">Austin, TX</span>
            </div>

            <div class="flex items-center text-gray-600 text-sm">
              👥 <span class="ml-2">2800 / 3000 attendees</span>
            </div>

            <a href="event-detail.php"
               class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
              Lihat Detail
            </a>

            <a href="event-diikuti.php"
              class="block mt-2 text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
              Daftar Acara
            </a>

          </div>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
          <div class="h-40 overflow-hidden">
            <img src="../assets/img/poster3.jpg" class="w-full h-full object-cover">
          </div>

          <div class="p-4 space-y-2">
            <div class="text-gray-800 font-semibold text-lg">Marketing Workshop</div>

            <div class="flex items-center text-gray-600 text-sm">
              📅 <span class="ml-2">2024-02-10</span>
            </div>

            <div class="flex items-center text-gray-600 text-sm">
              📍 <span class="ml-2">New York, NY</span>
            </div>

            <div class="flex items-center text-gray-600 text-sm">
              👥 <span class="ml-2">120 / 150 attendees</span>
            </div>

            <a href="event-detail.php"
               class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
              Lihat Detail
            </a>

            <a href="event-diikuti.php"
              class="block mt-2 text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
              Daftar Acara
            </a>

          </div>
        </div>

      </div>
    </section>

  </main>

</body>
</html>
