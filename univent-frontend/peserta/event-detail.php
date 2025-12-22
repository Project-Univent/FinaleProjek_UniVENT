<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* =========================
   VALIDASI ID EVENT
========================= */
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
  die("Event tidak ditemukan.");
}

/* =========================
   AMBIL DETAIL EVENT (APPROVED)
========================= */
$sql = "
  SELECT
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.waktu_mulai,
    e.lokasi,
    e.kuota,
    e.poster,
    e.deskripsi,
    k.nama_kategori AS kategori

  FROM event e
  JOIN kategori_event k ON e.id_kategori = k.id_kategori
  WHERE e.id_event = ? AND e.status = 'approved'
  LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
  die("Event tidak ditemukan atau belum disetujui.");
}

/* =========================
   HITUNG KUOTA (AMAN DULU)
   NOTE: tabel peserta belum dibahas
========================= */
$terdaftar = 0; // sementara
$isFull = $terdaftar >= $event['kuota'];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Event - UniVENT</title>

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

  <main id="peserta-main"
        class="p-6 max-w-4xl mx-auto space-y-10 transition-all duration-300">

    <!-- HEADER -->
    <section>
      <h1 class="text-2xl font-bold">Detail Event</h1>
    </section>

    <!-- POSTER -->
    <div class="w-full h-64 rounded-xl overflow-hidden shadow">
      <img
        src="../assets/img/<?= htmlspecialchars($event['poster'] ?? 'default.jpg') ?>"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- TITLE + INFO -->
    <section class="space-y-4">

      <h2 class="text-2xl font-bold">
        <?= htmlspecialchars($event['nama_event']) ?>
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="flex items-center space-x-3">
          <span class="text-xl">📅</span>
          <div>
            <p class="font-medium">Tanggal</p>
            <p class="text-gray-600"><?= htmlspecialchars($event['tanggal_event']) ?></p>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-xl">⏰</span>
          <div>
            <p class="font-medium">Waktu</p>
            <p class="text-gray-600">
              <?= htmlspecialchars($event['waktu_mulai'] ?? '-') ?>
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
              <?= $terdaftar ?> / <?= (int)$event['kuota'] ?> peserta
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
        <a href="daftar-event.php?id=<?= $event['id_event'] ?>"
           class="block text-center bg-blue-600 text-white py-3 rounded-xl
                  text-lg font-semibold hover:bg-blue-700">
          Daftar Event
        </a>
      <?php endif; ?>
    </section>

    <!-- DESKRIPSI -->
    <section class="space-y-3">
      <h3 class="font-semibold text-lg">Deskripsi Event</h3>
      <p class="text-gray-700 leading-relaxed">
        <?= nl2br(htmlspecialchars($event['deskripsi'])) ?>
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
