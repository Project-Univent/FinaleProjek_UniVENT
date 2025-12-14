<?php
$required_role = 'admin';
require "../autentikasi/cek_login.php";
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Lihat Event — Admin</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    window.AUTH_USER = {
      nama: "<?= htmlspecialchars($_SESSION['nama']) ?>",
      role: "<?= $_SESSION['role'] ?>"
    };
  </script>

  <!-- Admin Shell -->
  <script src="../assets/js/admin/admin-shell.js" defer></script>

  <!-- Halaman Logic -->
  <script src="../assets/js/admin/admin-lihat-event.js" defer></script>
</head>

<body class="bg-gray-100">

  <!-- Injected by JS -->
  <div id="sidebar-container"></div>
  <header id="admin-topbar"></header>

  <!-- MAIN CONTENT -->
  <main id="admin-main" class="p-6 transition-all duration-300">

    <h1 class="text-2xl font-semibold mb-2">Lihat Event</h1>
    <p class="text-gray-600 mb-6">Daftar event yang sudah diverifikasi dan aktif.</p>

    <!-- TABLE WRAPPER -->
    <div class="bg-white rounded-lg shadow p-4 overflow-x-auto">

      <table class="w-full text-sm">
        <thead>
          <tr class="border-b bg-gray-100 text-gray-700">
            <th class="p-2 text-left">#</th>
            <th class="p-2 text-left">Nama Event</th>
            <th class="p-2 text-left">Tanggal</th>
            <th class="p-2 text-left">Lokasi</th>
            <th class="p-2 text-left">Status</th>
            <th class="p-2 text-left">Aksi</th>
          </tr>
        </thead>

        <tbody id="table-event">
          <!-- rows injected by JS -->
        </tbody>
      </table>

    </div>

  </main>

</body>
</html>
