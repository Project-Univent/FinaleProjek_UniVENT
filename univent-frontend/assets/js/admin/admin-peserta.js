document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const eventId = params.get("event") || 1;

  // Dummy event name
  const dummyEventName = "Tech Conference 2024";

  // Dummy daftar peserta — nanti diganti API
  const dummyPeserta = [
    { id: 1, nama: "Reza Ardian", email: "reza@mail.com" },
    { id: 2, nama: "Siska Lestari", email: "siska@mail.com" },
    { id: 3, nama: "Fadhil Ramadhan", email: "fadhil@mail.com" },
    { id: 4, nama: "Maulida Putri", email: "maulida@mail.com" },
  ];

  // Set event name
  document.getElementById("event-name").innerText = dummyEventName;

  // Render table
  const tbody = document.getElementById("table-peserta");

  function renderTable(peserta) {
    tbody.innerHTML = "";

    peserta.forEach((p, i) => {
      tbody.innerHTML += `
        <tr class="border-b hover:bg-gray-50">
          <td class="p-2">${i + 1}</td>
          <td class="p-2">${p.nama}</td>
          <td class="p-2">${p.email}</td>
          <td class="p-2">
            <button 
              class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700"
              onclick="lihatDetailPeserta(${p.id})">
              Detail
            </button>
          </td>
        </tr>
      `;
    });
  }

  renderTable(dummyPeserta);

  // Handler klik detail
  window.lihatDetailPeserta = function(id) {
    alert("Detail peserta ID: " + id + " (dummy)");
    // nanti redirect: window.location.href = "peserta-detail.html?id=" + id;
  };
});
