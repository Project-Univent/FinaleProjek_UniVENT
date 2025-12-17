const STATUS_LABEL = {
  pending: "menunggu",
  approved: "disetujui",
  rejected: "ditolak"
};

let eventId = null; // ✅ GLOBAL

document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);
  eventId = params.get("id");

  if (!eventId) {
    alert("ID event tidak ditemukan");
    return;
  }

  try {
    const res = await fetch(`data/get-event-detail.php?id=${eventId}`);
    const data = await res.json();

    if (data.error) {
      alert(data.error);
      return;
    }

    document.getElementById("event-info").innerHTML = `
      <p><strong>Nama Event:</strong> ${data.nama_event}</p>
      <p><strong>Tanggal:</strong> ${data.tanggal_event}</p>
      <p><strong>Lokasi:</strong> ${data.lokasi}</p>
      <p><strong>Kategori:</strong> ${data.nama_kategori}</p>
      <p><strong>Kuota:</strong> ${data.kuota}</p>
      <p><strong>Status:</strong> ${STATUS_LABEL[data.status] ?? data.status}</p>
      <p><strong>Deskripsi:</strong><br>${data.deskripsi}</p>
    `;

    document.getElementById("panitia-info").innerHTML = `
      <p><strong>Username:</strong> ${data.panitia_username}</p>
      <p><strong>Email:</strong> ${data.panitia_email}</p>
    `;

    document.getElementById("btn-lihat-peserta").onclick = () => {
      window.location.href = "peserta-event.php?event=" + eventId;
    };

  } catch (err) {
    console.error(err);
    alert("Gagal mengambil data event");
  }
});

// ================= ACTIONS =================
const postStatus = async (status, catatan = null) => {
  const form = new FormData();
  form.append("id_event", eventId); // ✅ sekarang valid
  form.append("status", status);
  if (catatan) form.append("catatan", catatan);

  const res = await fetch("data/update-event-status.php", {
    method: "POST",
    body: form
  });

  const result = await res.json();

  if (result.success) {
    alert("Status event berhasil diupdate");
    location.href = "verifikasi-event.php";
  } else {
    alert(result.error || "Gagal update status");
  }
};

document.getElementById("btn-verifikasi").onclick = () => {
  if (confirm("Yakin verifikasi event ini?")) {
    postStatus("approved");
  }
};

document.getElementById("btn-tolak").onclick = () => {
  const alasan = prompt("Masukkan alasan penolakan:");
  if (alasan) {
    postStatus("rejected", alasan);
  }
};
