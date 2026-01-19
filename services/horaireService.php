<?php
/* ========== Mise à jour des horaires d’ouverture ========== */

function traiterMiseAJourHoraires(
    PDO $pdo,
    array $horaires,
    array $post
): void
{
    /* ========== Parcours des jours existants ========== */

    foreach ($horaires as $h) {

        $jour = $h['jour'];

        /* ========== Récupération des horaires depuis le formulaire ========== */

        $ouverture = $post[$jour . '_ouverture'] ?: null;
        $fermeture = $post[$jour . '_fermeture'] ?: null;

        /* ========== Mise à jour en base ========== */

        updateHoraire($pdo, $jour, $ouverture, $fermeture);
    }
}
