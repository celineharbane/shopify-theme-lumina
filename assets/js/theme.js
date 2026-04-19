(function () {
	'use strict';

	var root = document.documentElement;

	// Language toggle — persists choice in localStorage.
	var langBtn = document.querySelector('.lang-btn');
	var savedLang = null;
	try { savedLang = localStorage.getItem('jb_lang'); } catch (e) {}
	if (savedLang === 'en' || savedLang === 'fr') {
		root.lang = savedLang;
		if (langBtn) langBtn.textContent = savedLang === 'en' ? 'FR' : 'EN';
	}
	if (langBtn) {
		langBtn.addEventListener('click', function () {
			var isEn = root.lang === 'en';
			root.lang = isEn ? 'fr' : 'en';
			langBtn.textContent = isEn ? 'EN' : 'FR';
			try { localStorage.setItem('jb_lang', root.lang); } catch (e) {}
		});
	}

	// Mobile menu.
	var menuBtn = document.querySelector('.menu-toggle');
	var links = document.querySelector('nav .links');
	if (menuBtn && links) {
		menuBtn.addEventListener('click', function () {
			menuBtn.classList.toggle('open');
			links.classList.toggle('open');
			menuBtn.setAttribute('aria-expanded', links.classList.contains('open'));
		});
		links.querySelectorAll('a').forEach(function (a) {
			a.addEventListener('click', function () {
				menuBtn.classList.remove('open');
				links.classList.remove('open');
				menuBtn.setAttribute('aria-expanded', 'false');
			});
		});
	}

	// Nav background on scroll.
	var nav = document.querySelector('nav');
	if (nav) {
		window.addEventListener('scroll', function () {
			nav.classList.toggle('scrolled', window.scrollY > 60);
		}, { passive: true });
	}

	// Reveal on scroll.
	if ('IntersectionObserver' in window) {
		var obs = new IntersectionObserver(function (entries) {
			entries.forEach(function (e) {
				if (e.isIntersecting) {
					e.target.classList.add('visible');
					obs.unobserve(e.target);
				}
			});
		}, { threshold: 0.1 });
		document.querySelectorAll('.reveal').forEach(function (el) { obs.observe(el); });
	} else {
		document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('visible'); });
	}

	// Hero carousel.
	var heroImgs = document.querySelectorAll('.hero-carousel img');
	if (heroImgs.length > 1) {
		var heroIdx = 0;
		setInterval(function () {
			heroImgs[heroIdx].classList.remove('active');
			heroIdx = (heroIdx + 1) % heroImgs.length;
			heroImgs[heroIdx].classList.add('active');
		}, 4000);
	}

	// Gallery tabs.
	document.querySelectorAll('.gallery-tab').forEach(function (tab) {
		tab.addEventListener('click', function () {
			document.querySelectorAll('.gallery-tab').forEach(function (t) { t.classList.remove('active'); });
			document.querySelectorAll('.gallery-collection').forEach(function (c) { c.classList.remove('active'); });
			tab.classList.add('active');
			var target = document.querySelector('[data-collection="' + tab.dataset.tab + '"]');
			if (target) target.classList.add('active');
		});
	});

	// Lightbox.
	var lb = document.getElementById('lightbox');
	function openLightbox(src) {
		if (!lb) return;
		lb.querySelector('img').src = src;
		lb.classList.add('open');
	}
	function closeLightbox() { if (lb) lb.classList.remove('open'); }
	document.querySelectorAll('[data-lightbox]').forEach(function (el) {
		el.addEventListener('click', function () {
			var img = el.tagName === 'IMG' ? el : el.querySelector('img');
			if (img) openLightbox(img.src);
		});
	});
	if (lb) lb.addEventListener('click', closeLightbox);
	document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeLightbox(); });
})();
