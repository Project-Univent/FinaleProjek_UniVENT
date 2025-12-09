// Auto active sidebar menu berdasarkan nama file
(function () {
  const current = location.pathname.split("/").pop();
  const navLinks = document.querySelectorAll("#panitiaNav .nav-link");

  navLinks.forEach(a => {
    const href = a.getAttribute("href");

    if (href === current) {
      a.classList.add("bg-white/20", "font-medium");
    } else {
      a.classList.remove("bg-white/20", "font-medium");
    }
  });
})();
