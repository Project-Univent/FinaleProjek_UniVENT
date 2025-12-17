<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* =========================
   ID PESERTA DARI SESSION
========================= */
$id_peserta = $_SESSION['id'] ?? null;

if (!$id_peserta) {
  die("Peserta tidak valid.");
}

/* =========================
   AMBIL EVENT YANG DIIKUTI
   NOTE: ganti nama tabel/kolom
   kalau berbeda di DB lu
========================= */
$sql = "
  SELECT
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.lokasi,
    e.poster
  FROM tiket t
  JOIN event e ON t.id_event = e.id_event
  WHERE t.id_peserta = ?
  ORDER BY e.tanggal_event ASC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_peserta);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$joinedEvents = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Diikuti - UniVENT</title>

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
      <h1 class="text-2xl font-bold">Event yang Kamu Ikuti</h1>
      <p class="text-gray-500 text-sm">
        Event yang telah kamu daftar dan tiketnya tersedia
      </p>
    </section>

    <!-- EVENT GRID -->
    <section>
      <?php if (empty($joinedEvents)): ?>
        <div class="text-center text-gray-500 py-16">
          Kamu belum mendaftar ke event manapun
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

          <?php foreach ($joinedEvents as $e): ?>
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">

              <!-- POSTER -->
              <div class="h-40 overflow-hidden relative">
                <img
                  src="../assets/img/<?= htmlspecialchars($e['poster'] ?? 'default.jpg') ?>"
                  class="w-full h-full object-cover"
                >

                <!-- REMINDER (UI ONLY, nanti bisa calendar) -->
                <span
                  class="absolute top-3 right-3 bg-white/80 p-2 rounded-full
                         shadow text-yellow-500"
                  title="Reminder">
                  🔔
                </span>
              </div>

              <!-- CONTENT -->
              <div class="p-4 space-y-2">
                <div class="text-gray-800 font-semibold text-lg">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </div>

                <div class="flex items-center text-gray-600 text-sm">
                  📅 <span class="ml-2"><?= htmlspecialchars($e['tanggal_event']) ?></span>
                </div>

                <div class="flex items-center text-gray-600 text-sm">
                  📍 <span class="ml-2"><?= htmlspecialchars($e['lokasi']) ?></span>
                </div>

                <p class="text-green-600 font-semibold text-sm mt-1">
                  Sudah Terdaftar ✔
                </p>

                <a
                  href="tiket.php?id=<?= $e['id_event'] ?>"
                  class="block text-center bg-green-600 text-white py-2
                         rounded-lg hover:bg-green-700">
                  Download Tiket
                </a>

                <a
                  href="event-detail.php?id=<?= $e['id_event'] ?>"
                  class="block text-center bg-blue-600 text-white py-2
                         rounded-lg hover:bg-blue-700 mt-2">
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
