// Mobile nav toggle
const navToggle = document.getElementById('navToggle');
const mobileNav = document.getElementById('mobileNav');
navToggle?.addEventListener('click', () => mobileNav.classList.toggle('hidden'));

// Smooth scroll and scrollspy
const navLinks = document.querySelectorAll('.nav-link');
const sections = document.querySelectorAll('main section[id]');

function onScrollSpy() {
  const y = window.scrollY + 120;
  sections.forEach(sec => {
    const top = sec.offsetTop;
    const h = sec.offsetHeight;
    const id = sec.id;
    const link = document.querySelector('.nav-link[href="#' + id + '"]');
    if (!link) return;
    if (y >= top && y < top + h) {
      document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('nav-active'));
      link.classList.add('nav-active');
    }
  });
}
window.addEventListener('scroll', onScrollSpy);
onScrollSpy();

// reveal on scroll (IntersectionObserver)
const reveals = document.querySelectorAll('.reveal');
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) e.target.classList.add('show');
  });
}, { threshold: .12 });
reveals.forEach(r => io.observe(r));

// skill fill animation when skills visible
const skillBlocks = document.querySelectorAll('.skill-fill');
const skillsSection = document.getElementById('skills');
const skillObserver = new IntersectionObserver((entries) => {
  entries.forEach(ent => {
    if (ent.isIntersecting) {
      skillBlocks.forEach(b => {
        const v = b.getAttribute('data-value');
        b.style.width = v + '%';
      });
      skillObserver.disconnect();
    }
  });
}, { threshold: 0.25 });
skillsSection && skillObserver.observe(skillsSection);

// project filtering
const filterBtns = document.querySelectorAll('.filter-btn');
const projCards = document.querySelectorAll('.proj-card');
filterBtns.forEach(b => b.addEventListener('click', () => {
  filterBtns.forEach(x => x.classList.remove('active'));
  b.classList.add('active');
  const f = b.dataset.filter;
  projCards.forEach(card => {
    if (f === 'all' || card.dataset.category === f) card.style.display = '';
    else card.style.display = 'none';
  });
}));

// project modal preview
const openBtns = document.querySelectorAll('.open-project');
const modal = document.getElementById('projModal');
const closeModal = document.getElementById('closeModal');
const modalImg = document.getElementById('modalImg');
const modalTitle = document.getElementById('modalTitle');
const modalDesc = document.getElementById('modalDesc');
const modalTech = document.getElementById('modalTech');
const modalLive = document.getElementById('modalLive');
const modalCode = document.getElementById('modalCode');

function openProjectCard(el) {
  const title = el.dataset.title;
  const img = el.dataset.image;
  const desc = el.dataset.desc;
  const tech = el.dataset.tech;
  modalImg.src = img;
  modalTitle.textContent = title;
  modalDesc.textContent = desc;
  modalTech.textContent = 'Tech: ' + tech;
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

projCards.forEach(card => {
  card.addEventListener('click', (e) => {
    // avoid opening when clicking link inside
    openProjectCard(card);
  });
  card.querySelectorAll('.open-project')?.forEach(b => b.addEventListener('click', (ev) => {
    ev.stopPropagation();
    openProjectCard(card);
  }));
});

closeModal.addEventListener('click', () => { modal.classList.add('hidden'); document.body.style.overflow = ''; });
modal.addEventListener('click', (e) => { if (e.target === modal) { modal.classList.add('hidden'); document.body.style.overflow = ''; } });

// testimonials cycling simple
const quotes = [
  { q: '"Very communicative and reliable during the development and deploying of the website - great at turning ideas into UI."', a: '- Client' },
  { q: '"Attentive to design details and accessible-first thinking - great progress on every project."', a: '- Mentor' }
];
let qIndex = 0;
const quoteEl = document.getElementById('quote');
const quoteAuthor = document.getElementById('quoteAuthor');
setInterval(() => {
  qIndex = (qIndex + 1) % quotes.length;
  quoteEl.classList.add('opacity-0');
  quoteAuthor.classList.add('opacity-0');
  setTimeout(() => {
    quoteEl.textContent = quotes[qIndex].q;
    quoteAuthor.textContent = quotes[qIndex].a;
    quoteEl.classList.remove('opacity-0');
    quoteAuthor.classList.remove('opacity-0');
  }, 300);
}, 5000);

// back-to-top
const toTop = document.getElementById('toTop');
window.addEventListener('scroll', () => {
  if (window.scrollY > 600) toTop.style.display = 'block'; else toTop.style.display = 'none';
});
toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// contact form (placeholder)
function handleContact(e) {
  e.preventDefault();
  alert('Thanks! Message sent (demo). Replace this with real form handling).');
  e.target.reset();
}

// smooth scroll for nav links
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href.startsWith('#')) {
      e.preventDefault();
      const el = document.querySelector(href);
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// small accessibility: close modal on esc
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') { if (!modal.classList.contains('hidden')) { modal.classList.add('hidden'); document.body.style.overflow = ''; } } });

// quick nav active setup for mobile menu links
document.querySelectorAll('.nav-mobile').forEach(link => link.addEventListener('click', () => mobileNav.classList.add('hidden')));