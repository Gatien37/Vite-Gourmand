<?php
function traiterMiseAJourHoraires(PDO $pdo, array $horaires, array $post): void
{
    foreach ($horaires as $h) {
        $jour = $h['jour'];

        $ouverture = $post[$jour . '_ouverture'] ?: null;
        $fermeture = $post[$jour . '_fermeture'] ?: null;

        updateHoraire($pdo, $jour, $ouverture, $fermeture);
    }
}
