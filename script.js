/*const slides = document.querySelectorAll('.about-slider .slide');
const dotsContainer = document.getElementById('sliderDots');
let current = 0;

slides.forEach((_, i) => {
  const dot = document.createElement('div');
  dot.className = 'dot' + (i === 0 ? 'active' : '');
  dot.addEventListener('click', () => goTo(i));
  dotsContainer.appendChild(dot);
});

const dots = document.querySelector('.dot');

function goTo(index) {
  slides[current].classList.remove('active');
  dots[current].classList.remove('active');
  current = index;
  slides[current].classList.add('active');
  dots[current].classList.add('active');
}

setInterval(() => {
  goTo((current + 1) % slides.length);
}, 3000);*/


/* New JavaScript */

// ── IMAGE SLIDER ──
const slides = document.querySelectorAll('.about-slider .slide');
let current = 0;

if (slides.length > 0) {
  setInterval(() => { 
    slides[current].classList.remove('active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('active');
  }, 3000);
}

// ── SCROLL REVEAL ANIMATIONS ──
const revealElements = document.querySelectorAll(
  '.admin-card, .achieve-card, .gallery-grid img, .about-left, .contact-info, .contact-form'
);

revealElements.forEach(el => el.classList.add('reveal'));

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1 });

revealElements.forEach(el => observer.observe(el));

// ── ACTIVE NAV HIGHLIGHT ──

const hamburger = document.getElementById('hamburger');
const nav = document.querySelector('header nav');

hamburger.addEventListener('click', () => {
  nav.classList.toggle('open');
});


const sections = document.querySelectorAll('section');
const navLinks = document.querySelectorAll('header nav a');

window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 100;
    if (window.scrollY >= sectionTop) {
      current = section.getAttribute('id');
    }
  });

  navLinks.forEach(link => {
    link.style.color = '';
    if (link.getAttribute('href') === `#${current}`) {
      link.style.color = '#f0a500';
    }
  });
});

const statNumbers = document.querySelectorAll('.stat h3');
const statsBar = document.querySelector('.stats-bar');

const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      animateCounter(statNumbers[0], 1944);
      animateCounter(statNumbers[1], 27);
      animateCounter(statNumbers[3], 5000);
      statsObserver.disconnect();
    }
  });
}, { threshold: 0.5 });

statsObserver.observe(statsBar);

function animateCounter(element, target) {
  let count = 0;
  const speed = target / 80;
  const timer = setInterval(() => {
    count += speed;
    if (count >= target) {
      element.textContent = target + (element.dataset.suffix || '');
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(count) + (element.dataset.suffix || '');
    }
  }, 20);
}

window.addEventListener('load', () => {
  setTimeout(() => {
    const loader = document.getElementById('loader');
    loader.style.opacity = '0';
    setTimeout(() => loader.style.display = 'none', 500);
  }, 1500);
});

const topBtn = document.getElementById('topBtn');
window.addEventListener('scroll', () => {
  topBtn.style.display = window.scrollY > 500 ? 'block' : 'none';
});
topBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

const themeBtn = document.getElementById('themeToggle');
themeBtn.addEventListener('click', () => {
  document.body.classList.toggle('light-theme');
  themeBtn.textContent = document.body.classList.contains('light-theme') ? '🌙' : '☀️';
});