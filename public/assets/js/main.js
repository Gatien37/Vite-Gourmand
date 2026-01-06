document.addEventListener('DOMContentLoaded', () => {
  console.log('✅ main.js exécuté');

  /* ================= MENU BURGER ================= */

  const burger = document.getElementById('burger');
  const nav = document.getElementById('main-nav');

  if (burger && nav) {
    burger.addEventListener('click', () => {
      nav.classList.toggle('nav-open');
    });
  }

  /* ================= AFFICHAGE ADRESSE LIVRAISON ================= */

  const receptionRadios = document.querySelectorAll('input[name="reception"]');
  const livraisonAdresse = document.querySelector('.livraison-adresse');

  const adresse = document.getElementById('adresse');
  const ville = document.getElementById('ville');
  const codePostal = document.getElementById('code_postal');

  function toggleLivraisonAdresse() {
    const selected = document.querySelector('input[name="reception"]:checked');
    if (!livraisonAdresse) return;

    const isLivraison = selected && selected.value === 'livraison';

    livraisonAdresse.classList.toggle('is-hidden', !isLivraison);

    if (adresse && ville && codePostal) {
      adresse.required = isLivraison;
      ville.required = isLivraison;
      codePostal.required = isLivraison;
    }
  }

  receptionRadios.forEach(radio =>
    radio.addEventListener('change', toggleLivraisonAdresse)
  );

  toggleLivraisonAdresse();

  /* ================= CALCUL PRIX COMMANDE ================= */

  const form = document.querySelector('#commande-form');

  if (form) {
    const prixBase = parseFloat(form.dataset.prixBase);
    const minPersonnes = parseInt(form.dataset.minPersonnes, 10);

    const nbInput = document.querySelector('#nb_personnes');
    const adresseInput = document.querySelector('#adresse');
    const villeInput = document.querySelector('#ville');
    const codePostalInput = document.querySelector('#code_postal');

    const prixMenuEl = document.querySelector('#prix-menu');
    const reductionEl = document.querySelector('#reduction');
    const reductionLine = document.querySelector('#reduction-line');
    const prixLivraisonEl = document.querySelector('#prix-livraison');
    const prixTotalEl = document.querySelector('#prix-total');

    const TRAITEUR_LAT = 44.841225;
    const TRAITEUR_LON = -0.579018;

    function calculerDistanceKm(lat1, lon1, lat2, lon2) {
      const R = 6371;
      const dLat = (lat2 - lat1) * Math.PI / 180;
      const dLon = (lon2 - lon1) * Math.PI / 180;

      const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) ** 2;

      return 2 * R * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    async function geocodeAdresse(adresse, codePostal, ville) {
      const query = encodeURIComponent(`${adresse} ${codePostal} ${ville}`);
      const url = `https://api-adresse.data.gouv.fr/search/?q=${query}&limit=1`;

      try {
        const res = await fetch(url);
        const data = await res.json();
        if (!data.features.length) return null;

        const [lon, lat] = data.features[0].geometry.coordinates;
        return { lat, lon };
      } catch {
        return null;
      }
    }

    async function calculPrixPreview() {
      const nb = parseInt(nbInput.value, 10);

      if (isNaN(nb) || nb < minPersonnes) {
        prixMenuEl.textContent = '0 €';
        prixLivraisonEl.textContent = '0 €';
        prixTotalEl.textContent = '0 €';
        reductionLine.classList.add('is-hidden');
        return;
      }

      let prixMenu = nb * prixBase;
      let reduction = 0;

      if (nb >= minPersonnes + 5) {
        reduction = prixMenu * 0.10;
        reductionEl.textContent = `- ${reduction.toFixed(2)} €`;
        reductionLine.classList.remove('is-hidden');
      } else {
        reductionLine.classList.add('is-hidden');
      }

      let prixLivraison = 0;
      const reception = document.querySelector('input[name="reception"]:checked');

      if (reception && reception.value === 'livraison') {
        prixLivraison = 5;

        const a = adresseInput.value.trim();
        const v = villeInput.value.trim().toLowerCase();
        const cp = codePostalInput.value.trim();

        if (a && v && cp && v !== 'bordeaux') {
          const coords = await geocodeAdresse(a, cp, v);
          if (coords) {
            const distance = calculerDistanceKm(
              TRAITEUR_LAT,
              TRAITEUR_LON,
              coords.lat,
              coords.lon
            );
            prixLivraison += distance * 0.59;
          }
        }
      }

      const total = prixMenu - reduction + prixLivraison;

      prixMenuEl.textContent = prixMenu.toFixed(2) + ' €';
      prixLivraisonEl.textContent = prixLivraison.toFixed(2) + ' €';
      prixTotalEl.textContent = total.toFixed(2) + ' €';
    }

    nbInput.addEventListener('input', calculPrixPreview);
    receptionRadios.forEach(r => r.addEventListener('change', calculPrixPreview));
    adresseInput.addEventListener('blur', calculPrixPreview);
    villeInput.addEventListener('blur', calculPrixPreview);
    codePostalInput.addEventListener('blur', calculPrixPreview);
  }

  /* ================= PASSWORD VALIDATION ================= */

  const passwordInput = document.getElementById('password');

  if (passwordInput) {
    const rules = document.querySelectorAll('#password-rules li');

    passwordInput.addEventListener('input', () => {
      const value = passwordInput.value;

      checkRule('length', value.length >= 10);
      checkRule('uppercase', /[A-Z]/.test(value));
      checkRule('lowercase', /[a-z]/.test(value));
      checkRule('number', /[0-9]/.test(value));
      checkRule('special', /[^A-Za-z0-9]/.test(value));
    });

    function checkRule(ruleName, isValid) {
      const rule = document.querySelector(`[data-rule="${ruleName}"]`);
      if (!rule) return;

      rule.classList.toggle('valid', isValid);
      rule.textContent = (isValid ? '✅ ' : '❌ ') + rule.textContent.slice(2);
    }
  }

  /* ================= ETOILES AVIS ================= */

  const stars = document.querySelectorAll('.star');
  const noteInput = document.getElementById('note');

  if (stars.length && noteInput) {
    let selectedValue = 0;

    stars.forEach(star => {
      const value = parseInt(star.dataset.value, 10);

      star.addEventListener('mouseover', () => {
        highlightStars(value);
      });

      star.addEventListener('mouseout', () => {
        highlightStars(selectedValue);
      });

      star.addEventListener('click', () => {
        selectedValue = value;
        noteInput.value = value;
        highlightStars(value);
      });
    });

    function highlightStars(value) {
      stars.forEach(star => {
        star.classList.toggle(
          'active',
          parseInt(star.dataset.value, 10) <= value
        );
      });
    }
  }

});



