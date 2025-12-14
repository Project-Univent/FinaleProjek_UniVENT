document.addEventListener("DOMContentLoaded", () => {

  // Dummy event list (hanya event yang SUDAH diverifikasi)
    const dummyEvents = [
    { id: 1, nama: "Workshop Cybersecurity", tanggal: "2025-12-10", lokasi: "Aula FTI" }, // BERJALAN (hari ini)
    { id: 2, nama: "UI/UX Bootcamp", tanggal: "2025-12-15", lokasi: "Lab Multimedia" },   // UPCOMING
    { id: 3, nama: "Expo Kewirausahaan", tanggal: "2026-01-02", lokasi: "Hall Utama" },   // UPCOMING
    { id: 4, nama: "Webinar Data Science", tanggal: "2025-11-20", lokasi: "Online" }       // SELESAI
    ];


  const today = new Date();
  const tbody = document.getElementById("table-event");

  function getStatus(tanggal) {
    const date = new Date(tanggal);

    if (date.toDateString() === today.toDateString()) return "berjalan";
    if (date > today) return "upcoming";
    return "selesai";
  }

  function statusBadge(status) {
    if (status === "berjalan")
      return `<span class="px-2 py-1 text-xs bg-green-600 text-white rounded">Berjalan</span>`;
    if (status === "upcoming")
      return `<span class="px-2 py-1 text-xs bg-orange-500 text-white rounded">Upcoming</span>`;
    return `<span class="px-2 py-1 text-xs bg-gray-500 text-white rounded">Selesai</span>`;
  }

  function renderTable(data) {
    tbody.innerHTML = "";

    data.forEach((event, i) => {
      const status = getStatus(event.tanggal);

      tbody.innerHTML += `
        <tr class="border-b hover:bg-gray-50">
          <td class="p-2">${i + 1}</td>
          <td class="p-2">${event.nama}</td>
          <td class="p-2">${event.tanggal}</td>
          <td class="p-2">${event.lokasi}</td>

          <td class="p-2">${statusBadge(status)}</td>

          <td class="p-2 flex gap-2">

            <!-- DETAIL SELALU ADA -->
            <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700"
              onclick="lihatDetail(${event.id})">
              Detail
            </button>

            <!-- HAPUS SELALU ADA -->
            <button class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700"
              onclick="hapusEvent(${event.id})">
              Hapus
            </button>

          </td>
        </tr>
      `;
    });
  }

  renderTable(dummyEvents);

  // Event Handlers
  window.lihatDetail = (id) =>
    (location.href = "event-detail.php?id=" + id);

  window.hapusEvent = (id) => {
    if (confirm("Yakin ingin menghapus event ini?")) {
      alert("Event dihapus (dummy). ID: " + id);
    }
  };
});
