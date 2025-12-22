<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";
require "../config/koneksi.php";

/* ======================
   VALIDASI PANITIA
====================== */
$id_panitia = $_SESSION['user_id'] ?? null;
if (!$id_panitia) {
  die("Panitia tidak valid");
}

/* ======================
   VALIDASI ID EVENT
====================== */
$id_event = $_GET['id'] ?? null;
if (!$id_event || !is_numeric($id_event)) {
  die("Event tidak ditemukan");
}

/* ======================
   AMBIL DATA EVENT
====================== */
$sql = "
  SELECT id_event, nama_event, deskripsi, tanggal_event, waktu_mulai,
         lokasi, kuota, poster
  FROM event
  WHERE id_event = ? AND id_panitia = ?
  LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id_event, $id_panitia);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
  die("Event tidak ditemukan atau bukan milik kamu");
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Acara - Panitia</title>

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

    <section class="max-w-3xl mx-auto space-y-6">

      <a href="status-acara.php"
        class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Status Acara
      </a>

      <h1 class="text-2xl font-semibold">Edit Acara</h1>

      <form
        action="edit-acara_proses.php"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white shadow rounded-xl p-6 space-y-6"
      >

        <input type="hidden" name="id_event" value="<?= $event['id_event'] ?>">

        <div>
          <label class="block font-medium mb-2">Poster Acara</label>
          <input type="file" name="poster"
            class="w-full border rounded-lg px-4 py-2">
          <p class="text-sm text-gray-500 mt-1">
            Kosongkan jika tidak ingin mengganti poster
          </p>
        </div>

        <div>
          <label class="block font-medium mb-2">Nama Acara</label>
          <input type="text" name="nama_event"
            class="w-full border rounded-lg px-4 py-3"
            value="<?= htmlspecialchars($event['nama_event']) ?>" required>
        </div>

        <div>
          <label class="block font-medium mb-2">Deskripsi</label>
          <textarea name="deskripsi"
            class="w-full border rounded-lg px-4 py-3 h-32"
            required><?= htmlspecialchars($event['deskripsi']) ?></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block font-medium mb-2">Tanggal</label>
            <input type="date" name="tanggal_event"
              class="w-full border rounded-lg px-4 py-3"
              value="<?= $event['tanggal_event'] ?>" required>
          </div>

          <div>
            <label class="block font-medium mb-2">Waktu Mulai</label>
            <input type="time" name="waktu_mulai"
              class="w-full border rounded-lg px-4 py-3"
              value="<?= $event['waktu_mulai'] ?>" required>
          </div>
        </div>

        <div>
          <label class="block font-medium mb-2">Lokasi</label>
          <input type="text" name="lokasi"
            class="w-full border rounded-lg px-4 py-3"
            value="<?= htmlspecialchars($event['lokasi']) ?>" required>
        </div>

        <div>
          <label class="block font-medium mb-2">Kuota</label>
          <input type="number" name="kuota" min="1"
            class="w-full border rounded-lg px-4 py-3"
            value="<?= $event['kuota'] ?>" required>
        </div>

        <button
          class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700">
          Simpan Perubahan
        </button>

      </form>

    </section>

  </main>

</body>
</html>
