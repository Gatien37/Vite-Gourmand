
console.log('main.js chargé');


// ===== MENU BURGER =====

const burger = document.getElementById('burger');
const nav = document.getElementById('main-nav');

burger.addEventListener('click', () => {
  nav.classList.toggle('nav-open');
});



// ===== CONFIRMATION BOUTON SUPPRIMER =====

const deleteButtons = document.querySelectorAll('.btn-delete');

deleteButtons.forEach(button => {
  button.addEventListener('click', (e) => {
    const confirmation = confirm(
      "Confirmez-vous la suppression de cet élément ?"
    );

    if (!confirmation) {
      e.preventDefault();
    }
  });
});

// Confirmation annulation commande

const statusSelects = document.querySelectorAll('.select-statut');

statusSelects.forEach(select => {
  let previousValue = select.value;

  select.addEventListener('change', () => {
    if (select.value === 'Annulée') {
      const confirmCancel = confirm(
        "Confirmez-vous la suppression de cette commande ?"
      );

      if (!confirmCancel) {
        select.value = previousValue;
      }
    }

    previousValue = select.value;
  });
});



// ===== VALIDATION FORMULAIRE INSCRIPTION =====

const registerForm = document.querySelector('#register-form');

if (registerForm) {
  registerForm.addEventListener('submit', (e) => {
    const prenom = document.querySelector('#prenom');
    const nom = document.querySelector('#nom');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm-password');
    const error = document.querySelector('#form-error');

    error.textContent = "";

    // Champs obligatoires
    if (
      prenom.value.trim() === "" ||
      nom.value.trim() === "" ||
      email.value.trim() === "" ||
      password.value.trim() === "" ||
      confirmPassword.value.trim() === ""
    ) {
      error.textContent = "Tous les champs obligatoires doivent être remplis.";
      e.preventDefault();
      return;
    }

    // Email basique
    if (!email.value.includes("@")) {
      error.textContent = "Veuillez entrer une adresse email valide.";
      e.preventDefault();
      return;
    }

    // Mot de passe confirmé
    if (password.value !== confirmPassword.value) {
      error.textContent = "Les mots de passe ne correspondent pas.";
      e.preventDefault();
      return;
    }
  });
}


// ===== VALIDATION FORMULAIRE COMMANDE =====

const commandeForm = document.querySelector('#commande-form');

if (commandeForm) {
  commandeForm.addEventListener('submit', (e) => {
    const quantite = document.querySelector('#quantite');
    const date = document.querySelector('#date');
    const heure = document.querySelector('#heure');
    const reception = document.querySelector('input[name="reception"]:checked');

    const adresse = document.querySelector('#adresse');
    const ville = document.querySelector('#ville');
    const codePostal = document.querySelector('#code-postal');

    const error = document.querySelector('#commande-error');
    error.textContent = "";

    // Champs obligatoires
    if (
      quantite.value.trim() === "" ||
      date.value === "" ||
      heure.value === ""
    ) {
      error.textContent = "Veuillez remplir tous les champs obligatoires.";
      e.preventDefault();
      return;
    }

    // Minimum personnes
    if (parseInt(quantite.value) < 6) {
      error.textContent = "Le minimum de commande est de 6 personnes.";
      e.preventDefault();
      return;
    }

    // Mode de réception
    if (!reception) {
      error.textContent = "Veuillez choisir un mode de réception.";
      e.preventDefault();
      return;
    }

    // Livraison → adresse obligatoire
    if (reception.value === "livraison") {
      if (
        adresse.value.trim() === "" ||
        ville.value.trim() === "" ||
        codePostal.value.trim() === ""
      ) {
        error.textContent = "Veuillez remplir l'adresse complète de livraison.";
        e.preventDefault();
        return;
      }
    }
  });
}


