// admin-shell.js
// expects:
// <div id="sidebar-container"></div>
// <header id="admin-topbar"></header>
// <main id="admin-main"></main>

document.addEventListener("DOMContentLoaded", () => {
  // =====================
  // CONFIG
  // =====================
  const TOPBAR_COLOR = "#0F4A85";
  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("admin-topbar");
  const main = document.getElementById("admin-main");

  if (!sidebarContainer || !topbar || !main) return;

  const currentFile =
    window.location.pathname.split("/").pop().split("?")[0] || "dashboard.html";

  function activeClass(filename) {
    return currentFile === filename
      ? "bg-white/20 text-white font-semibold"
      : "hover:bg-white/10 text-white/90";
  }
  
  sidebarContainer.innerHTML = `
    <aside id="admin-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[${TOPBAR_COLOR}]
             text-white flex flex-col shadow-lg z-50">

      <!-- HEADER -->
      <div class="px-5 py-4 border-b border-white/20">
        <div class="flex items-center gap-3">
          <img src="../assets/img/logo.png"
               alt="UniVENT Logo"
               class="w-10 h-10 object-contain" />

            <div class="flex flex-col justify-center leading-snug">
              <div class="text-sm font-bold tracking-wide">UniVENT</div>
              <div class="text-sm font-semibold -mt-0.5">Admin</div>
              <div class="text-xs text-white/80">
                Manajemen Event
              </div>
            </div>
        </div>
      </div>

      <!-- MENU -->
      <nav class="flex-1 overflow-auto py-4">
        <ul class="px-2 space-y-1">
          <li>
            <a href="dashboard.html"
              class="flex items-center gap-3 p-3 rounded ${activeClass("dashboard.html")}">
              🏠 Dashboard
            </a>
          </li>

          <li>
            <a href="verifikasi-event.html"
              class="flex items-center gap-3 p-3 rounded ${activeClass("verifikasi-event.html")}">
              ✔ Verifikasi Event
            </a>
          </li>

          <li>
            <a href="lihat-event.html"
              class="flex items-center gap-3 p-3 rounded ${activeClass("lihat-event.html")}">
              📅 Lihat Event
            </a>
          </li>

          <li>
            <a href="laporan.html"
              class="flex items-center gap-3 p-3 rounded ${activeClass("laporan.html")}">
              📊 Laporan Event
            </a>
          </li>
        </ul>
      </nav>

      <!-- LOGOUT -->
      <div class="p-4 border-t border-white/20">
        <a href="../logout.html"
           class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">
          Logout
        </a>
      </div>
    </aside>
  `;

  topbar.innerHTML = `
    <div id="topbar-inner"
      class="fixed top-0 ${TOP_LEFT} right-0 h-16 bg-[${TOPBAR_COLOR}]
             text-white shadow flex items-center justify-between px-6 z-40">

      <!-- LEFT -->
      <div>
        <div id="page-title" class="text-lg font-semibold">Dashboard</div>
        <div id="page-sub" class="text-xs text-white/80">
          Ringkasan & analitik singkat
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
               class="w-9 h-9 rounded-full bg-white/10 border" />
        </div>
      </div>
    </div>
  `;

  main.classList.add(MAIN_ML);
  main.classList.add("pt-20");
});
