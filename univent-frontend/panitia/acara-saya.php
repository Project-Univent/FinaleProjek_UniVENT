<?php
$required_role = 'peserta'; // sesuai folder
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acara Saya - Panitia</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../assets/css/style.css" />

  <!-- Inject sidebar + topbar -->
  <script src="../assets/js/panitia/panitia-shell.js" defer></script>

</head>

<body class="bg-gray-50 text-gray-800">

  <!-- INJECT OTOMATIS -->
  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <!-- MAIN -->
  <main id="panitia-main" class="p-6 space-y-6 transition-all duration-300">

    <section>
      <h1 class="text-2xl font-semibold">Acara Saya</h1>
      <p class="text-sm text-gray-500">Daftar acara yang kamu kelola</p>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

      <div class="bg-white rounded-xl shadow border overflow-hidden">
        <img src="../assets/img/poster1.jpg" class="h-40 w-full object-cover">

        <div class="p-4 space-y-2">
          <p class="text-lg font-semibold">Tech Conference 2024</p>
          <p class="text-sm text-gray-600">📅 11 Maret 2024</p>
          <p class="text-sm text-gray-600">📍 Aula FTI</p>
          <p class="text-sm font-semibold text-green-600">Status: Berjalan</p>

          <a href="edit-acara.php"
            class="block text-center bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition-colors duration-200">
            Edit Acara
          </a>

          <a href="peserta-acara.php"
            class="block text-center bg-[#2B77D1] text-white py-2 rounded-lg hover:bg-[#2566B8] transition-colors duration-200">
            Lihat Peserta
          </a>
        </div>
      </div>

    </section>

  </main>

</body>
</html>
