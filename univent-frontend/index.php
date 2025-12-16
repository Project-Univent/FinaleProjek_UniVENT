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
        <img src="assets/img/logo.png"
            alt="Logo UniVENT"
            class="h-8 w-auto">

        <img src="assets/img/univent.png"
            alt="UniVENT Text Logo"
            class="h-6 w-auto">
      </a>



      <nav class="space-x-6 text-sm">
        <a href="#home" class="hover:text-blue-500">Home</a>
        <a href="#about" class="hover:text-blue-500">About</a>
        <a href="#category" class="hover:text-blue-500">Category</a>
        <a href="#events" class="hover:text-blue-500">Events</a>
      </nav>

      <a href="autentikasi/login.php"
        class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-sm transition">
        Login
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
          Explore Event
        </a>
        <a href="#about"
           class="inline-block px-7 py-3 border border-white rounded-full">
          About Us
        </a>
      </div>
    </div>
  </section>

  <!-- ================= PANEL 2: VALUE ================= -->
  <section id="about" class="py-24 bg-white">
    <div class="max-w-6xl mx-auto text-center px-6">
      <h2 class="text-3xl font-bold mb-4">
        Kenapa UniVENT?
      </h2>

      <p class="text-gray-500 mb-16">
        Semua kebutuhan event kampus dalam satu platform
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="p-8 rounded-xl bg-gray-100">
          <h3 class="font-semibold mb-2">📅 Informasi Event Terupdate</h3>
          <p class="text-sm text-gray-600">
            Detail dan status event selalu tersedia dan mudah diakses
          </p>
        </div>

        <div class="p-8 rounded-xl bg-gray-100">
          <h3 class="font-semibold mb-2">⚡ Daftar Cepat</h3>
          <p class="text-sm text-gray-600">
            Registrasi event tanpa ribet dan cepat
          </p>
        </div>

        <div class="p-8 rounded-xl bg-gray-100">
          <h3 class="font-semibold mb-2">🔔 Pantau Event dengan Mudah</h3>
          <p class="text-sm text-gray-600">
            Lihat jadwal, status, dan informasi event dalam satu tampilan
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- KATEGORI -->
<section id="category" class="py-24 bg-gray-900 text-white">

  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-4">
      Kategori Event Trending 🔥
    </h2>

    <p class="text-gray-300 mb-16">
      Kategori yang paling sering diikuti mahasiswa
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left">

      <a href="event-list.php?kategori=seminar"
        class="flex justify-between items-center p-8 bg-white text-gray-800 rounded-2xl shadow
               hover:shadow-xl hover:-translate-y-1 transition">
        <div>
          <h3 class="text-xl font-semibold">🎤 Seminar & Webinar</h3>
          <p class="text-gray-500 text-sm mt-1">24 event aktif</p>
        </div>
        <span class="text-blue-600 font-semibold">Trending</span>
      </a>

      <a href="event-list.php?kategori=lomba"
        class="flex justify-between items-center p-8 bg-white text-gray-800 rounded-2xl shadow
               hover:shadow-xl hover:-translate-y-1 transition">
        <div>
          <h3 class="text-xl font-semibold">🏆 Lomba & Kompetisi</h3>
          <p class="text-gray-500 text-sm mt-1">18 event</p>
        </div>
        <span class="text-red-500 text-lg">🔥</span>
      </a>

      <a href="event-list.php?kategori=workshop"
        class="flex justify-between items-center p-8 bg-white text-gray-800 rounded-2xl shadow
               hover:shadow-xl hover:-translate-y-1 transition">
        <div>
          <h3 class="text-xl font-semibold">🛠 Workshop</h3>
          <p class="text-gray-500 text-sm mt-1">12 event</p>
        </div>
      </a>

      <a href="event-list.php?kategori=teknologi"
        class="flex justify-between items-center p-8 bg-blue-600 text-white rounded-2xl shadow
               hover:bg-blue-700 hover:-translate-y-1 transition">
        <div>
          <h3 class="text-xl font-semibold">💻 Teknologi</h3>
          <p class="text-sm opacity-90 mt-1">
            Paling diminati bulan ini
          </p>
        </div>
      </a>

    </div>
  </div>
</section>

<!-- CTA -->
<section id="events" class="py-24 bg-gray-50 text-center">
  <h2 class="text-3xl font-bold mb-4">
    Siap Ikut Event Kampus?
  </h2>

  <p class="text-gray-600 mb-8">
    Gabung sekarang dan jangan lewatkan event menarik
  </p>

  <a href="autentikasi/register.php"
    class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700
           text-white rounded-full transition">
    Daftar Gratis
  </a>
</section>


  <!-- ================= FOOTER ================= -->
  <footer class="bg-black text-gray-400 py-6 text-center text-sm">
    © 2025 UniVENT. All rights reserved.
  </footer>

</body>
</html>
