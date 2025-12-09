document.addEventListener("DOMContentLoaded", () => {
  const sidebar = `
    <aside class="w-60 h-screen bg-blue-600 text-white flex flex-col justify-between">
      
      <div>
        <div class="p-6 font-semibold text-xl">UniVENT</div>

        <nav class="px-4 space-y-2">

          <a href="dashboard.html"
            class="menu-item flex items-center space-x-3 px-3 py-2 rounded-lg">
            <span>🏠</span>
            <span>Home</span>
          </a>

          <a href="event-list.html"
            class="menu-item flex items-center space-x-3 px-3 py-2 rounded-lg">
            <span>📅</span>
            <span>Lihat Event</span>
          </a>

          <a href="event-diikuti.html"
            class="menu-item flex items-center space-x-3 px-3 py-2 rounded-lg">
            <span>✔</span>
            <span>Event Diikuti</span>
          </a>

        </nav>
      </div>

      <div class="p-4">
        <a href="../autentikasi/login.html"
          class="flex items-center space-x-3 px-3 py-2 rounded-lg text-orange-300 hover:bg-blue-500">
          <span>🚪</span>
          <span>Logout</span>
        </a>
      </div>

    </aside>
  `;

  document.getElementById("sidebar-container").innerHTML = sidebar;

  const current = window.location.pathname.split("/").pop();
  document.querySelectorAll(".menu-item").forEach(item => {
    if (item.getAttribute("href") === current) {
      item.classList.add("bg-blue-500");
    } else {
      item.classList.add("hover:bg-blue-500");
    }
  });
});
