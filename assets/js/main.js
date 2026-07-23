/* ===================================================
   main.js – MusicOfEveryone vanilla interactions
   =================================================== */
(function () {
  'use strict';

  /* ---------- Hamburger / Mobile Nav ---------- */
  var hamburger = document.getElementById('hamburger');
  var body = document.body;

  if (hamburger) {
    hamburger.addEventListener('click', function () {
      hamburger.classList.toggle('open');
      body.classList.toggle('nav-open');
      hamburger.setAttribute(
        'aria-expanded',
        hamburger.classList.contains('open') ? 'true' : 'false'
      );
    });

    // Close on nav link click (mobile)
    var navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        hamburger.classList.remove('open');
        body.classList.remove('nav-open');
        hamburger.setAttribute('aria-expanded', 'false');
      });
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && body.classList.contains('nav-open')) {
        hamburger.classList.remove('open');
        body.classList.remove('nav-open');
        hamburger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---------- Active nav highlight based on current page ---------- */
  var currentPath = window.location.pathname.replace(/\/$/, '');
  var navItems = document.querySelectorAll('.nav-menu a');
  navItems.forEach(function (a) {
    var href = a.getAttribute('href');
    if (href && (href === currentPath || href === currentPath + '/')) {
      a.classList.add('active');
    }
  });
  // Always mark home as active on root
  if (currentPath === '' || currentPath === '/' || /index\.php$/.test(currentPath)) {
    var homeLink = document.querySelector('.nav-menu a[href="index.php"], .nav-menu a[href="/"]');
    if (homeLink) homeLink.classList.add('active');
  }

  /* ---------- Smooth scroll for anchor links ---------- */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        var offset = parseInt(getComputedStyle(document.documentElement)
          .getPropertyValue('--header-h'), 10) || 72;
        var top = target.getBoundingClientRect().top + window.pageYOffset - offset - 8;
        window.scrollTo({ top: top, behavior: 'smooth' });
      }
    });
  });

  /* ---------- Header shadow on scroll ---------- */
  var header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 8) {
        header.style.boxShadow = '0 2px 12px rgba(0,0,0,.10)';
      } else {
        header.style.boxShadow = '';
      }
    }, { passive: true });
  }

  /* ---------- Auto-dismiss alerts ---------- */
  var alerts = document.querySelectorAll('.alert');
  alerts.forEach(function (alert) {
    setTimeout(function () {
      alert.style.transition = 'opacity .4s ease';
      alert.style.opacity = '0';
      setTimeout(function () { alert.remove(); }, 400);
    }, 4000);
  });

})();
