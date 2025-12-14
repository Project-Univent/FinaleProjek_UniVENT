<?php
$required_role = 'peserta'; // sesuai folder
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Peserta Acara - Panitia</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- Inject shell + sidebar -->
  <script src="../assets/js/panitia/panitia-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- INJECT -->
  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <!-- MAIN -->
  <main id="panitia-main" class="p-6 transition-all duration-300">

    <section class="max-w-4xl mx-auto space-y-6">

      <div>
        <h1 class="text-2xl font-semibold">Peserta Acara</h1>
        <p class="text-sm text-gray-500">Tech Conference 2024 · Total 120 peserta</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Cari peserta berdasarkan nama atau email..."
          class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#2B77D1] outline-none">
      </div>

      <div class="bg-white shadow rounded-xl overflow-hidden border">
        <table class="w-full text-left">
          <thead class="bg-gray-100 border-b">
            <tr>
              <th class="py-3 px-4 font-medium text-gray-700">Nama</th>
              <th class="py-3 px-4 font-medium text-gray-700">Email</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4">Andi Pratama</td>
              <td class="py-3 px-4">andi@example.com</td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4">Bunga Sari</td>
              <td class="py-3 px-4">bunga@example.com</td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4">Dewi Lestari</td>
              <td class="py-3 px-4">dewi@example.com</td>
            </tr>
          </tbody>
        </table>
      </div>

    </section>

  </main>

</body>
</html>
