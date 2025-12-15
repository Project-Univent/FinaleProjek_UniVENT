<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";

/*
  DUMMY DATA STATUS ACARA PANITIA
  Backend nanti:
  SELECT event.*, catatan_admin FROM event WHERE id_panitia = session
*/
$statusAcara = [
  [
    'id_event' => 1,
    'nama_event' => 'Workshop UI/UX 2024',
    'status' => 'tertunda',
    'catatan' => 'Menunggu verifikasi admin'
  ],
  [
    'id_event' => 2,
    'nama_event' => 'Seminar Cybersecurity',
    'status' => 'rejected',
    'catatan' => 'Poster tidak sesuai ketentuan'
  ],
  [
    'id_event' => 3,
    'nama_event' => 'Tech Conference 2024',
    'status' => 'verified',
    'catatan' => 'Acara telah disetujui admin'
  ]
];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Acara - Panitia</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Shell Panitia -->
  <script src="../assets/js/panitia/panitia-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- injected by shell -->
  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <!-- MAIN -->
  <main id="panitia-main" class="p-6 transition-all duration-300">

    <section class="space-y-6">

      <!-- HEADER -->
      <div>
        <h1 class="text-2xl font-semibold">Status Acara</h1>
        <p class="text-sm text-gray-500">
          Lihat status verifikasi acara yang telah kamu buat
        </p>
      </div>

      <!-- GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php if (empty($statusAcara)): ?>
          <div class="col-span-full text-center text-gray-500 py-16">
            Belum ada acara
          </div>
        <?php else: ?>
          <?php foreach ($statusAcara as $e): ?>

            <?php
              $badgeClass = match ($e['status']) {
                'tertunda'  => 'bg-yellow-400',
                'rejected' => 'bg-red-500',
                'verified' => 'bg-green-600',
                default    => 'bg-gray-400'
              };

              $labelStatus = match ($e['status']) {
                'tertunda'  => 'Tertunda',
                'rejected' => 'Ditolak',
                'verified' => 'Diterima',
                default    => 'Unknown'
              };
            ?>

            <div class="bg-white border shadow rounded-xl overflow-hidden">
              <div class="h-40 bg-gray-200"></div>

              <div class="p-4 space-y-2">

                <span class="inline-block px-3 py-1 text-sm rounded-full
                             text-white <?= $badgeClass ?>">
                  <?= $labelStatus ?>
                </span>

                <p class="text-lg font-semibold">
                  <?= htmlspecialchars($e['nama_event']) ?>
                </p>

                <p class="text-sm text-gray-600">
                  <?= htmlspecialchars($e['catatan']) ?>
                </p>

                <?php if ($e['status'] === 'tertunda'): ?>
                  <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                     class="block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Edit Acara
                  </a>

                <?php elseif ($e['status'] === 'rejected'): ?>
                  <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                     class="block text-center bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600">
                    Revisi Acara
                  </a>

                <?php elseif ($e['status'] === 'verified'): ?>
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
