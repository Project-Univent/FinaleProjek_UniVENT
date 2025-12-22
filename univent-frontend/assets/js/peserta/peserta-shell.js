// peserta-shell.js
// inject SIDEBAR + TOPBAR + offset layout peserta (RESPONSIF)

document.addEventListener("DOMContentLoaded", () => {
  // ===== USER DARI PHP =====
  const user = window.AUTH_USER;

  if (!user || user.role !== "peserta") {
    document.body.innerHTML = "";
    return;
  }

  const namaPeserta = user.nama || "Peserta";

  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("peserta-topbar");
  const main = document.getElementById("peserta-main");

  if (!sidebarContainer || !topbar || !main) return;

  const currentPage =
    window.location.pathname.split("/").pop().split("?")[0];

  function isActive(page) {
    return currentPage === page
      ? "bg-white/25 text-white font-semibold"
      : "hover:bg-white/15 text-white/90";
  }

  // ===== SIDEBAR =====
  sidebarContainer.innerHTML = `
    <aside id="peserta-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[#265DD5]
      text-white flex flex-col shadow-lg z-50
      transform -translate-x-full md:translate-x-0
      transition-transform duration-300">

      <div class="px-5 py-4 border-b border-white/20">
        <div class="flex items-center gap-3">
          <img src="../assets/img/logo.png" class="w-10 h-10 object-contain" />
          <div class="flex flex-col leading-snug">
            <div class="text-sm font-bold">UniVENT</div>
            <div class="text-sm font-semibold -mt-0.5">Peserta</div>
            <div class="text-xs text-white/80">Portal Event Kampus</div>
          </div>
        </div>
      </div>

      <nav class="flex-1 py-4">
        <ul class="px-2 space-y-1">
          <li>
            <a href="dashboard.php"
              class="flex items-center gap-3 p-3 rounded ${isActive("dashboard.php")}">
              🏠 Dashboard
            </a>
          </li>
          <li>
            <a href="event-list.php"
              class="flex items-center gap-3 p-3 rounded ${isActive("event-list.php")}">
              📚 Lihat Acara
            </a>
          </li>
          <li>
            <a href="event-diikuti.php"
              class="flex items-center gap-3 p-3 rounded ${isActive("event-diikuti.php")}">
              🎟️ Acara Diikuti
            </a>
          </li>
        </ul>
      </nav>

      <div class="p-4 border-t border-white/20">
        <a href="../autentikasi/logout.php"
          class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">
          Logout
        </a>
      </div>
    </aside>
  `;

  // ===== TOPBAR =====
  topbar.innerHTML = `
    <div class="fixed top-0 left-0 md:${TOP_LEFT} right-0 h-16 bg-[#255FE0]
      text-white shadow flex items-center justify-between px-4 md:px-6 z-40">

      <div class="flex items-center gap-3">
        <!-- TOGGLE SIDEBAR (HP) -->
        <button id="peserta-toggle"
          class="md:hidden p-2 rounded hover:bg-white/10 text-xl">
          ☰
        </button>

        <div>
          <div class="text-lg font-semibold">
            Selamat Datang, ${namaPeserta} 👋
          </div>
          <div class="text-xs text-white/80 hidden sm:block">
            Temukan dan daftarkan dirimu ke berbagai event kampus.
          </div>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <img src="../assets/img/avatar-placeholder.png"
          class="w-9 h-9 rounded-full border bg-white/10" />
      </div>
    </div>
  `;

  // ===== MAIN OFFSET =====
  main.classList.add("pt-20");
  main.classList.add("md:" + MAIN_ML);

  // ===== TOGGLE LOGIC =====
  const sidebar = document.getElementById("peserta-sidebar");
  const toggleBtn = document.getElementById("peserta-toggle");

  toggleBtn?.addEventListener("click", () => {
    sidebar.classList.toggle("-translate-x-full");
  });
});
