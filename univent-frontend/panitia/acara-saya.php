<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";
require "../classes/panitia.php";

$id_panitia = $_SESSION['user_id'] ?? null;

if (!$id_panitia) {
  die("Panitia tidak valid");
}

/* ambil data pantitia */
$panitia = new Panitia($conn, $id_panitia);
$eventsPanitia = $panitia->getEventSaya();
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acara Saya - Panitia</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <script src="../assets/js/panitia/panitia-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <main id="panitia-main" class="p-6 space-y-6 transition-all duration-300">

    <section>
      <h1 class="text-2xl font-semibold">Acara Saya</h1>
      <p class="text-sm text-gray-500">
        Daftar acara yang kamu kelola
      </p>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

      <?php if (empty($eventsPanitia)): ?>
        <div class="col-span-full text-center text-gray-500 py-16">
          Kamu belum membuat acara
        </div>
      <?php else: ?>
        <?php foreach ($eventsPanitia as $e): ?>

          <?php
            $statusBadge = match ($e['status']) {
              'approved' => 'bg-green-600',
              'pending'  => 'bg-yellow-400',
              'rejected' => 'bg-red-500',
              default    => 'bg-gray-400'
            };

            $statusLabel = match ($e['status']) {
              'approved' => 'Disetujui',
              'pending'  => 'Menunggu Verifikasi',
              'rejected' => 'Ditolak',
              default    => 'Unknown'
            };
          ?>

          <div class="bg-white rounded-xl shadow border overflow-hidden">

            <div class="h-40 bg-gray-200 overflow-hidden">
              <img
                src="../assets/img/<?= htmlspecialchars($e['poster'] ?? 'default.jpg') ?>"
                class="w-full h-full object-cover"
              >
            </div>

            <div class="p-4 space-y-2">

              <span class="inline-block px-3 py-1 text-sm rounded-full text-white <?= $statusBadge ?>">
                <?= $statusLabel ?>
              </span>

              <p class="text-lg font-semibold">
                <?= htmlspecialchars($e['nama_event']) ?>
              </p>

              <p class="text-sm text-gray-600">
                📅 <?= htmlspecialchars($e['tanggal_event']) ?>
              </p>

              <p class="text-sm text-gray-600">
                📍 <?= htmlspecialchars($e['lokasi']) ?>
              </p>

              <?php if ($e['status'] === 'approved'): ?>

                <a href="peserta-acara.php?id=<?= $e['id_event'] ?>"
                   class="block text-center bg-green-600 text-white py-2
                          rounded-lg hover:bg-green-700 transition">
                  Lihat Peserta
                </a>

                <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                   class="block text-center bg-blue-600 text-white py-2
                          rounded-lg hover:bg-blue-700 transition">
                  Edit Acara
                </a>

              <?php else: ?>

                <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                   class="block text-center bg-yellow-500 text-white py-2
                          rounded-lg hover:bg-yellow-600 transition">
                  Edit / Revisi Acara
                </a>

              <?php endif; ?>

            </div>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </section>

  </main>

</body>
</html>
