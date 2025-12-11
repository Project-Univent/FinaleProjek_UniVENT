// admin-shell.js (tailwind-based)
// expects: <div id="sidebar-container"></div>, <header id="admin-topbar"></header>, <main id="admin-main">

document.addEventListener("DOMContentLoaded", () => {
  const SIDEBAR_W = "w-64";       // sidebar width tetap
  const MAIN_ML = "ml-64";        // main content margin
  const TOP_LEFT = "left-64";     // topbar posisi tetap

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("admin-topbar");
  const main = document.getElementById("admin-main");

  if (!sidebarContainer || !topbar || !main) {
    console.warn("admin-shell: missing elements.");
    return;
  }

  const currentFile =
    window.location.pathname.split("/").pop().split("?")[0] ||
    "dashboard.html";

  function activeClass(filename) {
    return currentFile === filename
      ? "bg-blue-900 text-white font-semibold"
      : "hover:bg-blue-800 text-white/90";
  }

  // -----------------------
  // SIDEBAR FIXED TANPA COLLAPSE
  // -----------------------
  sidebarContainer.innerHTML = `
    <aside id="admin-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[#145AAD] text-white flex flex-col shadow-lg transition-all duration-300 z-50">

      <div class="px-5 py-4 border-b border-blue-400">
        <div class="flex items-center gap-3">

          <div class="w-10 h-10 rounded bg-white/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white"
              viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6l4 2"/>
            </svg>
          </div>

          <div>
            <div class="text-sm font-bold">UniVENT</div>
            <div class="text-sm -mt-1 font-semibold">Admin</div>
            <div class="text-xs text-white/80 mt-1">Sistem Manajemen Event</div>
          </div>

        </div>
      </div>

      <nav class="flex-1 overflow-auto py-4">
        <ul class="px-2 space-y-1">
          <li><a href="dashboard.html"
            class="flex items-center gap-3 p-3 rounded ${activeClass("dashboard.html")}">🏠 Dashboard</a></li>

          <li><a href="verifikasi-event.html"
            class="flex items-center gap-3 p-3 rounded ${activeClass("verifikasi-event.html")}">✔ Verifikasi Event</a></li>

          <li><a href="lihat-event.html"
            class="flex items-center gap-3 p-3 rounded ${activeClass("lihat-event.html")}">📅 Lihat Event</a></li>

          <li><a href="laporan.html"
            class="flex items-center gap-3 p-3 rounded ${activeClass("laporan.html")}">📊 Laporan Event</a></li>
        </ul>
      </nav>

      <div class="p-4 border-t border-blue-400">
        <a href="../logout.html"
        class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">Logout</a>
      </div>

    </aside>
  `;

  // -----------------------
  // TOPBAR TANPA HAMBURGER
  // -----------------------
  topbar.innerHTML = `
    <div id="topbar-inner"
      class="fixed top-0 ${TOP_LEFT} right-0 h-16 bg-[#0F4A85] text-white shadow
      flex items-center justify-between px-6 transition-all duration-300 z-40">

      <!-- LEFT -->
      <div class="flex items-center gap-4">
        <div>
          <div id="page-title" class="text-lg font-semibold">Dashboard</div>
          <div id="page-sub" class="text-xs text-white/80">Ringkasan & analitik singkat</div>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="flex items-center gap-4">
        <button class="p-2 rounded hover:bg-white/10">🔔</button>

        <div class="flex items-center gap-3">
          <div class="text-right hidden sm:block">
            <div class="text-sm font-medium">Admin</div>
            <div class="text-xs text-white/80">admin@univent.local</div>
          </div>

          <img src="../assets/img/avatar-placeholder.png"
            class="w-9 h-9 rounded-full border bg-white/10" />
        </div>
      </div>
    </div>
  `;

  // -----------------------
  // MAIN: FIX POSITION
  // -----------------------
  main.classList.add(MAIN_ML);
  main.classList.add("pt-20");
});
