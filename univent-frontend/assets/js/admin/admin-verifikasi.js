document.addEventListener("DOMContentLoaded", async () => {
  const tbody = document.getElementById("table-verifikasi");

  const STATUS_BADGE = `
    <span class="px-2 py-1 text-xs bg-yellow-500 text-white rounded">
      Pending
    </span>
  `;

  async function loadEvents() {
    try {
      const res = await fetch("data/get-pending-events.php", {
        cache: "no-store"
      });
      const events = await res.json();

      tbody.innerHTML = "";

      if (!events.length) {
        tbody.innerHTML = `
          <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">
              Tidak ada event menunggu verifikasi
            </td>
          </tr>
        `;
        return;
      }

      events.forEach((e, i) => {
        tbody.innerHTML += `
          <tr class="border-b hover:bg-gray-50">
            <td class="p-2">${i + 1}</td>
            <td class="p-2">${e.nama_event}</td>
            <td class="p-2">${e.tanggal_event}</td>
            <td class="p-2">${e.lokasi}</td>
            <td class="p-2">${STATUS_BADGE}</td>
            <td class="p-2 flex flex-wrap gap-2">
              <button
                onclick="lihatDetail(${e.id_event})"
                class="px-3 py-1 bg-blue-600 text-white text-sm rounded">
                Lihat Detail
              </button>
              <button
                onclick="verifikasiEvent(${e.id_event})"
                class="px-3 py-1 bg-green-600 text-white text-sm rounded">
                Verifikasi
              </button>
              <button
                onclick="tolakEvent(${e.id_event})"
                class="px-3 py-1 bg-red-600 text-white text-sm rounded">
                Tolak
              </button>
            </td>
          </tr>
        `;
      });
    } catch (err) {
      console.error(err);
      alert("Gagal memuat data event");
    }
  }

  loadEvents();

  window.lihatDetail = (id) => {
    window.location.href = "event-detail.php?id=" + id;
  };

  window.verifikasiEvent = async (id) => {
    if (!confirm("Yakin verifikasi event ini?")) return;

    const form = new FormData();
    form.append("id_event", id);
    form.append("status", "approved");

    const res = await fetch("data/update-event-status.php", {
      method: "POST",
      body: form,
      cache: "no-store"
    });

    let result;
    try {
      result = await res.json();
    } catch {
      alert("Response server tidak valid");
      return;
    }

    if (result.success) {
      loadEvents();
    } else {
      alert(result.error || "Gagal verifikasi event");
    }
  };

  window.tolakEvent = async (id) => {
    const alasan = prompt("Masukkan alasan penolakan:");
    if (!alasan) return;

    const form = new FormData();
    form.append("id_event", id);
    form.append("status", "rejected");
    form.append("catatan", alasan);

    const res = await fetch("data/update-event-status.php", {
      method: "POST",
      body: form,
      cache: "no-store"
    });

    let result;
    try {
      result = await res.json();
    } catch {
      alert("Response server tidak valid");
      return;
    }

    if (result.success) {
      loadEvents();
    } else {
      alert(result.error || "Gagal menolak event");
    }
  };
});
