/* ShineBox front-end behaviour: calculator, before/after sliders,
   mobile nav, smooth scroll and the AJAX booking form. */
(function () {
	'use strict';

	var data = window.ShineBoxData || {};

	/* ---------- Mobile nav ---------- */
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.querySelector('.main-nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', String(open));
		});
		nav.addEventListener('click', function (e) {
			if (e.target.tagName === 'A') {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	/* ---------- Language dropdown ---------- */
	var langSwitch = document.querySelector('[data-lang-switch]');
	if (langSwitch) {
		var langBtn = langSwitch.querySelector('.lang-current');
		var closeLang = function () {
			langSwitch.classList.remove('is-open');
			langBtn.setAttribute('aria-expanded', 'false');
		};
		langBtn.addEventListener('click', function (e) {
			e.stopPropagation();
			var open = langSwitch.classList.toggle('is-open');
			langBtn.setAttribute('aria-expanded', String(open));
		});
		document.addEventListener('click', function (e) {
			if (!langSwitch.contains(e.target)) { closeLang(); }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') { closeLang(); }
		});
	}

	/* ---------- Smooth scroll for in-page anchors ---------- */
	document.querySelectorAll('a[href^="#"]').forEach(function (link) {
		link.addEventListener('click', function (e) {
			var id = link.getAttribute('href');
			if (id.length < 2) { return; }
			var target = document.querySelector(id);
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
		});
	});

	/* ---------- Price calculator ---------- */
	var calc = document.getElementById('calc');
	if (calc) {
		var totalEl = document.getElementById('calc-total');
		var hintEl = document.getElementById('calc-hint');
		var currency = data.currency || '₾';

		function selectedMult() {
			var checked = calc.querySelector('input[name="sb-cartype"]:checked');
			return checked ? parseFloat(checked.dataset.mult) : 1;
		}

		function recalc() {
			var mult = selectedMult();
			var sum = 0;
			var count = 0;
			calc.querySelectorAll('input[name="sb-service"]:checked').forEach(function (cb) {
				sum += parseFloat(cb.dataset.price) || 0;
				count++;
			});
			var total = Math.round(sum * mult);
			totalEl.textContent = total.toLocaleString();
			if (hintEl) { hintEl.style.display = count ? 'none' : ''; }
		}

		calc.addEventListener('change', recalc);
		recalc();

		/* Carry the selection into the booking form when "Book this" is clicked. */
		var bookBtn = document.getElementById('calc-book-btn');
		if (bookBtn) {
			bookBtn.addEventListener('click', function () {
				var labels = [];
				calc.querySelectorAll('input[name="sb-service"]:checked').forEach(function (cb) {
					labels.push(cb.dataset.label);
				});
				var msg = document.getElementById('bf-message');
				if (msg && labels.length) {
					var total = totalEl.textContent;
					msg.value = labels.join(', ') + ' — ≈ ' + total + ' ' + currency;
				}
			});
		}
	}

	/* ---------- Before / after sliders ---------- */
	document.querySelectorAll('.ba-card').forEach(function (card) {
		var range = card.querySelector('.ba-range');
		if (!range) { return; }
		function apply() { card.style.setProperty('--pos', range.value + '%'); }
		range.addEventListener('input', apply);
		apply();
	});

	/* ---------- Booking form (AJAX) ---------- */
	var form = document.getElementById('booking-form');
	if (form && data.ajaxUrl) {
		var status = document.getElementById('form-status');
		var strings = data.strings || {};

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			status.className = 'form-status';
			status.textContent = strings.sending || 'Sending…';

			var body = new FormData(form);
			body.append('action', 'shinebox_booking');
			body.append('nonce', data.nonce);

			fetch(data.ajaxUrl, { method: 'POST', body: body, credentials: 'same-origin' })
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (res && res.success) {
						status.className = 'form-status is-ok';
						status.textContent = strings.success || 'Thanks!';
						form.reset();
					} else {
						throw new Error('failed');
					}
				})
				.catch(function () {
					status.className = 'form-status is-err';
					status.textContent = strings.error || 'Something went wrong.';
				});
		});
	}
})();
