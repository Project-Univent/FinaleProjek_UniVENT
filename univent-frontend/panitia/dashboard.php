<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* =========================
   VALIDASI SESSION PANITIA
========================= */
$id_panitia = $_SESSION['user_id'] ?? null;

if (!$id_panitia) {
  die("Panitia tidak valid");
}

/* =========================
   STATISTIK
========================= */

/* Total acara */
$qTotal = $conn->prepare("
  SELECT COUNT(*) AS total
  FROM event
  WHERE id_panitia = ?
");
$qTotal->bind_param("i", $id_panitia);
$qTotal->execute();
$totalAcara = $qTotal->get_result()->fetch_assoc()['total'] ?? 0;

/* Acara berjalan (approved & belum lewat) */
$qAktif = $conn->prepare("
  SELECT COUNT(*) AS aktif
  FROM event
  WHERE id_panitia = ?
    AND status = 'approved'
    AND tanggal_event >= CURDATE()
");
$qAktif->bind_param("i", $id_panitia);
$qAktif->execute();
$acaraAktif = $qAktif->get_result()->fetch_assoc()['aktif'] ?? 0;

/* Total peserta */
$qPeserta = $conn->prepare("
  SELECT COUNT(t.id_tiket) AS peserta
  FROM tiket t
  JOIN event e ON t.id_event = e.id_event
  WHERE e.id_panitia = ?
");
$qPeserta->bind_param("i", $id_panitia);
$qPeserta->execute();
$totalPeserta = $qPeserta->get_result()->fetch_assoc()['peserta'] ?? 0;

/* =========================
   ACARA TERBARU (MAX 3)
========================= */
$qEvent = $conn->prepare("
  SELECT id_event, nama_event, tanggal_event, lokasi, poster
  FROM event
  WHERE id_panitia = ?
  ORDER BY id_event DESC
  LIMIT 3
");
$qEvent->bind_param("i", $id_panitia);
$qEvent->execute();
$acaraTerbaru = $qEvent->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Panitia - Univent</title>

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

  <main id="panitia-main" class="p-6 space-y-10 transition-all duration-300">

    <!-- STATISTIK -->
    <section>
      <h2 class="text-lg font-semibold mb-3">Statistik Acara</h2>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-xl p-5">
          <p class="text-gray-500 text-sm">Total Acara</p>
          <p class="text-2xl font-bold"><?= $totalAcara ?></p>
        </div>

        <div class="bg-white shadow rounded-xl p-5">
          <p class="text-gray-500 text-sm">Acara Berjalan</p>
          <p class="text-2xl font-bold"><?= $acaraAktif ?></p>
        </div>

        <div class="bg-white shadow rounded-xl p-5">
          <p class="text-gray-500 text-sm">Peserta Terdaftar</p>
          <p class="text-2xl font-bold"><?= $totalPeserta ?></p>
        </div>
      </div>
    </section>

    <!-- BUTTON -->
    <section>
      <a href="buat-acara.php"
        class="inline-block bg-[#2B77D1] text-white px-6 py-3 rounded-xl font-semibold
              hover:bg-[#2566B8] transition-colors duration-200">
        + Buat Acara Baru
      </a>
    </section>

    <!-- ACARA TERBARU -->
    <section>
      <h2 class="text-lg font-semibold mb-3">Acara Terbaru</h2>

      <?php if (empty($acaraTerbaru)): ?>
        <p class="text-gray-500">Belum ada acara</p>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

          <?php foreach ($acaraTerbaru as $e): ?>
            <div class="bg-white rounded-xl shadow border overflow-hidden">
              <img
                src="../assets/img/<?= htmlspecialchars($e['poster'] ?? 'default.jpg') ?>"
                class="h-40 w-full object-cover">

              <div class="p-4 space-y-2">
                <p class="text-lg font-semibold">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </p>
                <p class="text-sm text-gray-600">
                  📅 <?= htmlspecialchars($e['tanggal_event']) ?>
                </p>
                <p class="text-sm text-gray-600">
                  📍 <?= htmlspecialchars($e['lokasi']) ?>
                </p>

                <a href="acara-saya.php"
                  class="block text-center bg-[#2B77D1] text-white py-2 rounded-lg
                        hover:bg-[#2566B8] transition-colors duration-200">
                  Kelola Acara
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
