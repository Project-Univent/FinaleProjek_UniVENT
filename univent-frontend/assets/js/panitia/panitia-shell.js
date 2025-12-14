// panitia-shell.js
// inject SIDEBAR + TOPBAR + offset layout panitia

document.addEventListener("DOMContentLoaded", () => {
  // ===== USER DARI PHP =====
  const user = window.AUTH_USER;

  if (!user || user.role !== "panitia") {
    document.body.innerHTML = "";
    return;
  }

  const namaPanitia = user.nama || "Panitia";

  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("panitia-topbar");
  const main = document.getElementById("panitia-main");

  if (!sidebarContainer || !topbar || !main) return;

  const currentPage = window.location.pathname.split("/").pop().split("?")[0];

  function isActive(page) {
    return currentPage === page
      ? "bg-white/20 text-white font-semibold"
      : "hover:bg-white/10 text-white/90";
  }

  sidebarContainer.innerHTML = `
    <aside class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[#145AAD]
           text-white flex flex-col shadow-lg z-50">

      <div class="px-5 py-4 border-b border-white/20">
        <div class="flex items-center gap-3">
          <img src="../assets/img/logo.png" class="w-10 h-10 object-contain" />
          <div class="flex flex-col leading-snug">
            <div class="text-sm font-bold">UniVENT</div>
            <div class="text-sm font-semibold -mt-0.5">Panitia</div>
            <div class="text-xs text-white/80">Manajemen Event</div>
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
            <a href="acara-saya.php"
              class="flex items-center gap-3 p-3 rounded ${isActive("acara-saya.php")}">
              📅 Acara Saya
            </a>
          </li>
          <li>
            <a href="status-acara.php"
              class="flex items-center gap-3 p-3 rounded ${isActive("status-acara.php")}">
              📊 Status Acara
            </a>
          </li>
          <li>
            <a href="buat-acara.php"
              class="flex items-center gap-3 p-3 rounded ${isActive("buat-acara.php")}">
              ➕ Buat Acara
            </a>
          </li>
        </ul>
      </nav>

      <div class="p-4 border-t border-white/20">
        <a href="../auth/logout.php"
          class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">
          Logout
        </a>
      </div>
    </aside>
  `;

  // ===== TOPBAR =====
  topbar.innerHTML = `
    <div class="fixed top-0 ${TOP_LEFT} right-0 h-16 bg-[#145AAD] text-white shadow
         flex items-center justify-between px-6 z-40">

      <div>
        <div class="text-lg font-semibold">
          Selamat Datang, ${namaPanitia} 👋
        </div>
        <div class="text-xs text-white/80">
          Kelola acara & peserta event
        </div>
      </div>

      <div class="flex items-center gap-3">
        <img src="../assets/img/avatar-placeholder.png"
          class="w-9 h-9 rounded-full border bg-white/10" />
      </div>
    </div>
  `;

  main.classList.add(MAIN_ML, "pt-20");
});
