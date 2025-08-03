document.addEventListener('DOMContentLoaded', function() {
    const eventsContainer = document.getElementById('eventsContainer');
    const prevBtn = document.getElementById('prevEvent');
    const nextBtn = document.getElementById('nextEvent');
    const eventCards = eventsContainer.querySelectorAll('.event-card');
    const numCards = eventCards.length;
    const eventsContainerWrapper = document.getElementById('eventsContainerWrapper'); 

    let currentIndex = 0;

    function updateCarousel() {
        eventCards.forEach(card => {
            card.classList.remove('active');
        });

        const activeCard = eventCards[currentIndex];
        activeCard.classList.add('active');

        const activeCardCenter = activeCard.offsetLeft + (activeCard.offsetWidth / 2);

        const wrapperWidth = eventsContainerWrapper.offsetWidth;

        const translateX = (wrapperWidth / 2) - activeCardCenter;

        eventsContainer.style.transform = `translateX(${translateX}px)`;
    }

    nextBtn.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % numCards; 
        updateCarousel();
    });

    prevBtn.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + numCards) % numCards; 
        updateCarousel();
    });

    if (numCards > 0) { 
        updateCarousel();
    }

    window.addEventListener('resize', updateCarousel);
});

