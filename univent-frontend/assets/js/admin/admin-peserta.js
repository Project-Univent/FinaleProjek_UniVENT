document.addEventListener("DOMContentLoaded", () => {
  const tbody = document.getElementById("table-peserta");

  fetch(`data/get-peserta-event.php?event=${EVENT_ID}`)
    .then(res => res.json())
    .then(data => {
      tbody.innerHTML = "";

      if (data.length === 0) {
        tbody.innerHTML = `
          <tr>
            <td colspan="4" class="p-6 text-center text-gray-500">
              Belum ada peserta terdaftar
            </td>
          </tr>
        `;
        return;
      }

      data.forEach((p, i) => {
        tbody.innerHTML += `
          <tr class="border-b hover:bg-gray-50">
            <td class="p-2">${i + 1}</td>
            <td class="p-2">${p.nama}</td>
            <td class="p-2">${p.email}</td>
            <td class="p-2">
              <button
                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700"
                onclick="hapusPeserta(${p.id_peserta})">
                Hapus
              </button>
            </td>
          </tr>
        `;
      });
    })
    .catch(() => {
      tbody.innerHTML = `
        <tr>
          <td colspan="4" class="p-6 text-center text-red-500">
            Gagal memuat data peserta
          </td>
        </tr>
      `;
    });
});

function hapusPeserta(idPeserta) {
  if (!confirm("Yakin mau menghapus peserta ini dari event?")) return;

  fetch("data/hapus-peserta-event.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      id_event: EVENT_ID,
      id_peserta: idPeserta
    })
  })
  .then(res => res.json())
  .then(res => {
    if (res.success) {
      location.reload();
    } else {
      alert(res.message || "Gagal menghapus peserta");
    }
  });
}
