// peserta-sidebar.js
// Inject sidebar peserta (fixed, mirror admin behavior)
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar-container");
  if (!sidebar) return;

  const currentPage = (() => {
    let file = window.location.pathname.split("/").pop() || "";
    file = file.split("?")[0].split("#")[0];
    return file;
  })();

  function isActive(page) {
    return currentPage === page
      ? "bg-blue-900 text-white font-semibold"
      : "hover:bg-blue-800 text-white/90";
  }

  sidebar.innerHTML = `
    <aside id="peserta-sidebar"
      class="fixed top-0 left-0 h-screen w-64 bg-[#145AAD] text-white flex flex-col shadow-lg z-50">

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
            <div class="text-sm -mt-1 font-semibold">Peserta</div>
            <div class="text-xs text-white/80 mt-1">Akun Peserta</div>
          </div>
        </div>
      </div>

      <nav class="flex-1 overflow-auto py-4">
        <ul class="px-2 space-y-1">
          <li>
            <a href="dashboard.html" class="flex items-center gap-3 p-3 rounded ${isActive("dashboard.html")}">🏠 Dashboard</a>
          </li>

          <li>
            <a href="event-list.html" class="flex items-center gap-3 p-3 rounded ${isActive("event-list.html")}">📚 Lihat Acara</a>
          </li>

          <li>
            <a href="event-diikuti.html" class="flex items-center gap-3 p-3 rounded ${isActive("event-diikuti.html")}">🎟️ Acara Diikuti</a>
          </li>
        </ul>
      </nav>

      <div class="p-4 border-t border-blue-400">
        <a href="../logout.html" class="block text-center bg-red-600 hover:bg-red-700 p-2 rounded">Logout</a>
      </div>
    </aside>
  `;
});
