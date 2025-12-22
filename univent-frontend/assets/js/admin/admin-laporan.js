document.addEventListener("DOMContentLoaded", () => {

  fetch("data/laporan-data.php")
    .then(res => res.json())
    .then(data => {

      /* ================= SUMMARY ================= */
      document.getElementById("summary-cards").innerHTML = `
        <div class="bg-white p-4 rounded shadow text-center">
          <p class="text-gray-500 text-sm">Total Event</p>
          <p class="text-xl font-bold">${data.summary.totalEvent}</p>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
          <p class="text-gray-500 text-sm">Total Peserta</p>
          <p class="text-xl font-bold">${data.summary.totalPeserta}</p>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
          <p class="text-gray-500 text-sm">Event Bulan Ini</p>
          <p class="text-xl font-bold">${data.summary.eventBulanIni}</p>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
          <p class="text-gray-500 text-sm">Tren Aktivitas</p>
          <p class="text-xl font-bold text-green-600">${data.summary.tren}</p>
        </div>
      `;

      /* ================= CHART EVENT ================= */
      new Chart(document.getElementById("chartEvent"), {
        type: "line",
        data: {
          labels: Object.keys(data.event_bulanan).map(b => `Bulan ${b}`),
          datasets: [{
            label: "Event",
            data: Object.values(data.event_bulanan)
          }]
        }
      });

      /* ================= CHART PESERTA ================= */
      new Chart(document.getElementById("chartPeserta"), {
        type: "line",
        data: {
          labels: Object.keys(data.peserta_bulanan).map(b => `Bulan ${b}`),
          datasets: [{
            label: "Peserta",
            data: Object.values(data.peserta_bulanan)
          }]
        }
      });

      /* ================= CHART KATEGORI ================= */
      new Chart(document.getElementById("chartKategori"), {
        type: "bar",
        data: {
          labels: Object.keys(data.kategori),
          datasets: [{
            label: "Peserta",
            data: Object.values(data.kategori)
          }]
        }
      });

      /* ================= TABEL ================= */
      const tbody = document.getElementById("table-laporan");
      tbody.innerHTML = data.tabel.map(e => `
        <tr class="border-b">
          <td class="p-2">${e.nama_event}</td>
          <td class="p-2">${e.tanggal_event}</td>
          <td class="p-2">${e.nama_kategori}</td>
          <td class="p-2">${e.peserta}</td>
          <td class="p-2">${e.status}</td>
          <td class="p-2">
            <span class="text-blue-600 text-sm">Detail</span>
          </td>
        </tr>
      `).join("");

      /* ================= INSIGHT ================= */
      document.getElementById("insight-text").innerHTML = data.insight;

    })
    .catch(err => {
      console.error("Laporan error:", err);
      alert("Gagal memuat laporan");
    });

});
