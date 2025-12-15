<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";

/*
  DUMMY DATA DETAIL EVENT
  Backend nanti TINGGAL ganti query berdasarkan $_GET['id']
*/
$event = [
  'id_event' => $_GET['id'] ?? 1,
  'nama_event' => 'Tech Conference 2024',
  'tanggal_event' => '2024-03-15',
  'waktu_mulai' => '09:00',
  'waktu_selesai' => '12:00',
  'lokasi' => 'Aula FTI Universitas',
  'kategori' => 'Seminar / Teknologi',
  'kuota' => 500,
  'terdaftar' => 450,
  'poster' => 'poster1.jpg',
  'deskripsi' => '
    Tech Conference 2024 adalah acara tahunan yang menghadirkan para ahli industri
    teknologi untuk membahas inovasi terbaru di bidang artificial intelligence,
    cybersecurity, software development, dan berbagai topik teknologi lainnya.
    <br><br>
    Acara ini bertujuan memberikan wawasan mendalam kepada mahasiswa dan profesional
    agar dapat meningkatkan pemahaman serta mengembangkan kemampuan di bidang teknologi.
  '
];

// simulasi kuota penuh
$isFull = $event['terdaftar'] >= $event['kuota'];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Event - UniVENT</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- AUTH USER -->
  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Shell Peserta -->
  <script src="../assets/js/peserta/peserta-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- injected by shell -->
  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <!-- MAIN -->
  <main id="peserta-main"
        class="p-6 max-w-4xl mx-auto space-y-10 transition-all duration-300">

    <!-- HEADER -->
    <section>
      <h1 class="text-2xl font-bold">Detail Event</h1>
    </section>

    <!-- POSTER -->
    <div class="w-full h-64 rounded-xl overflow-hidden shadow">
      <img src="../assets/img/<?= htmlspecialchars($event['poster']) ?>"
           class="w-full h-full object-cover" />
    </div>

    <!-- TITLE + INFO -->
    <section class="space-y-4">

      <h2 class="text-2xl font-bold">
        <?= htmlspecialchars($event['nama_event']) ?>
      </h2>

      <!-- INFO GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="flex items-center space-x-3">
          <span class="text-xl">📅</span>
          <div>
            <p class="font-medium">Tanggal</p>
            <p class="text-gray-600"><?= $event['tanggal_event'] ?></p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">⏰</span>
          <div>
            <p class="font-medium">Waktu</p>
            <p class="text-gray-600">
              <?= $event['waktu_mulai'] ?> - <?= $event['waktu_selesai'] ?>
            </p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">📍</span>
          <div>
            <p class="font-medium">Lokasi</p>
            <p class="text-gray-600"><?= htmlspecialchars($event['lokasi']) ?></p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">🏷</span>
          <div>
            <p class="font-medium">Kategori</p>
            <p class="text-gray-600"><?= htmlspecialchars($event['kategori']) ?></p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">👥</span>
          <div>
            <p class="font-medium">Kuota</p>
            <p class="text-gray-600">
              <?= $event['terdaftar'] ?> / <?= $event['kuota'] ?> Peserta
            </p>
          </div>
        </div>

      </div>

    </section>

    <!-- ACTION -->
    <section class="space-y-3">
      <?php if ($isFull): ?>
        <div class="text-center bg-gray-200 text-gray-600 py-3 rounded-xl">
          Kuota sudah penuh
        </div>
      <?php else: ?>
        <a href="event-diikuti.php?id=<?= $event['id_event'] ?>"
           class="block text-center bg-blue-600 text-white py-3 rounded-xl
                  text-lg font-semibold hover:bg-blue-700">
          Daftar Event
        </a>
      <?php endif; ?>

      <a
        href="../api/google-calendar/create-event.php?id=<?= $event['id_event'] ?>"
        class="block w-full border border-blue-600 text-blue-600
              py-3 rounded-xl hover:bg-blue-50 text-center text-sm"
      >
        📅 Tambahkan ke Google Calendar
      </a>

    </section>

    <!-- DESKRIPSI -->
    <section class="space-y-3">
      <h3 class="font-semibold text-lg">Deskripsi Event</h3>

      <p class="text-gray-700 leading-relaxed">
        <?= $event['deskripsi'] ?>
      </p>
    </section>

    <!-- BACK -->
    <div class="pt-4">
      <a href="event-list.php" class="text-blue-600 hover:underline">
        ← Kembali ke Lihat Event
      </a>
    </div>

  </main>

</body>
</html>
