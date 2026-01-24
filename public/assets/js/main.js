/* ========== Script principal ==========
   Gestion UI, formulaires et interactions
====================================== */

document.addEventListener('DOMContentLoaded', () => {
  console.log('main.js chargé');

  /* ========== CSRF (helper) ========== */

  function getCsrfToken() {
    const input = document.querySelector('input[name="csrf_token"]');
    return input ? input.value : null;
  }

  /* ========== MENU BURGER (mobile) ========== */

  const burger = document.getElementById('burger');
  const nav = document.getElementById('main-nav');

  if (burger && nav) {
    burger.addEventListener('click', () => {
      nav.classList.toggle('nav-open');
    });
  }

  /* ========== AFFICHAGE ADRESSE LIVRAISON ========== */

  const receptionRadios = document.querySelectorAll('input[name="reception"]');
  const livraisonAdresse = document.querySelector('.livraison-adresse');

  const adresseInput = document.getElementById('adresse');
  const villeInput = document.getElementById('ville');
  const codePostalInput = document.getElementById('code_postal');

  function toggleLivraisonAdresse() {
    const selected = document.querySelector('input[name="reception"]:checked');
    if (!livraisonAdresse) return;

    const isLivraison = selected && selected.value === 'livraison';

    livraisonAdresse.classList.toggle('is-hidden', !isLivraison);

    if (adresseInput && villeInput && codePostalInput) {
      adresseInput.required = isLivraison;
      villeInput.required = isLivraison;
      codePostalInput.required = isLivraison;
    }
  }

  receptionRadios.forEach(radio =>
    radio.addEventListener('change', toggleLivraisonAdresse)
  );

  toggleLivraisonAdresse();

  /* ========== CALCUL PRIX COMMANDE (preview) ========== */

  const form = document.getElementById('commande-form');

  if (form) {
    const prixBase = parseFloat(form.dataset.prixBase);
    const minPersonnes = parseInt(form.dataset.minPersonnes, 10);

    const nbInput = document.getElementById('nb_personnes');
    const adresseInput = document.getElementById('adresse');
    const villeInput = document.getElementById('ville');
    const codePostalInput = document.getElementById('code_postal');

    const prixMenuEl = document.getElementById('prix-menu');
    const reductionEl = document.getElementById('reduction');
    const reductionLine = document.getElementById('reduction-line');
    const prixLivraisonEl = document.getElementById('prix-livraison');
    const prixTotalEl = document.getElementById('prix-total');

    const TRAITEUR_LAT = 44.841225;
    const TRAITEUR_LON = -0.579018;

    /* Calcul distance en km (Haversine) */
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

    /* Géocodage adresse (API gouvernementale) */
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

        const adresse = adresseInput.value.trim();
        const ville = villeInput.value.trim().toLowerCase();
        const cp = codePostalInput.value.trim();

        if (adresse && ville && cp && ville !== 'bordeaux') {
          const coords = await geocodeAdresse(adresse, cp, ville);
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
    document
      .querySelectorAll('input[name="reception"]')
      .forEach(r => r.addEventListener('change', calculPrixPreview));

    adresseInput.addEventListener('blur', calculPrixPreview);
    villeInput.addEventListener('blur', calculPrixPreview);
    codePostalInput.addEventListener('blur', calculPrixPreview);
  }

  /* ========== VALIDATION MOT DE PASSE (inscription) ========== */

  const passwordInput = document.getElementById('password');

  if (passwordInput) {
    passwordInput.addEventListener('input', () => {
      const value = passwordInput.value;

      updateRule('length', value.length >= 10);
      updateRule('uppercase', /[A-Z]/.test(value));
      updateRule('lowercase', /[a-z]/.test(value));
      updateRule('number', /[0-9]/.test(value));
      updateRule('special', /[^A-Za-z0-9]/.test(value));
    });

    function updateRule(ruleName, valid) {
      const rule = document.querySelector(`[data-rule="${ruleName}"]`);
      if (!rule) return;

      rule.classList.toggle('valid', valid);
      rule.textContent = (valid ? '✅ ' : '❌ ') + rule.textContent.slice(2);
    }
  }

  /* ========== GESTION STATUT COMMANDE (employé) ==========
     => Action sensible (modifie la BDD) : on envoie le token CSRF
  ======================================================== */

  document.querySelectorAll('.select-statut').forEach(select => {
    select.addEventListener('change', () => {
      const commandeId = select.dataset.commandeId;
      const statut = select.value;

      const csrfToken = getCsrfToken();
      if (!csrfToken) {
        console.warn('CSRF token manquant : changement de statut bloqué.');
        return;
      }

      fetch('update-statut-commande.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': csrfToken
        },
        body: JSON.stringify({ commande_id: commandeId, statut, csrf_token: csrfToken })
      });

      const info = select.parentElement.querySelector('.statut-info');

      if (statut === 'attente_retour_materiel' && info) {
        const dateLimite = ajouterJoursOuvres(new Date(), 10);
        info.textContent =
          '⚠️ Le client sera notifié par email.\n' +
          `Le matériel devra être restitué au plus tard le ${dateLimite.toLocaleDateString('fr-FR')}.`;
      }
    });
  });

  /* ========== CONFIRMATIONS ACTIONS SENSIBLES ========== */

  document.querySelectorAll('.js-confirm-sync').forEach(link => {
    link.addEventListener('click', e => {
      if (!confirm('Mettre à jour les statistiques ?')) {
        e.preventDefault();
      }
    });
  });

  document.querySelectorAll('.js-confirm-annulation').forEach(form => {
    form.addEventListener('submit', e => {
      if (!confirm('Voulez-vous vraiment annuler cette commande ?')) {
        e.preventDefault();
      }
    });
  });

  document.querySelectorAll('.js-confirm-delete').forEach(link => {
    link.addEventListener('click', e => {
      if (!confirm('Supprimer cet élément ?')) {
        e.preventDefault();
      }
    });
  });
});

/* ========== Calcul jours ouvrés ==========
   Exclut samedi (6) et dimanche (0)
========================================= */

function ajouterJoursOuvres(date, jours) {
  const result = new Date(date);
  let ajoutes = 0;

  while (ajoutes < jours) {
    result.setDate(result.getDate() + 1);
    const jour = result.getDay();
    if (jour !== 0 && jour !== 6) {
      ajoutes++;
    }
  }

  return result;
}
