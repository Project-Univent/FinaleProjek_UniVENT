<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

$id_panitia = $_SESSION['user_id'] ?? null;
if (!$id_panitia) {
  die("Panitia tidak valid");
}

// cek id event
$id_event = $_GET['id'] ?? null;
if (!$id_event || !is_numeric($id_event)) {
  die("Event tidak valid");
}

// kepemilikan event
$sqlEvent = "
  SELECT id_event, nama_event
  FROM event
  WHERE id_event = ? AND id_panitia = ?
  LIMIT 1
";

$stmt = mysqli_prepare($conn, $sqlEvent);
mysqli_stmt_bind_param($stmt, "ii", $id_event, $id_panitia);
mysqli_stmt_execute($stmt);
$event = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$event) {
  die("Event tidak ditemukan atau bukan milik kamu");
}

$sqlPeserta = "
  SELECT
    p.username AS nama,
    p.email
  FROM tiket t
  JOIN peserta p ON t.id_peserta = p.id_peserta
  WHERE t.id_event = ?
  ORDER BY p.username ASC
";

$stmt = mysqli_prepare($conn, $sqlPeserta);
mysqli_stmt_bind_param($stmt, "i", $id_event);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$peserta = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

  <script src="../assets/js/panitia/panitia-shell.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div id="sidebar-container"></div>
  <header id="panitia-topbar"></header>

  <main id="panitia-main" class="p-6 transition-all duration-300">

    <section class="max-w-4xl mx-auto space-y-6">

      <div>
        <h1 class="text-2xl font-semibold">Peserta Acara</h1>
        <p class="text-sm text-gray-500">
          <?= htmlspecialchars($event['nama_event']) ?> · Total <?= count($peserta) ?> peserta
        </p>
      </div>

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

      <a href="acara-saya.php"
         class="inline-block text-blue-600 hover:underline text-sm">
        ← Kembali ke Acara Saya
      </a>

    </section>

  </main>

</body>
</html>
