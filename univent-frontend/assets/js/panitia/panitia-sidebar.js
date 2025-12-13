// panitia-sidebar.js
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar-container");
  if (!sidebar) return;

  const currentPage = window.location.pathname
    .split("/")
    .pop()
    .split("?")[0];

  function isActive(page) {
    return currentPage === page
      ? "bg-blue-900 text-white font-semibold"
      : "hover:bg-blue-800 text-white/90";
  }

  sidebar.innerHTML = `
    <aside id="panitia-sidebar"
      class="fixed top-0 left-0 h-screen w-64 bg-[#145AAD] text-white flex flex-col shadow-lg z-50">

      <div class="px-5 py-4 border-b border-blue-400">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded bg-white/10 flex items-center justify-center">💼</div>
          <div>
            <div class="text-sm font-bold">UniVENT</div>
            <div class="text-sm -mt-1 font-semibold">Panitia</div>
            <div class="text-xs text-white/80 mt-1">Manajemen Event</div>
          </div>
        </div>
      </div>

      <nav class="flex-1 overflow-auto py-4">
        <ul class="px-2 space-y-1">
          <li>
            <a href="dashboard.html"
              class="flex items-center gap-3 p-3 rounded ${isActive("dashboard.html")}">
              🏠 Dashboard
            </a>
          </li>

          <li>
            <a href="acara-saya.html"
              class="flex items-center gap-3 p-3 rounded ${isActive("acara-saya.html")}">
              📅 Acara Saya
            </a>
          </li>

          <li>
            <a href="status-acara.html"
              class="flex items-center gap-3 p-3 rounded ${isActive("status-acara.html")}">
              📊 Status Acara
            </a>
          </li>

          <li>
            <a href="buat-acara.html"
              class="flex items-center gap-3 p-3 rounded ${isActive("buat-acara.html")}">
              ➕ Buat Acara
            </a>
          </li>
        </ul>
      </nav>

      <div class="p-4 border-t border-blue-400">
        <a href="../autentikasi/login.html"
          class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">
          Logout
        </a>
      </div>
    </aside>
  `;
});
