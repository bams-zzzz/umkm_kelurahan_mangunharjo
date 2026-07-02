let currentTab = 'pangan'; // Default tab pas web dibuka
let visibleCards = []; // Nyimpen daftar kartu yang lolos filter
let currentIndex = 0;
const allCards = document.querySelectorAll('.card');

// ================= FUNGSI GANTI TAB =================
function switchTab(kategori) {
    currentTab = kategori;
    const tabPangan = document.getElementById('tab-pangan');
    const tabJasa = document.getElementById('tab-jasa');
    const filterPangan = document.getElementById('filter-pangan');
    const filterJasa = document.getElementById('filter-jasa');

    if (kategori === 'pangan') {
        tabPangan.classList.add('active');
        tabJasa.classList.remove('active');
        filterPangan.style.display = 'block';
        filterJasa.style.display = 'none';
    } else {
        tabJasa.classList.add('active');
        tabPangan.classList.remove('active');
        filterJasa.style.display = 'block';
        filterPangan.style.display = 'none';
    }

    // Reset centangan tiap ganti tab biar bersih
    document.querySelectorAll('.filter-cb').forEach(cb => cb.checked = false);
    
    // Jalankan filter
    filterCards();
}

// ================= FUNGSI FILTER LOGIC =================
function filterCards() {
    // Cari checkbox mana aja yang lagi dicentang di dalam tab yang aktif
    const activeCheckboxes = Array.from(document.querySelectorAll(`#filter-${currentTab} .filter-cb:checked`)).map(cb => cb.value);
    
    visibleCards = []; // Kosongkan daftar kartu yang kelihatan

    allCards.forEach(card => {
        const cardTab = card.getAttribute('data-tab');
        const cardCat = card.getAttribute('data-category');

        // Sembunyikan semua kartu secara default
        card.classList.remove('active', 'prev', 'next', 'hidden');
        card.classList.add('d-none'); 

        // Cek apakah kartu ini milik tab yang lagi aktif?
        if (cardTab === currentTab) {
            // Kalau nggak ada yang dicentang, tampilin semua. Kalau ada, cocokkan kategorinya.
            if (activeCheckboxes.length === 0 || activeCheckboxes.includes(cardCat)) {
                card.classList.remove('d-none'); // Munculin kartunya
                visibleCards.push(card); // Masukin ke daftar kartu yang bakal masuk slider
            }
        }
    });

    // Reset posisi slider ke awal tiap kali filter berubah
    currentIndex = 0;
    updateSlider();
}

// ================= FUNGSI SLIDER ALA DJARUM =================
function updateSlider() {
    // Hapus status kartu yang kelihatan dulu
    visibleCards.forEach(card => card.classList.remove('active', 'prev', 'next', 'hidden'));

    if (visibleCards.length === 0) return; // Kalau kosong hasil filternya, stop.

    visibleCards.forEach((card, index) => {
        // Tentukan siapa yang di tengah, kiri, dan kanan berdasarkan array yang lolos filter
        if (index === currentIndex) {
            card.classList.add('active');
        } else if (index === currentIndex - 1 || (currentIndex === 0 && index === visibleCards.length - 1)) {
            card.classList.add('prev');
        } else if (index === currentIndex + 1 || (currentIndex === visibleCards.length - 1 && index === 0)) {
            card.classList.add('next');
        } else {
            card.classList.add('hidden');
        }
    });
}

function slideLeft() {
    if (visibleCards.length <= 1) return;
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : visibleCards.length - 1;
    updateSlider();
}

function slideRight() {
    if (visibleCards.length <= 1) return;
    currentIndex = (currentIndex < visibleCards.length - 1) ? currentIndex + 1 : 0;
    updateSlider();
}

// Klik kartu pinggir untuk geser ke tengah
allCards.forEach(card => {
    card.addEventListener('click', (e) => {
        if(e.target.classList.contains('card-btn')) return; // Abaikan kalau ngeklik tombol
        
        if (card.classList.contains('prev')) slideLeft();
        if (card.classList.contains('next')) slideRight();
    });
});

// ================= FUNGSI MODAL POPUP DINAMIS =================
const modal = document.getElementById('productModal');

// Perhatiin di sini (btn) buat nangkap data dari file product-card.blade.php
// Perhatiin di sini (btn) buat nangkap data dari file product-card.blade.php
function openModal(btn) { 
    const card = btn.closest('.card');
    if (card && card.parentElement && card.parentElement.classList.contains('cards-track')) {
        if (!card.classList.contains('active')) {
            if (card.classList.contains('prev')) slideLeft();
            if (card.classList.contains('next')) slideRight();
            return;
        }
    }

    const title = btn.getAttribute('data-title');
    const img = btn.getAttribute('data-img');
    const author = btn.getAttribute('data-author');
    const deskripsi = btn.getAttribute('data-deskripsi');
    const wa = btn.getAttribute('data-wa');
    const bahan = btn.getAttribute('data-bahan');
    const keunggulan = btn.getAttribute('data-keunggulan');
    const lokasi = btn.getAttribute('data-lokasi');
    
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDeskripsi').innerHTML = `<li>${deskripsi || '-'}</li>`;
    document.getElementById('modalBahan').innerHTML = `<li>${bahan || '-'}</li>`;
    document.getElementById('modalKeunggulan').innerHTML = `<li>${keunggulan || '-'}</li>`;
    document.getElementById('modalLokasi').innerHTML = `<li>${lokasi || '-'}</li>`;
    document.getElementById('modalAuthor').innerHTML = `Dibuat oleh<br>"${author}"`;
    document.getElementById('modalWaBtn').href = `https://wa.me/${wa}`;
    
    const imgContainer = document.getElementById('modalImg');
    if(img) {
        imgContainer.style.background = `url('${img}') center/cover`;
    } else {
        imgContainer.style.background = '#e67e22';
    }

    modal.style.display = 'flex'; 
}

function closeModal() { modal.style.display = 'none'; }

window.onclick = function(event) { 
    if (event.target == modal) { 
        closeModal(); 
    } 
}

// JALANKAN FILTER PERTAMA KALI WEB DIBUKA
filterCards();