function autoSlide(sliderId, delay) {
    const container = document.getElementById(sliderId);
    const slider = container.querySelector('.slider');
    const slides = slider.querySelectorAll('.slide');
    let index = 0;

    setInterval(() => {
        index = (index + 1) % slides.length;
        slider.style.transform = `translateX(-${index * 100}%)`;
    }, delay);
}

function addSwipe(sliderId) {
    const container = document.getElementById(sliderId);
    const slider = container.querySelector('.slider');
    const slides = slider.querySelectorAll('.slide');
    let index = 0;
    let startX = 0;
    let currentX = 0;

    container.addEventListener('touchstart', e => {
        startX = e.touches[0].clientX;
    });

    container.addEventListener('touchmove', e => {
        currentX = e.touches[0].clientX;
    });

    container.addEventListener('touchend', () => {
        let diff = startX - currentX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                index = (index + 1) % slides.length;
            } else {
                index = (index - 1 + slides.length) % slides.length;
            }
            slider.style.transform = `translateX(-${index * 100}%)`;
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    ['sliderA', 'sliderB', 'sliderC'].forEach(id => {
        autoSlide(id, 3000);
        addSwipe(id);
    });
});

function confirmLogout() {
    return confirm("Apakah Anda yakin ingin logout?");
}

document.addEventListener('DOMContentLoaded', () => {
    const logoutLinks = document.querySelectorAll('a[href="logout.php"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            if (!confirmLogout()) {
                e.preventDefault();
            }
        });
    });
});
