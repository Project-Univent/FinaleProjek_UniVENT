<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

// parameter
$q = trim($_GET['q'] ?? '');
$kategori = $_GET['kategori'] ?? '';

// event diacc
$sql = "
  SELECT
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.lokasi,
    e.kuota,
    e.poster,
    k.nama_kategori AS kategori
  FROM event e
  JOIN kategori_event k ON e.id_kategori = k.id_kategori
  WHERE e.status = 'approved'
";

$params = [];
$types  = "";

if ($q !== '') {
  $sql .= " AND (e.nama_event LIKE ? OR e.lokasi LIKE ?)";
  $like = "%$q%";
  $params[] = $like;
  $params[] = $like;
  $types .= "ss";
}

if ($kategori !== '') {
  $sql .= " AND k.nama_kategori = ?";
  $params[] = $kategori;
  $types .= "s";
}

$sql .= " ORDER BY e.tanggal_event ASC";

$stmt = mysqli_prepare($conn, $sql);

if (!empty($params)) {
  mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

// list kategori
$kategoriRes = mysqli_query($conn, "
  SELECT DISTINCT nama_kategori
  FROM kategori_event
  ORDER BY nama_kategori
");
$kategoriList = mysqli_fetch_all($kategoriRes, MYSQLI_ASSOC);
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

    <section>
      <h1 class="text-2xl font-bold">Browse Events</h1>
      <p class="text-sm text-gray-500">Temukan berbagai event menarik</p>
    </section>

<!-- search dan filter -->
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
        <?php foreach ($kategoriList as $row): ?>
          <option value="<?= $row['nama_kategori'] ?>"
            <?= $kategori === $row['nama_kategori'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($row['nama_kategori']) ?>
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

<!-- list event -->
    <section>
      <?php if (empty($events)): ?>
        <div class="text-center text-gray-500 py-20">
          Event tidak ditemukan
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

          <?php foreach ($events as $e): ?>
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">

              <div class="h-40 overflow-hidden relative">
                <img
                  src="../assets/img/<?= htmlspecialchars($e['poster'] ?? 'default.jpg') ?>"
                  class="w-full h-full object-cover"
                >

                <span class="absolute top-3 left-3 bg-blue-100 text-blue-700
                             px-3 py-1 text-xs rounded-full">
                  <?= htmlspecialchars($e['kategori']) ?>
                </span>
              </div>

              <div class="p-4 space-y-2">
                <div class="text-gray-800 font-semibold text-lg">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </div>

                <div class="text-sm text-gray-600">
                  📅 <?= htmlspecialchars($e['tanggal_event']) ?>
                </div>

                <div class="text-sm text-gray-600">
                  📍 <?= htmlspecialchars($e['lokasi']) ?>
                </div>

                <div class="text-sm text-gray-600">
                  👥 Kuota: <?= (int)$e['kuota'] ?> peserta
                </div>

                <a
                  href="event-detail.php?id=<?= $e['id_event'] ?>"
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
