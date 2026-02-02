<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/horaireModel.php';

$horaires = getHoraires($pdo);
?>

<footer>
        <div class="footer-container">
            <div class="horaires">
                <h3>Horaires</h3>

                <?php foreach ($horaires as $h): ?>
                    <p>
                        <strong><?= ucfirst($h['jour']) ?> :</strong>
                        <?php if ($h['ouverture'] && $h['fermeture']): ?>
                            <?= substr($h['ouverture'], 0, 5) ?> – <?= substr($h['fermeture'], 0, 5) ?>
                        <?php else: ?>
                            Fermé
                        <?php endif; ?>
                    </p>
                <?php endforeach; ?>

            </div>

            <div class="contact">
                <p>Vite & Gourmand, 12 Rue Lafaurie de Monbadon, 33000 Bordeaux</p>
                <p>Téléphone : 05 56 48 32 10</p>
                <a href="contact.php">Nous contacter</a>
            </div>
            <div class="legal">
                <a href="mentions-legales.php">Mentions légales</a>
                <a href="cgv.php">Conditions Générales de Vente</a>
            </div>
            <div class="copyright">
                <p>&copy; 2026 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
        <script src="assets/js/main.js" defer></script>
    </footer>