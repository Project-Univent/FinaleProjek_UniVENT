<?php
$required_role = 'panitia';
require "../autentikasi/cek_login.php";

/*
  DUMMY DATA EVENT
  Backend nanti:
  SELECT * FROM event WHERE id_event = $_GET['id'] AND id_panitia = session
*/

$id_event = $_GET['id'] ?? 1;

$event = [
  'id_event' => $id_event,
  'nama_event' => 'Tech Conference 2024',
  'deskripsi' => 'Acara tahunan yang membahas perkembangan teknologi terkini.',
  'tanggal' => '2024-03-15',
  'waktu' => '09:00',
  'lokasi' => 'Aula FTI Universitas',
  'kuota' => 150,
  'poster' => '../assets/img/poster1.jpg'
];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Acara - Panitia</title>

  <!-- Tailwind -->
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

    <section class="max-w-3xl mx-auto space-y-6">

      <a href="status-acara.php"
        class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline">
        ← Kembali ke Status Acara
      </a>

      <div>
        <h1 class="text-2xl font-semibold">Edit Acara</h1>
        <p class="text-sm text-gray-500">Perbarui detail acara</p>
      </div>

      <!-- FORM -->
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
            class="w-full border rounded-lg px-4 py-2
                   file:bg-blue-600 file:text-white file:px-4 file:py-2 file:rounded-lg">
          <p class="text-sm text-gray-500 mt-1">
            Biarkan kosong jika tidak ingin mengganti poster
          </p>
        </div>

        <div>
          <label class="block font-medium mb-2">Nama Acara</label>
          <input type="text" name="nama_event"
            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none"
            value="<?= htmlspecialchars($event['nama_event']) ?>" required>
        </div>

        <div>
          <label class="block font-medium mb-2">Deskripsi Acara</label>
          <textarea name="deskripsi"
            class="w-full border rounded-lg px-4 py-3 h-32 focus:ring-2 focus:ring-blue-600 outline-none"
            required><?= htmlspecialchars($event['deskripsi']) ?></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-medium mb-2">Tanggal</label>
            <input type="date" name="tanggal"
              class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none"
              value="<?= $event['tanggal'] ?>" required>
          </div>

          <div>
            <label class="block font-medium mb-2">Waktu Mulai</label>
            <input type="time" name="waktu"
              class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none"
              value="<?= $event['waktu'] ?>" required>
          </div>
        </div>

        <div>
          <label class="block font-medium mb-2">Lokasi Acara</label>
          <input type="text" name="lokasi"
            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none"
            value="<?= htmlspecialchars($event['lokasi']) ?>" required>
        </div>

        <div>
          <label class="block font-medium mb-2">Kuota Peserta</label>
          <input type="number" name="kuota" min="1"
            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none"
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
