<?php
$required_role = 'peserta'; // sesuai folder
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Acara - Panitia</title>

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

    <section class="max-w-3xl mx-auto space-y-6">

      <a href="status-acara.php"
        class="inline-flex items-center gap-2 text-sm text-[#1B5FA7] hover:underline mb-4">
        ← Kembali ke Status Acara
      </a>

      <div>
        <h1 class="text-2xl font-semibold">Edit Acara</h1>
        <p class="text-sm text-gray-500">Perbarui detail acara</p>
      </div>

      <div class="bg-white shadow rounded-xl p-6 space-y-6">

        <div>
          <label class="block font-medium mb-2">Poster Acara</label>
          <input type="file"
            class="w-full border rounded-lg px-4 py-2 file:bg-[#2B77D1] file:text-white file:hover:bg-[#2566B8] file:px-4 file:py-2 file:rounded-lg">
          <p class="text-sm text-gray-500 mt-1">
            Biarkan kosong jika tidak ingin mengganti poster
          </p>
        </div>

        <div>
          <label class="block font-medium mb-2">Nama Acara</label>
          <input type="text"
            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#2B77D1] outline-none"
            value="Tech Conference 2024">
        </div>

        <div>
          <label class="block font-medium mb-2">Deskripsi Acara</label>
          <textarea
            class="w-full border rounded-lg px-4 py-3 h-32 focus:ring-2 focus:ring-[#2B77D1] outline-none">Acara tahunan yang membahas perkembangan teknologi terkini.</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-medium mb-2">Tanggal</label>
            <input type="date"
              class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#2B77D1] outline-none"
              value="2024-03-15">
          </div>

          <div>
            <label class="block font-medium mb-2">Waktu Mulai</label>
            <input type="time"
              class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#2B77D1] outline-none"
              value="09:00">
          </div>
        </div>

        <div>
          <label class="block font-medium mb-2">Lokasi Acara</label>
          <input type="text"
            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#2B77D1] outline-none"
            value="Aula FTI Universitas">
        </div>

        <div>
          <label class="block font-medium mb-2">Kuota Peserta</label>
          <input type="number" min="1"
            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#2B77D1] outline-none"
            value="150">
        </div>

        <button
          class="w-full bg-[#2B77D1] text-white py-3 rounded-xl font-semibold hover:bg-[#2566B8] transition-colors duration-200">
          Simpan Perubahan
        </button>

      </div>
    </section>

  </main>

</body>
</html>
