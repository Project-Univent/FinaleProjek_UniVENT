document.addEventListener("DOMContentLoaded", () => {

  const params = new URLSearchParams(window.location.search);
  const eventId = params.get("id") || 1;

  // Dummy event
  const dummyEvent = {
    id_event: eventId,
    nama_event: "Tech Conference 2024",
    tanggal_event: "2024-03-11",
    lokasi: "Aula FTI",
    kategori: "Seminar",
    kuota: 100,
    deskripsi: "Event konferensi teknologi tahunan.",
    status: "menunggu_verifikasi",
    panitia: {
      nama: "Raka Aditya",
      username: "raka123",
      email: "raka@fti.ac.id",
      no_hp: "08123456789"
    }
  };

  // Render info event
  document.getElementById("event-info").innerHTML = `
    <p><strong>Nama Event:</strong> ${dummyEvent.nama_event}</p>
    <p><strong>Tanggal:</strong> ${dummyEvent.tanggal_event}</p>
    <p><strong>Lokasi:</strong> ${dummyEvent.lokasi}</p>
    <p><strong>Kategori:</strong> ${dummyEvent.kategori}</p>
    <p><strong>Kuota:</strong> ${dummyEvent.kuota}</p>
    <p><strong>Status:</strong> ${dummyEvent.status.replace("_", " ")}</p>
    <p><strong>Deskripsi:</strong><br>${dummyEvent.deskripsi}</p>
  `;

  // Render panitia
  document.getElementById("panitia-info").innerHTML = `
    <p><strong>Nama:</strong> ${dummyEvent.panitia.nama}</p>
    <p><strong>Username:</strong> ${dummyEvent.panitia.username}</p>
    <p><strong>Email:</strong> ${dummyEvent.panitia.email}</p>
    <p><strong>No HP:</strong> ${dummyEvent.panitia.no_hp}</p>
  `;

  // Tombol aksi
  document.getElementById("btn-lihat-peserta").onclick = () => {
    window.location.href = "peserta-event.php?event=" + eventId;
  };

  document.getElementById("btn-verifikasi").onclick = () => {
    alert("Event diverifikasi! (dummy)");
  };

  document.getElementById("btn-tolak").onclick = () => {
    const alasan = prompt("Masukkan alasan penolakan:");
    if (alasan) alert("Event ditolak. Alasan: " + alasan);
  };

  document.getElementById("btn-hapus").onclick = () => {
    if (confirm("Yakin hapus event?")) {
      alert("Event dihapus (dummy)");
    }
  };

});
