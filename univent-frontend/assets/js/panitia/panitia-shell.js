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

  // TOPBAR (STYLE SAMA PESERTA)
  topbar.innerHTML = `
    <div class="fixed top-0 ${TOP_LEFT} right-0 h-16 bg-[#0F4A85] text-white shadow
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

  // MAIN OFFSET
  main.classList.add(MAIN_ML);
  main.classList.add("pt-20");
});
