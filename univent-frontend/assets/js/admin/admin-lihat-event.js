document.addEventListener("DOMContentLoaded", async () => {

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

    if (!data.length) {
      tbody.innerHTML = `
        <tr>
          <td colspan="6" class="p-4 text-center text-gray-500">
            Belum ada event aktif
          </td>
        </tr>
      `;
      return;
    }

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
            <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700"
              onclick="lihatDetail(${event.id})">
              Detail
            </button>

            <button class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700"
              onclick="hapusEvent(${event.id})">
              Hapus
            </button>
          </td>
        </tr>
      `;
    });
  }

  try {
    const res = await fetch("data/get-approved-events.php");
    const events = await res.json();
    renderTable(events);
  } catch (err) {
    console.error(err);
    alert("Gagal memuat data event");
  }

  window.lihatDetail = (id) =>
    (location.href = "event-detail.php?id=" + id);

  window.hapusEvent = (id) => {
    if (confirm("Yakin ingin menghapus event ini?")) {
      alert("Hapus event belum diaktifkan. ID: " + id);
    }
  };
});
