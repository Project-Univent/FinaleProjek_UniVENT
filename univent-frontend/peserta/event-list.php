<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";

/*
  DUMMY DATA SEMENTARA
  Backend nanti TINGGAL ganti $events dari query database
*/
$events = [
  [
    'id_event' => 1,
    'nama_event' => 'Tech Conference 2024',
    'tanggal_event' => '2024-03-15',
    'lokasi' => 'San Francisco, CA',
    'kuota' => 500,
    'terdaftar' => 450,
    'kategori' => 'Seminar',
    'poster' => 'poster1.jpg',
    'status' => 'verified'
  ],
  [
    'id_event' => 2,
    'nama_event' => 'Internal Panitia Meeting',
    'tanggal_event' => '2024-02-01',
    'lokasi' => 'Ruang Rapat',
    'kuota' => 30,
    'terdaftar' => 10,
    'kategori' => 'Internal',
    'poster' => 'poster2.jpg',
    'status' => 'pending'
  ],
  [
    'id_event' => 3,
    'nama_event' => 'Marketing Workshop',
    'tanggal_event' => '2024-02-10',
    'lokasi' => 'New York, NY',
    'kuota' => 150,
    'terdaftar' => 120,
    'kategori' => 'Workshop',
    'poster' => 'poster3.jpg',
    'status' => 'verified'
  ]
];

/* =========================
   SEARCH + FILTER
========================= */
$q = trim($_GET['q'] ?? '');
$kategori = $_GET['kategori'] ?? '';

$filteredEvents = array_filter($events, function ($e) use ($q, $kategori) {
  if ($e['status'] !== 'verified') return false;

  if ($q) {
    $q = strtolower($q);
    if (
      strpos(strtolower($e['nama_event']), $q) === false &&
      strpos(strtolower($e['lokasi']), $q) === false
    ) return false;
  }

  if ($kategori && $e['kategori'] !== $kategori) return false;

  return true;
});

// list kategori unik
$kategoriList = array_unique(array_map(fn($e) => $e['kategori'], $events));
sort($kategoriList);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Event - UniVENT</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <script src="../assets/js/peserta/peserta-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div id="sidebar-container"></div>
  <header id="peserta-topbar"></header>

  <main id="peserta-main" class="p-6 space-y-10 transition-all duration-300">

    <!-- HEADER -->
    <section>
      <h1 class="text-2xl font-bold">Browse Events</h1>
      <p class="text-sm text-gray-500">Temukan berbagai event menarik</p>
    </section>

    <!-- SEARCH + FILTER -->
    <form method="GET" class="flex flex-wrap gap-4 items-center">

      <input
        type="text"
        name="q"
        value="<?= htmlspecialchars($q) ?>"
        placeholder="Cari nama event / lokasi..."
        class="w-full sm:w-64 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
      >

      <select
        name="kategori"
        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
      >
        <option value="">Semua Kategori</option>
        <?php foreach ($kategoriList as $k): ?>
          <option value="<?= $k ?>" <?= $kategori === $k ? 'selected' : '' ?>>
            <?= $k ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button
        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
        Cari
      </button>

      <?php if ($q || $kategori): ?>
        <a href="event-list.php" class="text-sm text-gray-500 underline">
          Reset
        </a>
      <?php endif; ?>

    </form>

    <!-- EVENT LIST -->
    <section>
      <?php if (empty($filteredEvents)): ?>
        <div class="text-center text-gray-500 py-20">
          Event tidak ditemukan
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

          <?php foreach ($filteredEvents as $e): ?>
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">

              <div class="h-40 overflow-hidden relative">
                <img src="../assets/img/<?= htmlspecialchars($e['poster']) ?>"
                     class="w-full h-full object-cover">

                <span class="absolute top-3 left-3 bg-blue-100 text-blue-700
                             px-3 py-1 text-xs rounded-full">
                  <?= htmlspecialchars($e['kategori']) ?>
                </span>
              </div>

              <div class="p-4 space-y-2">
                <div class="text-gray-800 font-semibold text-lg">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </div>

                <div class="text-sm text-gray-600">📅 <?= $e['tanggal_event'] ?></div>
                <div class="text-sm text-gray-600">📍 <?= htmlspecialchars($e['lokasi']) ?></div>
                <div class="text-sm text-gray-600">
                  👥 <?= $e['terdaftar'] ?> / <?= $e['kuota'] ?> peserta
                </div>

                <a href="event-detail.php?id=<?= $e['id_event'] ?>"
                   class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                  Lihat Detail
                </a>
              </div>

            </div>
          <?php endforeach; ?>

        </div>
      <?php endif; ?>
    </section>

  </main>

</body>
</html>
