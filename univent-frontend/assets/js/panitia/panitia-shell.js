// panitia-shell.js
// expects: <div id="sidebar-container"></div>, <header id="panitia-topbar"></header>, <main id="panitia-main"></main>

document.addEventListener("DOMContentLoaded", () => {
  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("panitia-topbar");
  const main = document.getElementById("panitia-main");

  if (!sidebarContainer || !topbar || !main) {
    console.warn("panitia-shell: missing elements.");
    return;
  }

  const currentPage = window.location.pathname
    .split("/")
    .pop()
    .split("?")[0];

  function isActive(page) {
    return currentPage === page
      ? "bg-white/20 text-white font-semibold"
      : "hover:bg-white/10 text-white/90";
  }

  /* =========================
     SIDEBAR
  ========================== */
  sidebarContainer.innerHTML = `
    <aside id="panitia-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[#145AAD] text-white flex flex-col shadow-lg z-50">

      <!-- HEADER -->
      <div class="px-5 py-4 border-b border-white/20">
        <div class="flex items-center gap-3">

          <img
            src="../assets/img/logo.png"
            alt="UniVENT Icon"
            class="w-10 h-10 object-contain"
          />

          <div class="flex flex-col justify-center leading-snug">
            <div class="text-sm font-bold tracking-wide">UniVENT</div>
            <div class="text-sm font-semibold -mt-0.5">Panitia</div>
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
              class="flex items-center gap-3 p-3 rounded transition-colors duration-200 ${isActive("dashboard.html")}">
              🏠 Dashboard
            </a>
          </li>

          <li>
            <a href="acara-saya.html"
              class="flex items-center gap-3 p-3 rounded transition-colors duration-200 ${isActive("acara-saya.html")}">
              📅 Acara Saya
            </a>
          </li>

          <li>
            <a href="status-acara.html"
              class="flex items-center gap-3 p-3 rounded transition-colors duration-200 ${isActive("status-acara.html")}">
              📊 Status Acara
            </a>
          </li>

          <li>
            <a href="buat-acara.html"
              class="flex items-center gap-3 p-3 rounded transition-colors duration-200 ${isActive("buat-acara.html")}">
              ➕ Buat Acara
            </a>
          </li>
        </ul>
      </nav>

      <!-- LOGOUT -->
      <div class="p-4 border-t border-white/20">
        <a href="../autentikasi/login.html"
          class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">
          Logout
        </a>
      </div>

    </aside>
  `;

  /* =========================
     TOPBAR
  ========================== */
  topbar.innerHTML = `
    <div class="fixed top-0 ${TOP_LEFT} right-0 h-16 bg-[#145AAD] text-white shadow
      flex items-center justify-between px-6 z-40">

      <div>
        <div class="text-lg font-semibold">Dashboard Panitia</div>
        <div class="text-xs text-white/80">
          Kelola acara & peserta event
        </div>
      </div>

      <div class="flex items-center gap-4">
        <button class="p-2 rounded hover:bg-white/10">🔔</button>

        <div class="flex items-center gap-3">
          <div class="text-right hidden sm:block">
            <div class="text-sm font-medium">Nama Panitia</div>
            <div class="text-xs text-white/80">panitia@univent.local</div>
          </div>

          <img src="../assets/img/avatar-placeholder.png"
            class="w-9 h-9 rounded-full border bg-white/10" />
        </div>
      </div>
    </div>
  `;

  /* =========================
     MAIN OFFSET
  ========================== */
  main.classList.add(MAIN_ML);
  main.classList.add("pt-20");
});
