<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";

/*
  DUMMY DATA ACARA PANITIA
  Backend nanti:
  SELECT * FROM event WHERE id_panitia = session
*/
$eventsPanitia = [
  [
    'id_event' => 1,
    'nama_event' => 'Tech Conference 2024',
    'tanggal_event' => '2024-03-11',
    'lokasi' => 'Aula FTI',
    'poster' => 'poster1.jpg',
    'status' => 'verified'
  ],
  [
    'id_event' => 2,
    'nama_event' => 'Workshop UI/UX',
    'tanggal_event' => '2024-04-02',
    'lokasi' => 'Lab Multimedia',
    'poster' => 'poster2.jpg',
    'status' => 'pending'
  ]
];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acara Saya - Panitia</title>

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
  <main id="panitia-main" class="p-6 space-y-6 transition-all duration-300">

    <!-- HEADER -->
    <section>
      <h1 class="text-2xl font-semibold">Acara Saya</h1>
      <p class="text-sm text-gray-500">
        Daftar acara yang kamu kelola
      </p>
    </section>

    <!-- EVENT GRID -->
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

      <?php if (empty($eventsPanitia)): ?>
        <div class="col-span-full text-center text-gray-500 py-16">
          Kamu belum membuat acara
        </div>
      <?php else: ?>
        <?php foreach ($eventsPanitia as $e): ?>

          <?php
            // badge status
            $statusClass = match ($e['status']) {
              'verified' => 'text-green-600',
              'pending'  => 'text-yellow-600',
              'rejected' => 'text-red-600',
              default    => 'text-gray-500'
            };
          ?>

          <div class="bg-white rounded-xl shadow border overflow-hidden">

            <!-- POSTER -->
            <img src="../assets/img/<?= htmlspecialchars($e['poster']) ?>"
                 class="h-40 w-full object-cover">

            <!-- CONTENT -->
            <div class="p-4 space-y-2">
              <p class="text-lg font-semibold">
                <?= htmlspecialchars($e['nama_event']) ?>
              </p>

              <p class="text-sm text-gray-600">
                📅 <?= $e['tanggal_event'] ?>
              </p>

              <p class="text-sm text-gray-600">
                📍 <?= htmlspecialchars($e['lokasi']) ?>
              </p>

              <p class="text-sm font-semibold <?= $statusClass ?>">
                Status: <?= ucfirst($e['status']) ?>
              </p>

              <a href="edit-acara.php?id=<?= $e['id_event'] ?>"
                 class="block text-center bg-yellow-500 text-white py-2
                        rounded-lg hover:bg-yellow-600 transition">
                Edit Acara
              </a>

              <a href="peserta-acara.php?id=<?= $e['id_event'] ?>"
                 class="block text-center bg-[#2B77D1] text-white py-2
                        rounded-lg hover:bg-[#2566B8] transition">
                Lihat Peserta
              </a>
            </div>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </section>

  </main>

</body>
</html>
