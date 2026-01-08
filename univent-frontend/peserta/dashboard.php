<?php
$required_role = 'peserta';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

// event terdekat
$highlightSql = "
  SELECT
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.lokasi,
    e.poster,
    k.nama_kategori AS kategori
  FROM event e
  JOIN kategori_event k ON e.id_kategori = k.id_kategori
  WHERE e.status = 'approved'
    AND e.tanggal_event >= CURDATE()
  ORDER BY e.tanggal_event ASC
  LIMIT 1
";
$highlightRes = mysqli_query($conn, $highlightSql);
$highlightEvent = mysqli_fetch_assoc($highlightRes);

// rekomeendasievent
$rekomendasiSql = "
  SELECT
    e.id_event,
    e.nama_event,
    e.tanggal_event,
    e.lokasi,
    e.poster
  FROM event e
  WHERE e.status = 'approved'
  ORDER BY e.tanggal_event ASC
  LIMIT 6
";
$rekomendasiRes = mysqli_query($conn, $rekomendasiSql);
$rekomendasiEvents = mysqli_fetch_all($rekomendasiRes, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Peserta - UniVENT</title>

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

<!-- event terdekat -->
    <section>
      <h1 class="text-2xl font-bold">Event Terdekat</h1>
      <p class="text-gray-500 text-sm">
        Event yang akan segera berlangsung. Jangan sampai ketinggalan!
      </p>
    </section>

    <?php if ($highlightEvent): ?>
      <section>
        <a href="event-detail.php?id=<?= $highlightEvent['id_event'] ?>">
          <div class="relative w-full h-56 rounded-xl shadow overflow-hidden">

            <img
              src="../assets/img/<?= htmlspecialchars($highlightEvent['poster'] ?? 'default.jpg') ?>"
              class="w-full h-full object-cover"
            >

            <div class="absolute top-3 left-3 bg-blue-100 text-blue-700
                        px-3 py-1 rounded-full text-sm">
              <?= htmlspecialchars($highlightEvent['kategori']) ?>
            </div>

            <div class="absolute bottom-4 left-4 text-white text-xl
                        font-semibold drop-shadow-lg">
              <?= htmlspecialchars($highlightEvent['nama_event']) ?>
            </div>

          </div>
        </a>
      </section>
    <?php else: ?>
      <div class="text-gray-500 text-center py-10">
        Belum ada event terdekat
      </div>
    <?php endif; ?>

<!-- rekomendasi -->
    <section>
      <h2 class="text-lg font-semibold mb-4">Rekomendasi Event</h2>

      <?php if (empty($rekomendasiEvents)): ?>
        <div class="text-gray-500 text-center py-10">
          Belum ada event tersedia
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

          <?php foreach ($rekomendasiEvents as $e): ?>
            <div class="bg-white rounded-xl border shadow overflow-hidden">

              <img
                src="../assets/img/<?= htmlspecialchars($e['poster'] ?? 'default.jpg') ?>"
                class="h-40 w-full object-cover"
              >

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

                <a
                  href="event-detail.php?id=<?= $e['id_event'] ?>"
                  class="block mt-3 text-center bg-blue-600 text-white py-2
                         rounded-lg hover:bg-blue-700">
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
