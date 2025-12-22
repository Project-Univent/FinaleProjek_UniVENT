<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$required_role = 'admin';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* =========================
   VALIDASI ID EVENT
========================= */
$id_event = $_GET['event'] ?? null;
if (!$id_event || !is_numeric($id_event)) {
  die("Event tidak valid");
}

/* =========================
   AMBIL NAMA EVENT
========================= */
$stmtEvent = $conn->prepare("
  SELECT nama_event
  FROM event
  WHERE id_event = ?
");
$stmtEvent->bind_param("i", $id_event);
$stmtEvent->execute();
$event = $stmtEvent->get_result()->fetch_assoc();

if (!$event) {
  die("Event tidak ditemukan");
}

/* =========================
   AMBIL PESERTA EVENT
========================= */
$stmt = $conn->prepare("
  SELECT
    p.id_peserta,
    p.username,
    p.email,
    t.id_tiket
  FROM tiket t
  JOIN peserta p ON t.id_peserta = p.id_peserta
  WHERE t.id_event = ?
  ORDER BY p.username ASC
");
$stmt->bind_param("i", $id_event);
$stmt->execute();
$peserta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Peserta Event — Admin</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <script src="../assets/js/admin/admin-shell.js" defer></script>
</head>

<body class="bg-gray-100">

  <div id="sidebar-container"></div>
  <header id="admin-topbar"></header>

  <main id="admin-main" class="ml-64 pt-20 p-8 transition-all duration-300">

    <a href="verifikasi-event.php" class="text-blue-600 underline text-sm">
      ← Kembali
    </a>

    <h1 class="text-2xl font-semibold mt-3 mb-2">Daftar Peserta Event</h1>
    <p class="text-gray-600 mb-6">
      Event: <strong><?= htmlspecialchars($event['nama_event']) ?></strong>
    </p>

    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b bg-gray-100">
            <th class="p-2 text-left">#</th>
            <th class="p-2 text-left">Nama Peserta</th>
            <th class="p-2 text-left">Email</th>
            <th class="p-2 text-left">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (empty($peserta)): ?>
            <tr>
              <td colspan="4" class="p-4 text-center text-gray-500">
                Belum ada peserta terdaftar
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($peserta as $i => $p): ?>
              <tr class="border-b hover:bg-gray-50">
                <td class="p-2"><?= $i + 1 ?></td>
                <td class="p-2"><?= htmlspecialchars($p['username']) ?></td>
                <td class="p-2"><?= htmlspecialchars($p['email']) ?></td>
                <td class="p-2">
                  <form
                    action="hapus-peserta-event.php"
                    method="POST"
                    onsubmit="return confirm('Yakin hapus peserta ini dari event?')"
                  >
                    <input type="hidden" name="id_tiket" value="<?= $p['id_tiket'] ?>">
                    <input type="hidden" name="event" value="<?= $id_event ?>">
                    <button
                      class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </main>

</body>
</html>
