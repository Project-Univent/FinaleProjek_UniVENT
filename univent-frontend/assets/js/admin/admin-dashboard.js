document.addEventListener("DOMContentLoaded", () => {

  fetch("data/dashboard-data.php")
    .then(res => res.json())
    .then(data => {

            /* ================= ANALITIK HERO ================= */
      const heroContainer = document.getElementById("hero-analytics");

      if (heroContainer && data.analytics && data.analytics.length > 0) {
        heroContainer.innerHTML = "";

        data.analytics.forEach((row, index) => {
          heroContainer.innerHTML += `
            <div class="border rounded-xl p-4 ${index === 0 ? 'border-green-500 bg-green-50' : ''}">
              <div class="text-sm text-gray-500">
                Kategori Event
              </div>

              <div class="text-lg font-semibold">
                ${row.nama_kategori}
              </div>

              <div class="text-2xl font-bold text-blue-600 mt-1">
                ${row.total_peserta} Peserta
              </div>

              ${index === 0
                ? `<div class="text-green-600 text-sm mt-1 font-semibold">
                    ⭐ Paling Diminati
                  </div>`
                : ''}
            </div>
          `;
        });
      }

      /* ================= SUMMARY ================= */
      document.getElementById("stat-total-event").textContent =
        data.stats.totalEvent;

      document.getElementById("stat-total-peserta").textContent =
        data.stats.totalPeserta;

      document.getElementById("stat-total-verified").textContent =
        data.stats.totalVerified;


      /* ================= KATEGORI LIST ================= */
      const kategoriContainer = document.getElementById("kategori-list");
      kategoriContainer.innerHTML = "";

      data.kategori.forEach(k => {
        kategoriContainer.innerHTML += `
          <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
            <div>
              <div class="font-semibold">${k.nama_kategori}</div>
              <div class="text-sm text-gray-500">${k.total_event} event</div>
            </div>
            <div class="text-gray-400">›</div>
          </div>
        `;
      });


      /* ================= CHART EVENT PER TANGGAL ================= */
      const ctxTime = document.getElementById("chart-event-tanggal");

      if (ctxTime && data.time_series && data.time_series.length > 0) {

        // hancurkan chart lama (penting biar ga conflict)
        if (window.chartEventTanggal) {
          window.chartEventTanggal.destroy();
        }

        window.chartEventTanggal = new Chart(ctxTime, {
          type: "line",
          data: {
            labels: data.time_series.map(d => d.tanggal),
            datasets: [{
              label: "Jumlah Event",
              data: data.time_series.map(d => Number(d.jumlah)),
              borderColor: "#2563EB",
              backgroundColor: "rgba(37,99,235,0.2)",
              fill: true,
              tension: 0.35,
              pointRadius: 4,
              pointHoverRadius: 6
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,   // 🔑 KUNCI
            scales: {
              y: {
                beginAtZero: true,
                ticks: { precision: 0 }
              }
            },
            plugins: {
              legend: { display: true }
            }
          }
        });
      }


      /* ================= CHART EVENT PER KATEGORI ================= */
      const ctxKat = document.getElementById("chart-kategori");

      if (ctxKat && data.kategori && data.kategori.length > 0) {

        if (window.chartKategori) {
          window.chartKategori.destroy();
        }

        window.chartKategori = new Chart(ctxKat, {
          type: "bar",
          data: {
            labels: data.kategori.map(k => k.nama_kategori),
            datasets: [{
              label: "Jumlah Event",
              data: data.kategori.map(k => Number(k.total_event)),
              backgroundColor: "#3B82F6"
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true,
                ticks: { precision: 0 }
              }
            },
            plugins: {
              legend: { display: false }
            }
          }
        });
      }

    })
    .catch(err => {
      console.error("Dashboard error:", err);
      alert("Gagal memuat data dashboard");
    });

});
