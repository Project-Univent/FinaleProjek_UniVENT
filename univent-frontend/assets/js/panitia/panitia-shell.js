document.addEventListener("DOMContentLoaded", () => {
  const user = window.AUTH_USER;
  const namaPanitia = user?.nama || "Panitia";

  const SIDEBAR_W = "w-64";
  const MAIN_ML = "ml-64";
  const TOP_LEFT = "left-64";

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("panitia-topbar");
  const main = document.getElementById("panitia-main");

  if (!sidebarContainer || !topbar || !main) return;

  const currentPage =
    window.location.pathname.split("/").pop().split("?")[0];

  function isActive(page) {
    return currentPage === page
      ? "bg-white/20 text-white font-semibold"
      : "hover:bg-white/10 text-white/90";
  }

  // SIDEBAR
  sidebarContainer.innerHTML = `
    <aside id="panitia-sidebar"
      class="fixed top-0 left-0 h-screen ${SIDEBAR_W} bg-[#145AAD]
      text-white flex flex-col shadow-lg z-50
      transform -translate-x-full md:translate-x-0
      transition-transform duration-300">

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
        <a href="../autentikasi/logout.php"
          class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">
          Logout
        </a>
      </div>
    </aside>
  `;

  topbar.innerHTML = `
    <div class="fixed top-0 left-0 md:${TOP_LEFT} right-0 h-16 bg-[#145AAD]
      text-white shadow flex items-center justify-between px-4 md:px-6 z-40">

      <!-- KIRI -->
      <div class="flex items-center gap-3">
        <button id="panitia-toggle"
          class="md:hidden p-2 rounded hover:bg-white/10 text-xl">
          ☰
        </button>

        <div>
          <div class="text-lg font-semibold">
            Selamat Datang, ${namaPanitia} 👋
          </div>
          <div class="text-xs text-white/80 hidden sm:block">
            Kelola acara & peserta event
          </div>
        </div>
      </div>

      <!-- KANAN (BELL + PROFILE) -->
      <div class="flex items-center gap-3 relative">
        <!-- NOTIF BELL -->
        <button id="notif-btn" class="relative p-2 rounded hover:bg-white/10">
          🔔
          <span id="notif-dot"
            class="hidden absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- DROPDOWN -->
        <div id="notif-dropdown"
          class="hidden absolute right-0 top-full mt-2 w-80 bg-white text-black
          rounded shadow-lg overflow-hidden z-50">
        </div>

        <!-- AVATAR -->
        <img src="../assets/img/avatar-placeholder.png"
          class="w-9 h-9 rounded-full border bg-white/10 cursor-pointer" />
      </div>
    </div>
  `;


  // MAIN OFFSET
  main.classList.add("pt-20");
  main.classList.add("md:" + MAIN_ML);

  // TOGGLE SIDEBAR (HP)
  const sidebar = document.getElementById("panitia-sidebar");
  const toggleBtn = document.getElementById("panitia-toggle");

  toggleBtn?.addEventListener("click", () => {
    sidebar.classList.toggle("-translate-x-full");
  });

  // NOTIFIKASI LOGIC
  const notifBtn = document.getElementById("notif-btn");
  const notifDropdown = document.getElementById("notif-dropdown");
  const notifDot = document.getElementById("notif-dot");

  notifBtn.addEventListener("click", async (e) => {
    e.stopPropagation();

    if (!notifDropdown.classList.contains("hidden")) {
      notifDropdown.classList.add("hidden");
      return;
    }

    const res = await fetch("data/get-notifikasi.php", {
      cache: "no-store"
    });
    const data = await res.json();

    notifDropdown.innerHTML = "";

    if (!data.length) {
      notifDropdown.innerHTML = `
        <div class="p-4 text-sm text-gray-500">
          Tidak ada notifikasi
        </div>
      `;
    } else {
      data.forEach(n => {
        notifDropdown.innerHTML += `
          <div class="p-3 border-b text-sm">
            <div class="font-semibold">${n.title}</div>
            <div class="text-gray-600">${n.message}</div>
            <div class="text-xs text-gray-400 mt-1">
              ${n.created_at}
            </div>
          </div>
        `;
      });
    }

    notifDropdown.classList.remove("hidden");
    notifDot.classList.add("hidden");
  });

  document.addEventListener("click", () => {
    notifDropdown.classList.add("hidden");
  });

  // CEK NOTIF
  (async function checkNotif() {
    const res = await fetch("data/get-notifikasi.php", {
      cache: "no-store"
    });
    const data = await res.json();

    if (data.length) {
      notifDot.classList.remove("hidden");
    }
  })();
});
