<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Acara - Panitia</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Shell Panitia -->
  <script src="../assets/js/panitia/panitia-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- injected by shell -->
  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <!-- MAIN -->
  <main id="panitia-main" class="p-6 transition-all duration-300">

    <section class="max-w-3xl mx-auto space-y-6">
      <div>
        <h1 class="text-2xl font-semibold">Buat Acara Baru</h1>
        <p class="text-sm text-gray-500">
          Isi detail acara dengan lengkap
        </p>
      </div>

      <!-- FORM -->
      <form
        action="../api/panitia/simpan-acara.php"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-xl shadow p-6 space-y-6"
      >

        <!-- POSTER -->
        <div>
          <label class="block font-medium mb-2">Poster Acara</label>
          <input
            type="file"
            name="poster"
            accept="image/*"
            class="w-full border rounded-lg px-4 py-2
                   file:bg-[#2B77D1] file:text-white
                   file:px-4 file:py-2 file:rounded-lg
                   file:hover:bg-[#2566B8]"
          >
        </div>

        <!-- NAMA -->
        <div>
          <label class="block font-medium mb-2">Nama Acara</label>
          <input
            type="text"
            name="nama_event"
            required
            class="w-full border rounded-lg px-4 py-3
                   focus:ring-2 focus:ring-[#2B77D1] outline-none"
            placeholder="Masukkan nama acara"
          >
        </div>

        <!-- DESKRIPSI -->
        <div>
          <label class="block font-medium mb-2">Deskripsi Acara</label>
          <textarea
            name="deskripsi"
            required
            class="w-full border rounded-lg px-4 py-3 h-32
                   focus:ring-2 focus:ring-[#2B77D1] outline-none"
            placeholder="Tuliskan deskripsi acara..."
          ></textarea>
        </div>

        <!-- TANGGAL + WAKTU -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-medium mb-2">Tanggal</label>
            <input
              type="date"
              name="tanggal_event"
              required
              class="w-full border rounded-lg px-4 py-3
                     focus:ring-2 focus:ring-[#2B77D1] outline-none"
            >
          </div>

          <div>
            <label class="block font-medium mb-2">Waktu Mulai</label>
            <input
              type="time"
              name="waktu_mulai"
              required
              class="w-full border rounded-lg px-4 py-3
                     focus:ring-2 focus:ring-[#2B77D1] outline-none"
            >
          </div>
        </div>

        <!-- LOKASI -->
        <div>
          <label class="block font-medium mb-2">Lokasi Acara</label>
          <input
            type="text"
            name="lokasi"
            required
            class="w-full border rounded-lg px-4 py-3
                   focus:ring-2 focus:ring-[#2B77D1] outline-none"
          >
        </div>

        <!-- KUOTA -->
        <div>
          <label class="block font-medium mb-2">Kuota Peserta</label>
          <input
            type="number"
            name="kuota"
            min="1"
            required
            class="w-full border rounded-lg px-4 py-3
                   focus:ring-2 focus:ring-[#2B77D1] outline-none"
          >
        </div>

        <!-- SUBMIT -->
        <button
          type="submit"
          class="w-full bg-[#2B77D1] text-white py-3 rounded-xl
                 font-semibold hover:bg-[#2566B8] transition"
        >
          Simpan Acara
        </button>

      </form>

    </section>

  </main>

</body>
</html>
