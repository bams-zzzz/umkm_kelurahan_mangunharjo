// --- LOGIKA TABS NAVIGASI & FILTER MULTI-KATEGORI ---
const tabBtns = document.querySelectorAll('.tab-btn');
const filterKerajinan = document.getElementById('filter-kerajinan');
const filterPangan = document.getElementById('filter-pangan');
const allCards = document.querySelectorAll('.produk-card');
const allCheckboxes = document.querySelectorAll('.filter-cb');

let currentMain = 'kerajinan'; 

tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        tabBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentMain = btn.getAttribute('data-target');

        if(currentMain === 'kerajinan') {
            filterKerajinan.style.display = 'block';
            filterPangan.style.display = 'none';
        } else {
            filterKerajinan.style.display = 'none';
            filterPangan.style.display = 'block';
        }

        allCheckboxes.forEach(cb => cb.checked = false);
        applyFilter();
    });
});

function applyFilter() {
    const activeCbs = Array.from(document.querySelectorAll(`.filter-cb[data-type="${currentMain}"]:checked`)).map(cb => cb.value);

    allCards.forEach(card => {
        const cardMain = card.getAttribute('data-main');
        const cardCat = card.getAttribute('data-kategori');

        if(cardMain === currentMain) {
            if(activeCbs.length === 0 || activeCbs.includes(cardCat)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        } else {
            card.style.display = 'none';
        }
    });
}

allCheckboxes.forEach(cb => cb.addEventListener('change', applyFilter));

// --- LOGIKA MODAL POP-UP DENGAN DATA DATABASE ---
const modal = document.getElementById('productModal');
const btnDetails = document.querySelectorAll('.btn-detail');
const closeModal = document.getElementById('closeModal');
const backModal = document.getElementById('backModal');
const modalTitle = document.getElementById('modalTitle');
const modalAuthor = document.getElementById('modalAuthor');
const modalImageContainer = document.getElementById('modalImageContainer');

const modalBahan = document.getElementById('modalBahan');
const modalLangkah = document.getElementById('modalLangkah');
const modalFungsi = document.getElementById('modalFungsi');

btnDetails.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        modalTitle.textContent = btn.getAttribute('data-title');
        
        const authorData = btn.getAttribute('data-author');
        modalAuthor.innerHTML = `Dibuat oleh:<br><strong>${authorData}</strong>`;

        // Render Foto di Modal
        const imgUrl = btn.getAttribute('data-img');
        if(imgUrl) {
            modalImageContainer.innerHTML = `<img src="${imgUrl}" style="width:100%; height:100%; object-fit:cover; border-radius:6px;">`;
        } else {
            modalImageContainer.innerHTML = `<span>Foto 1:1</span>`;
        }

        // Ambil data teks panjang dan pecah per baris baru (\n) ke elemen list HTML
        const bahanRaw = btn.getAttribute('data-bahan') || 'Tidak ada informasi alat dan bahan.';
        modalBahan.innerHTML = bahanRaw.split('\n').map(b => b.trim() ? `<li>${b}</li>` : '').join('');

        const langkahRaw = btn.getAttribute('data-langkah') || 'Tidak ada informasi langkah pembuatan.';
        modalLangkah.innerHTML = langkahRaw.split('\n').map(l => l.trim() ? `<li>${l}</li>` : '').join('');

        modalFungsi.textContent = btn.getAttribute('data-fungsi') || 'Tidak ada informasi fungsi kegunaan.';

        modal.style.display = 'flex';
    });
});

function tutupModal() { modal.style.display = 'none'; }
closeModal.addEventListener('click', tutupModal);
backModal.addEventListener('click', tutupModal);
window.addEventListener('click', (e) => { if (e.target === modal) tutupModal(); });

document.getElementById('search-icon').addEventListener('click', () => {
    alert('Gunakan form search bawaan backend atau masukkan input text di navbar untuk memproses pencarian.');
});