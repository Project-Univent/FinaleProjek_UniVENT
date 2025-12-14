document.addEventListener("DOMContentLoaded", () => {

  // Dummy event pending verifikasi (nanti diganti API fetch)
  const dummyEvents = [
    { id: 1, nama: "Tech Conference 2024", tanggal: "2024-03-11", lokasi: "Aula FTI" },
    { id: 2, nama: "Workshop UI/UX", tanggal: "2024-05-20", lokasi: "Lab Multimedia" },
    { id: 3, nama: "Seminar Kewirausahaan", tanggal: "2024-07-02", lokasi: "Auditorium" }
  ];

  const tbody = document.getElementById("table-verifikasi");

  // Badge status pending
  function statusBadge() {
    return `
      <span class="px-2 py-1 text-xs bg-yellow-500 text-white rounded">
        Pending
      </span>
    `;
  }

  // Render tabel
  function renderTable() {
    tbody.innerHTML = "";

    dummyEvents.forEach((e, i) => {
      tbody.innerHTML += `
        <tr class="border-b hover:bg-gray-50">
          
          <td class="p-2">${i + 1}</td>

          <td class="p-2">${e.nama}</td>

          <td class="p-2">${e.tanggal}</td>

          <td class="p-2">${e.lokasi}</td>

          <td class="p-2">${statusBadge()}</td>

          <td class="p-2 flex flex-wrap gap-2">

            <!-- Detail -->
            <button
              onclick="lihatDetail(${e.id})"
              class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
              Lihat Detail
            </button>

            <!-- Verifikasi -->
            <button
              onclick="verifikasiEvent(${e.id})"
              class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
              Verifikasi
            </button>

            <!-- Tolak -->
            <button
              onclick="tolakEvent(${e.id})"
              class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
              Tolak
            </button>

          </td>
        </tr>
      `;
    });
  }

  renderTable();

  // EVENT HANDLERS
  window.lihatDetail = function(id) {
    window.location.href = "event-detail.php?id=" + id;
  };

  window.verifikasiEvent = function(id) {
    alert("Event berhasil diverifikasi! (dummy), ID: " + id);
    // nanti kirim POST /admin/verifikasi/:id
  };

  window.tolakEvent = function(id) {
    const alasan = prompt("Masukkan alasan penolakan:");
    if (!alasan) return;
    alert("Event ditolak. (dummy)\nAlasan: " + alasan);
    // nanti kirim POST /admin/tolak/:id
  };

});
