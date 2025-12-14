// admin-dashboard.js
document.addEventListener("DOMContentLoaded", () => {

  // --- DUMMY STATS ---
  const stats = { totalEvent: 11, totalPeserta: 982, totalVerified: 6 };
  document.getElementById("stat-total-event").textContent = stats.totalEvent;
  document.getElementById("stat-total-peserta").textContent = stats.totalPeserta;
  document.getElementById("stat-total-verified").textContent = stats.totalVerified;

  // --- CATEGORIES (dummy) ---
  const kategoriData = [
    { key:'seminar', icon:'school', name:'Seminar', count:3, color:'bg-blue-50 text-blue-600' },
    { key:'workshop', icon:'handyman', name:'Workshop', count:2, color:'bg-green-50 text-green-600' },
    { key:'webinar', icon:'videocam', name:'Webinar', count:5, color:'bg-yellow-50 text-yellow-600' },
    { key:'kompetisi', icon:'emoji_events', name:'Kompetisi', count:1, color:'bg-red-50 text-red-600' }
  ];

  // populate numbers (elements exist)
  document.getElementById('sem-count').textContent = kategoriData[0].count;
  document.getElementById('ws-count').textContent = kategoriData[1].count;
  document.getElementById('wb-count').textContent = kategoriData[2].count;
  document.getElementById('cp-count').textContent = kategoriData[3].count;

  // --- HERO SLIDER DATA (3 slides dummy) ---
  const slides = [
    {
      title: "Hackathon Kompetitif 48 Jam",
      desc: "Acara hackathon paling diminati minggu ini. Tim terbaik dapat hadiah & sertifikat.",
      registrants: 420,
      img: "https://via.placeholder.com/360x220.png?text=Hackathon"
    },
    {
      title: "Seminar Teknologi Masa Depan",
      desc: "Pembicara ahli membahas tren teknologi & karir.",
      registrants: 310,
      img: "https://via.placeholder.com/360x220.png?text=Seminar"
    },
    {
      title: "Workshop UI/UX Modern",
      desc: "Praktik hands-on desain produk & prototyping.",
      registrants: 190,
      img: "https://via.placeholder.com/360x220.png?text=Workshop"
    }
  ];

  // render hero slides
  const heroContainer = document.getElementById('hero-slider');
  const indicators = document.getElementById('hero-indicators');

  slides.forEach((s, i) => {
    const wrap = document.createElement('div');
    wrap.className = 'hero-slide absolute inset-0 p-6 hidden';
    wrap.innerHTML = `
      <div class="flex items-center justify-between gap-6">
        <div class="flex-1 pr-6">
          <div class="text-xs uppercase opacity-80">Featured Event</div>
          <h2 class="text-2xl font-bold mt-2">${s.title}</h2>
          <p class="mt-2 text-sm opacity-90">${s.desc}</p>
          <div class="mt-4 flex items-center gap-3">
            <div class="bg-white/10 px-3 py-2 rounded text-sm">
              <strong>${s.registrants}</strong> pendaftar
            </div>
            <button data-slide="${i}" class="hero-detail-btn bg-white text-blue-700 px-4 py-2 rounded font-semibold">Lihat Detail</button>
          </div>
        </div>
        <div class="w-40 h-28 rounded bg-white/10 flex items-center justify-center">
          <img src="${s.img}" class="object-cover w-36 h-24 rounded" alt="slide-img">
        </div>
      </div>
    `;
    heroContainer.appendChild(wrap);

    // indicator
    const dot = document.createElement('button');
    dot.className = 'w-2 h-2 rounded-full bg-white/50';
    dot.dataset.index = i;
    indicators.appendChild(dot);
  });

  let currentSlide = 0;
  const slideEls = Array.from(document.querySelectorAll('.hero-slide'));
  const dots = Array.from(indicators.children);
  function showSlide(idx) {
    slideEls.forEach((el, i) => {
      el.classList.add('hidden');
      el.classList.remove('slide-active');
      dots[i].classList.remove('bg-white');
      dots[i].classList.add('bg-white/50');
    });
    slideEls[idx].classList.remove('hidden');
    setTimeout(()=> slideEls[idx].classList.add('slide-active'),10);
    dots[idx].classList.remove('bg-white/50');
    dots[idx].classList.add('bg-white');
    currentSlide = idx;
  }
  showSlide(0);

  // autoplay
  let autoplay = setInterval(() => {
    showSlide((currentSlide + 1) % slideEls.length);
  }, 4000);

  // controls
  document.getElementById('hero-prev').addEventListener('click', () => {
    showSlide((currentSlide - 1 + slideEls.length) % slideEls.length);
    resetAutoplay();
  });
  document.getElementById('hero-next').addEventListener('click', () => {
    showSlide((currentSlide + 1) % slideEls.length);
    resetAutoplay();
  });
  indicators.addEventListener('click', (e) => {
    if (e.target.dataset.index) {
      showSlide(Number(e.target.dataset.index));
      resetAutoplay();
    }
  });

  function resetAutoplay(){
    clearInterval(autoplay);
    autoplay = setInterval(()=> showSlide((currentSlide+1)%slideEls.length),4000);
  }

  document.querySelectorAll('.hero-detail-btn').forEach(btn=>{
    btn.addEventListener('click', ()=> window.location.href='lihat-event.php');
  });

  // --- CHARTS (Chart.js) ---
  const ctxReg = document.getElementById('chart-registrasi').getContext('2d');
  const labels = ['Nov 11','Nov 13','Nov 15','Nov 17','Nov 19','Nov 21','Nov 23'];
  const dataReg = [0,12,6,23,10,50,0];

  new Chart(ctxReg, {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label:'Registrasi',
        data:dataReg,
        borderColor:'#34D399',
        backgroundColor:'rgba(52,211,153,0.12)',
        fill:true, tension:0.3, pointRadius:3
      }]
    },
    options:{ responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}
  });

  const ctxKat = document.getElementById('chart-kategori').getContext('2d');
  const katLabels = kategoriData.map(k=>k.name);
  const katVals = kategoriData.map(k=>k.count);

  new Chart(ctxKat, {
    type: 'bar',
    data: { labels:katLabels, datasets:[{label:'Jumlah Peserta', data:katVals, backgroundColor:['#60A5FA','#34D399','#FDE68A','#FB7185']}] },
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}
  });

  // --- Refresh & CSV ---
  document.getElementById('refresh-dashboard').addEventListener('click', ()=>{
    alert('Refresh nanti diganti fetch API. Sekarang dummy.');
  });

  document.getElementById('download-csv').addEventListener('click', ()=>{
    const rows = [
      ['nama_event','tanggal','kategori','peserta','status'],
      ['Hackathon 48','2025-12-01','Kompetisi','420','Berjalan'],
      ['Seminar UI/UX','2025-11-20','Seminar','150','Selesai']
    ];
    const csv = rows.map(r=>r.map(v=>`"${v}"`).join(',')).join('\n');
    const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url; a.download = 'laporan_events.csv'; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
  });

});
