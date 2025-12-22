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
   AMBIL STATUS ACARA
========================= */
$sql = "
  SELECT
    id_event,
    nama_event,
    status,
    catatan_admin
  FROM event
  WHERE id_panitia = ?
  ORDER BY id_event DESC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_panitia);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$statusAcara = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Acara - Panitia</title>

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

  <main id="panitia-main" class="p-6 transition-all duration-300">

    <section class="space-y-6">

      <div>
        <h1 class="text-2xl font-semibold">Status Acara</h1>
        <p class="text-sm text-gray-500">
          Lihat status verifikasi acara yang telah kamu buat
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php if (empty($statusAcara)): ?>
          <div class="col-span-full text-center text-gray-500 py-16">
            Belum ada acara
          </div>
        <?php else: ?>
          <?php foreach ($statusAcara as $e): ?>

            <?php
              $badgeClass = match ($e['status']) {
                'pending'  => 'bg-yellow-400',
                'rejected' => 'bg-red-500',
                'approved' => 'bg-green-600',
                default    => 'bg-gray-400'
              };

              $labelStatus = match ($e['status']) {
                'pending'  => 'Menunggu Verifikasi',
                'rejected' => 'Ditolak',
                'approved' => 'Disetujui',
                default    => 'Unknown'
              };
            ?>

            <div class="bg-white border shadow rounded-xl overflow-hidden">
              <div class="h-40 bg-gray-200"></div>

              <div class="p-4 space-y-2">

                <span class="inline-block px-3 py-1 text-sm rounded-full text-white <?= $badgeClass ?>">
                  <?= $labelStatus ?>
                </span>

                <p class="text-lg font-semibold">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </p>

                <?php if (!empty($e['catatan_admin'])): ?>
                  <p class="text-sm text-gray-600">
                    <?= htmlspecialchars($e['catatan_admin']) ?>
                  </p>
                <?php endif; ?>

                <?php if ($e['status'] === 'pending'): ?>
                  <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                     class="block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Edit Acara
                  </a>

                <?php elseif ($e['status'] === 'rejected'): ?>
                  <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                     class="block text-center bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600">
                    Revisi Acara
                  </a>

                <?php elseif ($e['status'] === 'approved'): ?>
                  <a href="acara-saya.php"
                     class="block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Lihat di Acara Saya
                  </a>
                <?php endif; ?>

              </div>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>

      </div>

    </section>

  </main>

</body>
</html>
