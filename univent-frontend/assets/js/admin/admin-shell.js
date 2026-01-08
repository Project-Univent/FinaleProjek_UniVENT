document.addEventListener("DOMContentLoaded", () => {
  const user = window.AUTH_USER;
  if (!user || user.role !== "admin") {
    document.body.innerHTML = "";
    return;
  }

  const namaAdmin = user.nama || "Admin";

  const TOPBAR_COLOR = "#0F4A85";
  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("admin-topbar");
  const main = document.getElementById("admin-main");

  if (!sidebarContainer || !topbar || !main) return;

  const currentFile =
    window.location.pathname.split("/").pop().split("?")[0] || "dashboard.php";

  function activeClass(filename) {
    return currentFile === filename
      ? "bg-white/20 text-white font-semibold"
      : "hover:bg-white/10 text-white/90";
  }

  // SIDEBAR
  sidebarContainer.innerHTML = `
    <aside id="admin-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W}
             bg-[${TOPBAR_COLOR}] text-white flex flex-col shadow-lg z-50
             transform -translate-x-full md:translate-x-0 transition-transform duration-300">

      <div class="px-5 py-4 border-b border-white/20">
        <div class="flex items-center gap-3">
          <img src="../assets/img/logo.png" class="w-10 h-10 object-contain" />
          <div class="leading-snug">
            <div class="text-sm font-bold">UniVENT</div>
            <div class="text-sm font-semibold -mt-0.5">Admin</div>
            <div class="text-xs text-white/80">Manajemen Event</div>
          </div>
        </div>
      </div>

      <nav class="flex-1 overflow-auto py-4">
        <ul class="px-2 space-y-1">
          <li>
            <a href="dashboard.php"
              class="flex items-center gap-3 p-3 rounded ${activeClass("dashboard.php")}">
              🏠 Dashboard
            </a>
          </li>
          <li>
            <a href="verifikasi-event.php"
              class="flex items-center gap-3 p-3 rounded ${activeClass("verifikasi-event.php")}">
              ✔ Verifikasi Event
            </a>
          </li>
          <li>
            <a href="lihat-event.php"
              class="flex items-center gap-3 p-3 rounded ${activeClass("lihat-event.php")}">
              📅 Lihat Event
            </a>
          </li>
          <li>
            <a href="laporan.php"
              class="flex items-center gap-3 p-3 rounded ${activeClass("laporan.php")}">
              📊 Laporan Event
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

  // TOPBAR
  topbar.innerHTML = `
    <div id="topbar-inner"
      class="fixed top-0 left-0 md:${TOP_LEFT} right-0 h-16
             bg-[${TOPBAR_COLOR}] text-white shadow
             flex items-center justify-between px-4 md:px-6 z-40">

      <div class="flex items-center gap-3">
        <!-- TOGGLE BUTTON -->
        <button id="sidebar-toggle"
          class="md:hidden p-2 rounded hover:bg-white/10 text-xl">
          ☰
        </button>

        <div>
          <div class="text-lg font-semibold">
            Selamat Datang, ${namaAdmin} 👋
          </div>
          <div class="text-xs text-white/80 hidden sm:block">
            Kelola dan verifikasi event kampus
          </div>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <img src="../assets/img/avatar-placeholder.png"
          class="w-9 h-9 rounded-full bg-white/10 border" />
      </div>

    </div>
  `;

  // MAIN OFFSET
  main.classList.add("pt-20");
  main.classList.add("md:" + MAIN_ML);

  // TOGGLE LOGIC
  const sidebar = document.getElementById("admin-sidebar");
  const toggleBtn = document.getElementById("sidebar-toggle");

  toggleBtn?.addEventListener("click", () => {
    sidebar.classList.toggle("-translate-x-full");
  });
});
