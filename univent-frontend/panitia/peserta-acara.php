<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";

/*
  DUMMY DATA
  Backend nanti:
  - ambil event by id_event + id_panitia
  - ambil peserta JOIN user
*/

$id_event = $_GET['id'] ?? 1;

$event = [
  'id_event' => $id_event,
  'nama_event' => 'Tech Conference 2024'
];

$peserta = [
  ['nama' => 'Andi Pratama', 'email' => 'andi@example.com'],
  ['nama' => 'Bunga Sari', 'email' => 'bunga@example.com'],
  ['nama' => 'Dewi Lestari', 'email' => 'dewi@example.com'],
];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Peserta Acara - Panitia</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Shell -->
  <script src="../assets/js/panitia/panitia-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <main id="panitia-main" class="p-6 transition-all duration-300">

    <section class="max-w-4xl mx-auto space-y-6">

      <!-- HEADER -->
      <div>
        <h1 class="text-2xl font-semibold">Peserta Acara</h1>
        <p class="text-sm text-gray-500">
          <?= htmlspecialchars($event['nama_event']) ?> · Total <?= count($peserta) ?> peserta
        </p>
      </div>

      <!-- SEARCH (UI ONLY) -->
      <div>
        <input
          type="text"
          placeholder="Cari peserta berdasarkan nama atau email..."
          class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none">
      </div>

      <!-- TABLE -->
      <div class="bg-white shadow rounded-xl overflow-hidden border">

        <table class="w-full text-left">
          <thead class="bg-gray-100 border-b">
            <tr>
              <th class="py-3 px-4 font-medium text-gray-700">Nama</th>
              <th class="py-3 px-4 font-medium text-gray-700">Email</th>
            </tr>
          </thead>

          <tbody>
            <?php if (empty($peserta)): ?>
              <tr>
                <td colspan="2" class="py-6 text-center text-gray-500">
                  Belum ada peserta terdaftar
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($peserta as $p): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-3 px-4"><?= htmlspecialchars($p['nama']) ?></td>
                  <td class="py-3 px-4"><?= htmlspecialchars($p['email']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>

      </div>

      <!-- BACK -->
      <a href="acara-saya.php"
         class="inline-block text-blue-600 hover:underline text-sm">
        ← Kembali ke Acara Saya
      </a>

    </section>

  </main>

</body>
</html>
