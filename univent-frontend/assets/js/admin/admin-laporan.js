document.addEventListener("DOMContentLoaded", () => {

  // DUMMY DATA EVENT (realistic & lengkap)
  const eventData = [
    { nama: "Seminar AI", kategori: "Seminar", tanggal: "2025-01-12", peserta: 120, status: "Selesai" },
    { nama: "Workshop UI/UX", kategori: "Workshop", tanggal: "2025-02-05", peserta: 90, status: "Selesai" },
    { nama: "Webinar Cybersecurity", kategori: "Webinar", tanggal: "2025-03-02", peserta: 180, status: "Berjalan" },
    { nama: "Lomba Startup Pitching", kategori: "Kompetisi", tanggal: "2025-04-20", peserta: 40, status: "Upcoming" }
  ];

  // SUMMARY CARDS
  const summary = {
    totalEvent: eventData.length,
    totalPeserta: eventData.reduce((a, b) => a + b.peserta, 0),
    eventBulanIni: eventData.filter(e => new Date(e.tanggal).getMonth() === new Date().getMonth()).length,
    tren: "+12%"
  };

  document.getElementById("summary-cards").innerHTML = `
    <div class="bg-white p-4 rounded shadow text-center">
      <p class="text-gray-500 text-sm">Total Event</p>
      <p class="text-xl font-bold">${summary.totalEvent}</p>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
      <p class="text-gray-500 text-sm">Total Peserta</p>
      <p class="text-xl font-bold">${summary.totalPeserta}</p>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
      <p class="text-gray-500 text-sm">Event Bulan Ini</p>
      <p class="text-xl font-bold">${summary.eventBulanIni}</p>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
      <p class="text-gray-500 text-sm">Tren Aktivitas</p>
      <p class="text-xl font-bold text-green-600">${summary.tren}</p>
    </div>
  `;

  // ==================== GRAFIK EVENT PER BULAN ====================
  new Chart(document.getElementById("chartEvent"), {
    type: "line",
    data: {
      labels: ["Jan","Feb","Mar","Apr","Mei","Jun"],
      datasets: [{
        label: "Event",
        data: [4, 5, 3, 6, 2, 3],
        borderColor: "rgba(75,192,192,1)",
        backgroundColor: "rgba(75,192,192,0.2)"
      }]
    }
  });

  // ==================== GRAFIK PESERTA PER BULAN ====================
  new Chart(document.getElementById("chartPeserta"), {
    type: "line",
    data: {
      labels: ["Jan","Feb","Mar","Apr","Mei","Jun"],
      datasets: [{
        label: "Peserta",
        data: [300, 450, 380, 520, 410, 480],
        borderColor: "rgba(153,102,255,1)",
        backgroundColor: "rgba(153,102,255,0.2)"
      }]
    }
  });

  // ==================== GRAFIK KATEGORI ====================
  const kategoriCount = {
    Seminar: 12,
    Workshop: 8,
    Webinar: 10,
    Kompetisi: 5
  };

  new Chart(document.getElementById("chartKategori"), {
    type: "bar",
    data: {
      labels: Object.keys(kategoriCount),
      datasets: [{
        label: "Jumlah Event",
        data: Object.values(kategoriCount),
        backgroundColor: [
          "#60a5fa", "#34d399", "#fcd34d", "#f87171"
        ]
      }]
    }
  });

  // ==================== TABEL LAPORAN ====================
  const tbody = document.getElementById("table-laporan");
  tbody.innerHTML = eventData.map((e) => `
    <tr class="border-b">
      <td class="p-2">${e.nama}</td>
      <td class="p-2">${e.tanggal}</td>
      <td class="p-2">${e.kategori}</td>
      <td class="p-2">${e.peserta}</td>
      <td class="p-2">${e.status}</td>
      <td class="p-2">
        <button 
          class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
          Detail
        </button>
      </td>
    </tr>
  `).join("");

  // ==================== INSIGHT ANALITIK ====================
  const insight = `
    • Webinar memiliki partisipasi tertinggi (180 peserta).
    <br>
    • Event Workshop menunjukkan stabilitas minat tinggi.
    <br>
    • Kompetisi memiliki pendaftar paling sedikit, perlu peningkatan promosi.
    <br>
    • Aktivitas event meningkat ${summary.tren} dibanding bulan lalu.
  `;
  document.getElementById("insight-text").innerHTML = insight;

  // ==================== DOWNLOAD CSV ====================
  document.getElementById("downloadCSV").onclick = () => {
    let csv = "nama,tanggal,kategori,peserta,status\n";
    eventData.forEach(e => {
      csv += `${e.nama},${e.tanggal},${e.kategori},${e.peserta},${e.status}\n`;
    });

    const blob = new Blob([csv], { type: "text/csv" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "laporan_event.csv";
    a.click();
  };

});
