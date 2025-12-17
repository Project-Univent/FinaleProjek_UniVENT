<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

$id_panitia = $_SESSION['user_id'];

$sql = "
  SELECT id_event, nama_event, tanggal_event, lokasi, poster, status
  FROM event
  WHERE id_panitia = ?
  ORDER BY tanggal_event DESC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_panitia);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$eventsPanitia = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
              'approved ' => 'text-green-600',
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
