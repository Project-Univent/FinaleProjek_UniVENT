<?php
require "config/koneksi.php";

/* =========================
   AMBIL KATEGORI TRENDING
========================= */
$q = $conn->query("
  SELECT
    k.nama_kategori,
    COUNT(e.id_event) AS total_event
  FROM kategori_event k
  LEFT JOIN event e
    ON e.id_kategori = k.id_kategori
    AND e.status = 'approved'
  GROUP BY k.id_kategori
  ORDER BY total_event DESC
");

$kategoriTrending = mysqli_fetch_all($q, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UniVENT</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-gray-800">

  <!-- ================= NAVBAR ================= -->
  <header class="fixed top-0 w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-10 h-16">
      <a href="#home" class="flex items-center gap-2">
        <img src="assets/img/logo.png" class="h-8">
        <img src="assets/img/univent.png" class="h-6">
      </a>

      <nav class="space-x-6 text-sm">
        <a href="#home" class="hover:text-blue-500">Home</a>
        <a href="#about" class="hover:text-blue-500">Tentang</a>
        <a href="#category" class="hover:text-blue-500">Kategori</a>
        <a href="#events" class="hover:text-blue-500">Acara</a>
      </nav>

      <a href="autentikasi/login.php"
         class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-sm">
        Masuk
      </a>
    </div>
  </header>

  <!-- ================= HERO ================= -->
  <section id="home"
    class="h-screen bg-cover bg-center flex items-center"
    style="background-image: linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
           url('https://images.unsplash.com/photo-1503428593586-e225b39bddfe');">

    <div class="ml-20 max-w-xl text-white">
      <h1 class="text-6xl font-bold mb-6">
        Uni<span class="text-blue-600">VENT</span>
      </h1>

      <p class="text-lg mb-8 opacity-90">
        Platform event mahasiswa untuk daftar, kelola,
        dan mengikuti acara kampus dengan mudah.
      </p>

      <div class="space-x-4">
        <a href="#category"
           class="inline-block px-7 py-3 bg-blue-600 hover:bg-blue-700 rounded-full">
          Jelajahi Acara
        </a>
        <a href="#about"
           class="inline-block px-7 py-3 border border-white rounded-full">
          Tentang Kita
        </a>
      </div>
    </div>
  </section>

  <!-- ================= TENTANG ================= -->
  <section id="about" class="py-24 bg-white">
    <div class="max-w-6xl mx-auto text-center px-6">
      <h2 class="text-3xl font-bold mb-4">Kenapa UniVENT?</h2>
      <p class="text-gray-500 mb-16">
        Semua kebutuhan event kampus dalam satu platform
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="p-8 rounded-xl bg-gray-100">
          <h3 class="font-semibold mb-2">📅 Informasi Event Terupdate</h3>
          <p class="text-sm text-gray-600">
            Detail dan status event selalu tersedia
          </p>
        </div>

        <div class="p-8 rounded-xl bg-gray-100">
          <h3 class="font-semibold mb-2">⚡ Daftar Cepat</h3>
          <p class="text-sm text-gray-600">
            Registrasi event tanpa ribet
          </p>
        </div>

        <div class="p-8 rounded-xl bg-gray-100">
          <h3 class="font-semibold mb-2">🔔 Pantau Event</h3>
          <p class="text-sm text-gray-600">
            Semua jadwal event dalam satu sistem
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= KATEGORI (DINAMIS) ================= -->
  <section id="category" class="py-24 bg-gray-900 text-white">

    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-4">
        Kategori Event Trending 🔥
      </h2>

      <p class="text-gray-300 mb-16">
        Berdasarkan jumlah event yang tersedia
      </p>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left">

        <?php foreach ($kategoriTrending as $i => $k): ?>
          <a
            href="autentikasi/login.php"
            class="flex justify-between items-center p-8 rounded-2xl shadow
                   <?= $i === 0
                     ? 'bg-blue-600 text-white hover:bg-blue-700'
                     : 'bg-white text-gray-800 hover:shadow-xl hover:-translate-y-1' ?>
                   transition"
          >
            <div>
              <h3 class="text-xl font-semibold">
                <?= htmlspecialchars($k['nama_kategori']) ?>
              </h3>

              <p class="text-sm mt-1 <?= $i === 0 ? 'opacity-90' : 'text-gray-500' ?>">
                <?= (int)$k['total_event'] ?> event aktif
              </p>
            </div>

            <?php if ($i === 0): ?>
              <span class="text-lg">🔥 Trending</span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>

      </div>
    </div>
  </section>

  <!-- ================= CTA ================= -->
  <section id="events" class="py-24 bg-gray-50 text-center">
    <h2 class="text-3xl font-bold mb-4">
      Siap Ikut Event Kampus?
    </h2>

    <p class="text-gray-600 mb-8">
      Gabung sekarang dan jangan lewatkan event menarik
    </p>

    <a href="autentikasi/register.php"
       class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700
              text-white rounded-full">
      Daftar Gratis
    </a>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer class="bg-black text-gray-400 py-6 text-center text-sm">
    © 2025 UniVENT. All rights reserved.
  </footer>

</body>
</html>
