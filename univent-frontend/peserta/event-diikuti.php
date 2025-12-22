<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";
require "../classes/peserta.php";

$id_peserta = $_SESSION['user_id'] ?? null;
if (!$id_peserta) {
  die("Peserta tidak valid.");
}

$peserta = new Peserta($conn, $id_peserta);
$joinedEvents = $peserta->getEventDiikuti();
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

    <section>
      <h1 class="text-2xl font-bold">Event yang Kamu Ikuti</h1>
      <p class="text-gray-500 text-sm">
        Event yang telah kamu daftar dan tiketnya tersedia
      </p>
    </section>

    <section>
      <?php if (empty($joinedEvents)): ?>
        <div class="text-center text-gray-500 py-16">
          Kamu belum mendaftar ke event manapun
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
          <?php foreach ($joinedEvents as $e): ?>
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
              <div class="h-40 overflow-hidden">
                <img
                  src="../assets/img/<?= htmlspecialchars($e['poster'] ?? 'default.jpg') ?>"
                  class="w-full h-full object-cover">
              </div>

              <div class="p-4 space-y-2">
                <div class="font-semibold text-lg">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </div>

                <div class="text-sm text-gray-600">
                  📅 <?= htmlspecialchars($e['tanggal_event']) ?>
                </div>

                <div class="text-sm text-gray-600">
                  📍 <?= htmlspecialchars($e['lokasi']) ?>
                </div>

                <p class="text-green-600 font-semibold text-sm">
                  Sudah Terdaftar ✔
                </p>

              <div class="flex flex-col gap-2 mt-3">

                <a href="tiket.php?id=<?= $e['id_event'] ?>"
                  class="block text-center bg-green-600 text-white py-2 rounded hover:bg-green-700">
                  🎫 Download Tiket
                </a>

                <a href="../google/add-event.php?id=<?= $e['id_event'] ?>"
                  class="block text-center bg-yellow-400 text-white py-2 rounded hover:bg-yellow-500">
                  📅 Tambahkan ke Google Calendar
                </a>

                <a href="event-detail.php?id=<?= $e['id_event'] ?>"
                  class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                  ℹ️ Lihat Detail
                </a>

              </div>

              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

  </main>
</body>
</html>
