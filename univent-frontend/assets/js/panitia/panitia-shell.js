// panitia-shell.js (stable version — paste ganti file lama)
document.addEventListener("DOMContentLoaded", () => {
  console.clear();
  console.log("panitia-shell loaded (stable)");

  document.body.classList.add("theme-panitia");

  const sidebarContainer = document.getElementById("sidebar-container");
  const topbar = document.getElementById("panitia-topbar");
  const main = document.getElementById("panitia-main");

  if (!sidebarContainer || !topbar || !main) {
    console.warn("panitia-shell: missing containers");
    return;
  }

  // inject sidebar (with inline styles to avoid CSS conflicts)
  sidebarContainer.innerHTML = `
    <aside id="panitia-sidebar"
      style="position:fixed;top:0;left:0;width:16rem;height:100vh;background:var(--sidebar-bg,#1e40af);color:var(--sidebar-text,#fff);z-index:50;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
      <div style="padding:1rem;border-bottom:1px solid rgba(255,255,255,0.06)">
        <div style="display:flex;gap:.6rem;align-items:center">
          <div style="width:40px;height:40px;border-radius:8px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center">💼</div>
          <div>
            <div style="font-weight:700">UniVENT</div>
            <div style="font-weight:600;font-size:.9rem;margin-top:-.2rem">Panitia</div>
          </div>
        </div>
      </div>

      <nav style="padding:1rem;overflow:auto;height:calc(100vh - 112px)">
        <ul style="list-style:none;padding:0;margin:0;display:block;gap:.25rem">
          <li><a href="dashboard.html" style="display:flex;align-items:center;padding:.6rem;border-radius:.5rem;color:inherit;text-decoration:none">🏠 Dashboard</a></li>
          <li><a href="acara-saya.html" style="display:flex;align-items:center;padding:.6rem;border-radius:.5rem;color:inherit;text-decoration:none">📅 Acara Saya</a></li>
          <li><a href="status-acara.html" style="display:flex;align-items:center;padding:.6rem;border-radius:.5rem;color:inherit;text-decoration:none">📊 Status Acara</a></li>
          <li><a href="buat-acara.html" style="display:flex;align-items:center;padding:.6rem;border-radius:.5rem;color:inherit;text-decoration:none">➕ Buat Acara</a></li>
        </ul>
      </nav>

      <div style="padding:1rem;border-top:1px solid rgba(255,255,255,0.06)">
        <a href="../autentikasi/login.html" style="display:block;text-align:center;background:#ef4444;color:#fff;padding:.5rem;border-radius:.5rem;text-decoration:none">Logout</a>
      </div>
    </aside>
  `;

  // inject topbar (inline styles)
  topbar.innerHTML = `
    <div id="topbar-inner" style="position:fixed;top:0;left:16rem;right:0;height:4.5rem;background:var(--navbar-bg,#fff);z-index:40;display:flex;align-items:center;justify-content:space-between;padding:0 1rem;box-shadow:0 1px 4px rgba(0,0,0,0.04)">
      <div>
        <div style="font-weight:600;font-size:1rem">Dashboard Panitia</div>
        <div style="font-size:.85rem;color:var(--text-muted,#6b7280)">Ringkasan acara & aktivitas panitia</div>
      </div>
      <div style="display:flex;align-items:center;gap:.75rem">
        <button style="padding:.5rem;border-radius:.5rem;background:transparent;border:0">🔔</button>
        <div style="width:36px;height:36px;border-radius:999px;background:#e5e7eb;display:flex;align-items:center;justify-content:center">👤</div>
      </div>
    </div>
  `;

  // ensure main offset (in case Tailwind classes conflict)
  main.style.marginLeft = "16rem";
  main.style.paddingTop = "4.5rem";
  main.style.boxSizing = "border-box";

  // Make sure content wrapper exists
  if (!main.querySelector(".panitia-content-wrap")) {
    const wrapper = document.createElement("div");
    wrapper.className = "panitia-content-wrap";
    wrapper.style.padding = "1.5rem";
    // move existing children into wrapper
    while (main.firstChild) {
      wrapper.appendChild(main.firstChild);
    }
    main.appendChild(wrapper);
  }
});


