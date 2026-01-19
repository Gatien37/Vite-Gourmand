<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées de la page ========== */
    $title = "Conditions Générales de Vente";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Section titre ===== -->
    <section class="hero-section commandes-hero">
        <h1>Conditions Générales de Vente</h1>
        <p>Veuillez lire attentivement les conditions suivantes avant toute commande.</p>
    </section>

    <!-- ===== Contenu des CGV ===== -->
    <section class="cgv-container">

        <h2>1. Identification du vendeur</h2>
        <p>
            Le site <strong>Vite & Gourmand</strong> est édité par :
        </p>
        <p>
            Nom commercial : <strong>Vite & Gourmand</strong><br>
            Raison sociale : <strong>Vite & Gourmand SARL</strong><br>
            Forme juridique : <strong>Société à Responsabilité Limitée (SARL)</strong><br>
            Capital social : <strong>10 000 €</strong><br>
            Adresse du siège social :
            <strong>12 rue des Gourmets, 33000 Bordeaux, France</strong><br>
            Numéro SIRET : <strong>912 345 678 00019</strong><br>
            RCS : <strong>Bordeaux 912 345 678</strong><br>
            Email : <strong>contact@viteetgourmand.fr</strong><br>
            Téléphone : <strong>05 56 00 00 00</strong>
        </p>

        <h2>2. Objet</h2>
        <p>
            Les présentes Conditions Générales de Vente (CGV) définissent les droits et obligations
            des parties dans le cadre de la vente de menus et prestations de traiteur proposées
            par Vite & Gourmand via son site internet.
        </p>

        <h2>3. Champ d'application</h2>
        <p>
            Les présentes CGV s'appliquent à toute commande passée sur le site.
            Toute commande implique l'acceptation pleine et entière des CGV en vigueur
            au jour de la commande.
        </p>

        <h2>4. Commande</h2>
        <p>
            Les commandes sont effectuées exclusivement en ligne.
            La validation de la commande vaut acceptation des présentes CGV.
            Un e-mail de confirmation est envoyé au client après validation.
        </p>

        <h2>5. Tarifs</h2>
        <p>
            Les prix sont indiqués en euros (€), toutes taxes comprises (TTC).
            Les tarifs appliqués sont ceux en vigueur au moment de la commande.
        </p>

        <h2>6. Paiement</h2>
        <p>
            Le paiement peut être effectué par carte bancaire en ligne ou selon les modalités
            indiquées lors de la commande.
            Les paiements en ligne sont sécurisés.
        </p>

        <h2>7. Minimum de commande</h2>
        <p>
            Certains menus nécessitent un nombre minimum de personnes.
            Cette information est précisée sur la fiche de chaque menu.
        </p>

        <h2>8. Livraison et prestation</h2>
        <p>
            La livraison est assurée sur Bordeaux et ses environs.
            Frais de livraison :
        </p>
        <ul>
            <li>Bordeaux : gratuit</li>
            <li>Hors Bordeaux : 5 € + 0,59 €/km</li>
        </ul>
        <p>
            Les prestations sont réalisées à la date et à l'adresse indiquées lors de la commande.
        </p>

        <h2>9. Droit de rétractation</h2>
        <p>
            Conformément à l'article L221-28 du Code de la consommation,
            le droit de rétractation ne s'applique pas aux prestations de services
            fournies à une date déterminée.
        </p>
        <p>
            Les prestations de traiteur étant liées à une date choisie par le client,
            aucun droit de rétractation ne peut être exercé après validation de la commande.
        </p>

        <h2>10. Annulation et remboursement</h2>
        <p>
            Toute annulation est possible jusqu'à 24 heures avant la date de prestation.
            Passé ce délai, aucun remboursement ne pourra être exigé.
        </p>
        <p>
            En cas d'annulation acceptée, le remboursement est effectué par le même moyen
            de paiement dans un délai maximum de 14 jours.
        </p>

        <h2>11. Allergènes</h2>
        <p>
            Les informations concernant les allergènes sont indiquées sur chaque fiche menu.
            Le client doit signaler toute allergie grave avant validation de la commande.
        </p>

        <h2>12. Réclamations</h2>
        <p>
            Toute réclamation doit être adressée par e-mail à
            <strong>contact@viteetgourmand.fr</strong>
            dans un délai de 48 heures après la livraison.
        </p>

        <h2>13. Protection des données personnelles</h2>
        <p>
            Les données personnelles collectées sont utilisées exclusivement pour
            la gestion des commandes.
            Conformément au RGPD, le client peut exercer ses droits en contactant
            <strong>contact@viteetgourmand.fr</strong>.
        </p>

        <h2>14. Propriété intellectuelle</h2>
        <p>
            L'ensemble des contenus du site (textes, images, logos, recettes)
            est protégé par le droit de la propriété intellectuelle.
            Toute reproduction est interdite sans autorisation écrite.
        </p>

        <h2>15. Force majeure</h2>
        <p>
            La responsabilité de Vite & Gourmand ne pourra être engagée en cas
            d'événement de force majeure empêchant l'exécution normale de la prestation.
        </p>

        <h2>16. Médiation de la consommation</h2>
        <p>
            Conformément aux articles L612-1 et suivants du Code de la consommation,
            le client peut recourir gratuitement à un médiateur :
        </p>
        <p>
            Médiateur :
            <strong>CM2C - Centre de la Médiation de la Consommation de Conciliateurs de Justice</strong><br>
            Site : <strong>https://www.cm2c.net</strong><br>
            Adresse : <strong>14 rue Saint Jean, 75017 Paris</strong>
        </p>

        <h2>17. Droit applicable et litiges</h2>
        <p>
            Les présentes CGV sont soumises au droit français.
            En cas de litige, une solution amiable sera recherchée avant toute action judiciaire.
        </p>

    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
