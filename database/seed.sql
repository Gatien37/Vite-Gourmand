-- Données de test pour la base de données ViteGourmand

INSERT INTO utilisateur (nom, email, mot_de_passe, gsm, role)
VALUES
('Jean Dupont', 'jean.dupont@test.fr', 'hash_password_jean', '0612345678', 'user'),
('Admin ViteGourmand', 'admin@vitegourmand.fr', 'hash_password_admin', NULL, 'admin');


INSERT INTO menu (nom, description, theme, nb_personnes_min, prix_base, stock, statut)
VALUES
(
  'Menu Bordelais',
  'Entrée, plat et dessert inspirés de la tradition bordelaise.',
  'tradition',
  10,
  25.00,
  5,
  'disponible'
),
(
  'Menu Vegan',
  'Menu 100% végétal à base de produits frais et locaux.',
  'vegan',
  8,
  22.00,
  3,
  'disponible'
);


-- Plats du Menu Bordelais (menu_id = 1)
INSERT INTO plat (menu_id, nom, description, type, allergenes)
VALUES
(1, 'Salade landaise', 'Salade verte, magret fumé et foie gras', 'entree', 'gluten'),
(1, 'Boeuf bourguignon', 'Boeuf mijoté au vin rouge', 'plat', 'aucun'),
(1, 'Canelé bordelais', 'Dessert traditionnel bordelais', 'dessert', 'gluten, lactose');

-- Plats du Menu Vegan (menu_id = 2)
INSERT INTO plat (menu_id, nom, description, type, allergenes)
VALUES
(2, 'Houmous maison', 'Houmous de pois chiches', 'entree', 'sesame'),
(2, 'Curry de légumes', 'Curry de légumes de saison', 'plat', 'aucun'),
(2, 'Salade de fruits', 'Fruits frais de saison', 'dessert', 'aucun');


INSERT INTO commande (
  utilisateur_id,
  menu_id,
  date_prestation,
  adresse,
  ville,
  nb_personnes,
  prix_total,
  statut
)
VALUES
(
  1,
  1,
  '2025-03-15 12:00:00',
  '12 rue des Lilas',
  'Bordeaux',
  20,
  500.00,
  'confirmee'
);


INSERT INTO avis (commande_id, note, commentaire, valide)
VALUES
(
  1,
  5,
  'Excellent menu, très apprécié par tous les invités.',
  TRUE
);


INSERT INTO horaire (jour, ouverture, fermeture)
VALUES
('Lundi', '09:00:00', '18:00:00'),
('Mardi', '09:00:00', '18:00:00'),
('Mercredi', '09:00:00', '18:00:00'),
('Jeudi', '09:00:00', '18:00:00'),
('Vendredi', '09:00:00', '18:00:00');


SELECT * FROM utilisateur;
SELECT * FROM menu;
SELECT * FROM plat;
SELECT * FROM commande;
SELECT * FROM avis;
SELECT * FROM horaire;


SELECT
  c.id AS commande_id,
  u.nom AS client,
  m.nom AS menu,
  c.prix_total
FROM commande c
JOIN utilisateur u ON c.utilisateur_id = u.id
JOIN menu m ON c.menu_id = m.id;
