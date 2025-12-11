document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar-container");
  if (!sidebar) return;

  // Ambil nama file halaman saat ini (buang query & hash)
  const currentPage = (() => {
    let file = window.location.pathname.split("/").pop() || "";
    file = file.split("?")[0].split("#")[0];
    return file;
  })();

  function isActive(page) {
    return currentPage === page
      ? "bg-blue-700 font-semibold text-white"
      : "hover:bg-blue-700";
  }

  sidebar.innerHTML = `
    <aside class="w-64 h-screen bg-blue-600 text-white flex flex-col justify-between fixed left-0 top-0">

      <!-- TOP -->
      <div class="p-5">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

        <nav class="flex flex-col gap-2">
          <a href="dashboard.html" class="p-2 rounded ${isActive("dashboard.html")}">
            Dashboard
          </a>

          <a href="verifikasi-event.html" class="p-2 rounded ${isActive("verifikasi-event.html")}">
            Verifikasi Event
          </a>

          <a href="lihat-event.html" class="p-2 rounded ${isActive("lihat-event.html")}">
            Lihat Event
          </a>

          <a href="laporan.html" class="p-2 rounded ${isActive("laporan.html")}">
            Laporan Event
          </a>
        </nav>
      </div>

      <!-- BOTTOM -->
      <div class="p-5">
        <a href="../logout.html"
          class="block p-2 rounded bg-red-600 hover:bg-red-700 text-center">
          Logout
        </a>
      </div>

    </aside>
  `;
});
