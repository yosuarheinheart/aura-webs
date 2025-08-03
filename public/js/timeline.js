// timeline.js

const timelineEvents = [
    {
        title: "Ancient Academy",
        description: "Deskripsi lengkap untuk Ancient Academy. Ini mungkin melibatkan sejarah, tujuan, atau fitur kunci dari akademi tersebut.",
        scrollPosition: 0,
        imageSrc: "asset/home/event1.jpg" // Path relatif ke window.assetBaseUrl
    },
    {
        title: "Artopia",
        description: "Detail tentang Artopia. Jelaskan konsep, acara, atau hasil dari inisiatif Artopia ini.",
        scrollPosition: -800,
        imageSrc: "asset/home/event1.jpg"
    },
    {
        title: "Garden of Honors",
        description: "Informasi mengenai Garden of Honors. Apakah ini tempat penghargaan, galeri, atau sesuatu yang lain? Jelaskan di sini.",
        scrollPosition: -1600,
        imageSrc: "asset/home/event1.jpg"
    },
    {
        title: "COMING SOON",
        description: "Nantikan event menarik lainnya! Detail lebih lanjut akan segera diumumkan.",
        scrollPosition: -2400,
        imageSrc: "asset/home/event_comingsoon.png"
    }
];

let currentTimelineIndex = 0;
const timelineEventImg = document.querySelector('.timeline-event-img');
const timelineDotBtns = document.querySelectorAll('.timeline-dot-btn');
const timelineEventTitle = document.querySelector('.timeline-event-title');
const timelineEventDescription = document.querySelector('.timeline-event-description');

// Fungsi untuk memperbarui tampilan timeline
function updateTimeline() {
    timelineEventImg.style.transform = `translateY(-50%) translateX(${timelineEvents[currentTimelineIndex].scrollPosition}px)`;

    // Menggabungkan base URL dengan path relatif
    timelineEventImg.src = window.assetBaseUrl + timelineEvents[currentTimelineIndex].imageSrc;

    timelineEventTitle.textContent = timelineEvents[currentTimelineIndex].title;
    timelineEventDescription.textContent = timelineEvents[currentTimelineIndex].description;

    timelineDotBtns.forEach((btn, index) => {
        if (index === currentTimelineIndex) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

timelineDotBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        const index = parseInt(e.target.dataset.index);
        currentTimelineIndex = index;
        updateTimeline();
    });
});

document.addEventListener('DOMContentLoaded', () => {
    updateTimeline();
});