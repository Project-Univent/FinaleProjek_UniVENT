// peserta-shell.js
// tugasnya: inject SIDEBAR + TOPBAR + offset layout peserta

document.addEventListener("DOMContentLoaded", () => {
  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("peserta-topbar");
  const main = document.getElementById("peserta-main");

  if (!sidebarContainer || !topbar || !main) {
    console.warn("peserta-shell: missing elements.");
    return;
  }

  // ambil nama file aktif
  const currentPage = (() => {
    let file = window.location.pathname.split("/").pop() || "";
    return file.split("?")[0].split("#")[0];
  })();

  function isActive(page) {
    return currentPage === page
      ? "bg-white/25 text-white font-semibold"
      : "hover:bg-white/15 text-white/90";
  }

  /* ======================
     SIDEBAR
  ====================== */
  sidebarContainer.innerHTML = `
    <aside id="peserta-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[#265DD5]
             text-white flex flex-col shadow-lg z-50">

      <!-- BRAND -->
      <div class="px-5 py-4 border-b border-white/20">
        <div class="flex items-center gap-3">

          <img
            src="../assets/img/logo.png"
            alt="UniVENT Icon"
            class="w-10 h-10 object-contain"
          />

          <div class="flex flex-col leading-snug">
            <div class="text-sm font-bold tracking-wide">UniVENT</div>
            <div class="text-sm font-semibold -mt-0.5">Peserta</div>
            <div class="text-xs text-white/80">Portal Event Kampus</div>
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
            <a href="event-list.html"
              class="flex items-center gap-3 p-3 rounded transition-colors duration-200 ${isActive("event-list.html")}">
              📚 Lihat Acara
            </a>
          </li>

          <li>
            <a href="event-diikuti.html"
              class="flex items-center gap-3 p-3 rounded transition-colors duration-200 ${isActive("event-diikuti.html")}">
              🎟️ Acara Diikuti
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

  /* ======================
     TOPBAR
  ====================== */
  topbar.innerHTML = `
    <div id="topbar-inner"
      class="fixed top-0 ${TOP_LEFT} right-0 h-16 bg-[#255FE0] text-white shadow
             flex items-center justify-between px-6 z-40">

      <div>
        <div class="text-lg font-semibold">
          Selamat Datang, USER123 👋
        </div>
        <div class="text-xs text-white/80">
          Temukan dan daftarkan dirimu ke berbagai event kampus.
        </div>
      </div>

      <div class="flex items-center gap-4">
        <button class="p-2 rounded hover:bg-white/10">🔔</button>

        <div class="flex items-center gap-3">
          <div class="text-right hidden sm:block">
            <div class="text-sm font-medium">Nama Peserta</div>
            <div class="text-xs text-white/80">peserta@univent.local</div>
          </div>

          <img src="../assets/img/avatar-placeholder.png"
            class="w-9 h-9 rounded-full border bg-white/10" />
        </div>
      </div>
    </div>
  `;

  /* ======================
     MAIN OFFSET
  ====================== */
  main.classList.add(MAIN_ML);
  main.classList.add("pt-20");
});
