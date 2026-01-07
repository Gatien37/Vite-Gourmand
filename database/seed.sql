-- Données de test pour la base de données ViteGourmand

INSERT INTO utilisateur (prenom, nom, email, gsm, adresse, ville, code_postal, mot_de_passe, role)
VALUES
('Test','User', 'test@vite-gourmand.fr', '0600000000', '123 Rue Exemple', 'Paris', '75001', '$2y$10$HHkl.g5774FbX/WFpKe1GubDNl5aDDnVglXJASOiQTK8WCdeb6ewm', 'user');

DELETE FROM utilisateur WHERE id = 3;


INSERT INTO menu (nom, description, presentation, description_longue, theme, regime, nb_personnes_min, prix_base, stock, image)
VALUES
(
  'Menu Vegan Savoureux',
  'Un menu 100 % vegan, coloré et savoureux, préparé avec des ingrédients frais et de saison.',
  'Un menu 100 % vegan, coloré et gourmand, qui met à l\'honneur des produits frais et des recettes généreuses, accessibles à tous.',
  'Le Menu Vegan Savoureux a été imaginé pour proposer une cuisine végétale riche en goûts et en textures. Chaque plat est préparé à partir de légumes de saison soigneusement sélectionnés, cuisinés avec des herbes et des épices douces afin de préserver leur authenticité. Ce menu allie équilibre nutritionnel et plaisir gourmand, tout en respectant une alimentation sans produits d\'origine animale. Il convient aussi bien aux repas familiaux qu\'aux événements conviviaux, et prouve que la cuisine vegan peut être généreuse, savoureuse et rassasiante.',
  'Classique',
  'Vegan',
  4,
  25.00,
  5,
  'aubergines-roties.jpg'
),
(
  'Menu Festif de Noel',
  'Des plats chaleureux et raffinés pour un repas de Noël réussi.',
  'Un menu chaleureux et raffiné, pensé pour célébrer Noël autour de plats généreux et réconfortants.',
  'Le Menu Festif de Noël a été conçu pour accompagner vos repas de fêtes dans une ambiance conviviale et gourmande. Il met à l\'honneur des recettes traditionnelles revisitées avec soin, préparées à partir de produits de qualité. Chaque plat est pensé pour offrir un équilibre entre finesse et gourmandise, afin de satisfaire l\'ensemble de vos convives. Idéal pour les repas de famille ou les événements professionnels, ce menu apporte une touche festive et authentique à votre table de Noël.',
  'Noël',
  'Classique',
  4,
  30.00,
  3,
  'supreme-volaille.jpg'
),
(
  'Menu Gourmand Végétarien',
  'Un menu coloré et savoureux, 100 % végétarien et riche en goût.',
  'Un menu végétarien généreux et savoureux, qui célèbre la richesse des légumes et des produits laitiers.',
  'Le Menu Gourmand Végétarien propose une alternative sans viande, sans compromis sur le plaisir. Les recettes ont été élaborées pour offrir des plats riches en saveurs, équilibrés et réconfortants. L\'association de légumes de saison, de fromages fondants et d\'herbes aromatiques permet de composer un repas complet et gourmand. Ce menu est parfaitement adapté aux convives végétariens ou à ceux qui souhaitent simplement varier leur alimentation.',
  'Classique',
  'Végétarien',
  4,
  25.00,
  3,
  'tomates-mozza.jpg'
),
(
  'Menu Anniversaire Enfant',
  'Un menu joyeux, simple et savoureux, parfait pour les anniversaires d\'enfants.',
  'Un menu ludique et savoureux, spécialement pensé pour faire plaisir aux enfants lors de leurs anniversaires.',
  'Le Menu Anniversaire Enfant a été conçu pour répondre aux goûts des plus jeunes tout en garantissant des recettes simples et appréciées. Les portions sont adaptées, les saveurs sont douces et les plats sont faciles à déguster. Ce menu permet de profiter pleinement d\'un moment festif, sans contrainte, et de ravir les enfants avec un repas convivial et gourmand, idéal pour souffler les bougies en toute sérénité.',
  'Événement',
  'Classique',
  8,
  13.00,
  3,
  'gateau-anniversaire.jpg'
),
(
  'Menu Cocktail Premium',
  'Un menu raffiné pour vos apéritifs d\'entreprise ou cocktails dinatoires.',
  'Un menu élégant et raffiné, idéal pour les cocktails dînatoires et événements professionnels.',
  'Le Menu Cocktail Premium est pensé pour accompagner vos réceptions et événements avec finesse. Il se compose de bouchées et de plats faciles à déguster, présentés sous forme de verrines ou de portions individuelles. Chaque recette est élaborée pour offrir une expérience gustative équilibrée et raffinée, tout en facilitant le service. Ce menu est parfaitement adapté aux événements d\'entreprise, apéritifs dinatoires et réceptions élégantes.',
  'Événement',
  'Classique',
  10,
  20.00,
  3,
  'verrines-crevettes.jpg'
),
(
  'Menu Pâques Savoureux',
  'Ce menu met à l\'honneur les saveurs du printemps à travers des plats raffinés et équilibrés.',
  'Un menu printanier et équilibré, inspiré des saveurs fraîches et légères de la saison.',
  'Le Menu Pâques Savoureux met à l\'honneur des recettes de saison, fraîches et colorées. Pensé pour célébrer le retour du printemps, il propose des plats équilibrés et gourmands, préparés avec des ingrédients soigneusement sélectionnés. Ce menu est idéal pour partager un repas convivial en famille ou entre amis lors des fêtes de Pâques, dans une ambiance chaleureuse et détendue.',
  'Pâques',
  'Classique',
  6,
  25.00,
  4,
  'oeufs-mimosa.jpg'
),
(
  'Menu Vegan Festif',
  'Un menu vegan festif et généreux, pensé pour les grandes tablées et les moments de partage.',
  'Un menu vegan généreux et festif, parfait pour les grandes tablées et les moments de partage.',
  'Le Menu Vegan Festif a été conçu pour répondre aux attentes des repas de fête sans produits d\'origine animale. Il associe des recettes riches en saveurs et en textures, élaborées à partir de légumes de saison et de protéines végétales. Ce menu offre une alternative festive et équilibrée, adaptée aux célébrations telles que Noël ou Pâques, tout en garantissant un véritable plaisir gustatif pour l\'ensemble des convives.',
  'Noël',
  'Vegan',
  8,
  18.00,
  4,
  'salade-printaniere.jpg'
),
(
  'Menu Végétarien Convivial',
  'Un menu végétarien chaleureux et réconfortant, idéal pour les repas conviviaux en famille ou entre amis.',
  'Un menu végétarien réconfortant, pensé pour des repas simples et chaleureux.',
  'Le Menu Végétarien Convivial propose des recettes généreuses et rassurantes, idéales pour les repas en famille ou entre amis. Les plats sont élaborés à partir d\'ingrédients simples et savoureux, mettant en valeur les légumes et les produits laitiers. Ce menu privilégie la convivialité et le partage, tout en offrant un repas équilibré et gourmand.',
  'Classique',
  'Végétarien',
  8,
  18.00,
  4,
  'veloute-legumes.jpg'
),
(
  'Menu Noël Tradition',
  'Un menu de Noël authentique et réconfortant, qui met à l\'honneur les saveurs traditionnelles des fêtes.',
  'Un menu authentique et réconfortant, fidèle aux saveurs traditionnelles des fêtes de Noël.',
  'Le Menu Noël Tradition a été imaginé pour retrouver l\'esprit des repas de fêtes d\'antan. Il met en avant des recettes classiques, généreuses et chaleureuses, préparées avec soin à partir de produits de qualité. Ce menu est idéal pour rassembler famille et amis autour d\'un repas convivial, où la gourmandise et la tradition sont au cœur de l\'expérience.',
  'Noël',
  'Classique',
  6,
  27.00,
  2,
  'fondant-chocolat.jpg'
),
(
  'Menu Noël Végétarien',
  'Un menu de Noël végétarien raffiné et réconfortant, pensé pour célébrer les fêtes tout en douceur.',
  'Un menu végétarien élégant et festif, spécialement conçu pour les repas de Noël.',
  'Le Menu Noël Végétarien propose une alternative raffinée aux menus traditionnels des fêtes. Les recettes ont été élaborées pour offrir des plats savoureux et équilibrés, sans viande, tout en conservant l\'esprit festif de Noël. Ce menu permet à tous les convives de partager un repas de fête harmonieux, sans compromis sur le goût ni sur la convivialité.',
  'Noël',
  'Végétarien',
  6,
  22.00,
  5,
  'veloute-hiver.jpg'
),
(
  'Menu Pâques Gourmand',
  'Un menu de Pâques gourmand et équilibré, inspiré des saveurs fraîches du printemps.',
  'Un menu de Pâques généreux et gourmand, inspiré par les saveurs du printemps.',
  'Le Menu Pâques Gourmand a été conçu pour offrir un repas festif et équilibré lors des célébrations pascales. Il met en valeur des plats généreux et réconfortants, tout en conservant une touche de fraîcheur propre à la saison. Ce menu est idéal pour partager un moment convivial autour d\'une table chaleureuse et gourmande.',
  'Pâques',
  'Classique',
  6,
  21.00,
  6,
  'riz-legumes.jpg'
),
(
  'Menu Pâques Végétarien',
  'Un menu de Pâques végétarien frais et réconfortant, parfait pour célébrer le printemps en toute simplicité.',
  'Un menu végétarien frais et équilibré, parfait pour célébrer le printemps à Pâques.',
  'Le Menu Pâques Végétarien propose des recettes légères et savoureuses, mettant en avant des légumes de saison et des préparations équilibrées. Pensé pour les repas printaniers, ce menu offre une alternative végétarienne gourmande, idéale pour un moment de partage en famille ou entre amis lors des fêtes de Pâques.',
  'Pâques',
  'Végétarien',
  4,
  17.00,
  4,
  'parmentier-vegetal.jpg'
);

UPDATE menu
SET stock = stock + 50;

UPDATE menu
SET stock = stock + 50
WHERE nom = "Menu Festif de Noel";


INSERT INTO plat (nom, description, type, image)
VALUES
('Velouté de légumes', 'Velouté de légumes de saison au lait de coco et épices douces', 'entree', 'veloute-legumes.jpg'),
('Aubergines rôties', 'Aubergines rôties au four, marinées à l\'huile d\'olive, ail et herbes fraîches', 'plat', 'aubergines-roties.jpg'),
('Salade de fruits', 'Salade de fruits frais de saison, sirop léger au citron et menthe', 'dessert', 'salade-fruits.jpg'),
('Tomates Mozzarella', 'Tomates fraîches, mozzarella fondante et pesto de basilic maison', 'entree', 'tomates-mozza.jpg'),
('Risotto aux champignons', 'Risotto crémeux aux champignons, parmesan affiné et herbes fraîches', 'plat', 'risotto-champignons.jpg'),
('Tarte aux pommes', 'Tarte fine aux pommes caramélisées', 'dessert', 'tarte-pommes.jpg'),
('Mini cakes', 'Mini cakes salés fromage et jambon', 'entree', 'mini-cakes.jpg'),
('Mini nuggets', 'Mini nuggets de poulet accompagnés de pommes de terre rôties', 'plat', 'mini-nuggets.jpg'),
('Gâteau d\'anniversaire', 'Gâteau d\'anniversaire moelleux à la vanille et crème légère', 'dessert', 'gateau-anniversaire.jpg'),
('Velouté de légumes d\'hiver', 'Velouté de légumes d\'hiver composé de carottes, poireaux, pommes de terre et oignons', 'entree', 'veloute-hiver.jpg'),
('Salade printanière croquante', 'Jeunes pousses de salade, radis croquants, concombre, tomates cerises et carottes râpées, le tout relevé d\'une vinaigrette légère.', 'entree', 'salade-printaniere.jpg'),
('Œufs mimosa', 'Œufs durs, jaunes écrasés liés à une mayonnaise légère, moutarde douce, herbes fraîches', 'entree', 'oeufs-mimosa.jpg'),
('Verrines de crevettes', 'Verrines de crevettes marinées, sauce légèrement épicée', 'entree', 'verrines-crevettes.jpg'),
('Lasagnes végétariennes', 'Feuilles de lasagnes, légumes mijotés (courgettes, aubergines, tomates), sauce tomate, béchamel onctueuse, fromage gratiné, herbes aromatiques.', 'plat', 'lasagnes-vegetariennes.jpg'),
('Parmentier végétal de légumes', 'Purée de pommes de terre onctueuse (lait végétal), mélange de légumes mijotés (carottes, lentilles ou pois chiches, oignons, céleri), herbes aromatiques, huile d\'olive.', 'plat', 'parmentier-vegetal.jpg'),
('Riz sauté aux légumes printaniers', 'Riz long sauté, petits pois, carottes, courgettes, oignons nouveaux, herbes fraîches, huile végétale, huile d\'olive.', 'plat', 'riz-legumes.jpg'),
('Riz sauté aux légumes de saison et morceaux de volaille dorés', 'Riz sauté, morceaux de volaille dorés, légumes de saison (carottes, courgettes, poivrons, oignons), herbes fraîches, huile végétale.', 'plat', 'riz-volailles.jpg'),
('Suprême de volaille sauce douce', 'Suprême de volaille rôti, sauce douce et onctueuse, beurre éventuel, herbes aromatiques.', 'plat', 'supreme-volaille.jpg'),
('Mini brochettes de poulet marinées', 'Morceaux de poulet marinés, cuisson basse température pour une chair tendre et juteuse, finition légèrement dorée.', 'plat', 'mini-brochettes.jpg'),
('Moelleux au chocolat', 'Moelleux au chocolat fondant, cœur coulant.', 'dessert', 'moelleux-chocolat.jpg'),
('Moelleux au chocolat vegan', 'Chocolat noir vegan, sucre, farine de blé, boisson végétale (avoine ou amande selon recette), huile végétale, cacao en poudre, vanille.', 'dessert', 'moelleux-vegan.jpg'),
('Fondant au chocolat', 'Dessert intense et ultra-gourmand, très apprécié lors des menus festifs.', 'dessert', 'fondant-chocolat.jpg'),
('Mini verrines chocolat intense et éclats de noisettes', 'Dessert élégant et gourmand, parfait pour les cocktails et événements.', 'dessert', 'verrine-chocolat.jpg');

INSERT INTO allergene (nom) VALUES
('Gluten'),
('Lait'),
('Œufs'),
('Fruits à coque'),
('Crustacés'),
('Moutarde'),
('Soja');

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 1 Velouté de légumes
(1, 1), -- Gluten (traces)
(1, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 2 Aubergines rôties
(2, 1); -- Gluten (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 3 Salade de fruits
(3, 1); -- Gluten (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 4 Tomates Mozzarella
(4, 2), -- Lait
(4, 4), -- Fruits à coque
(4, 1); -- Gluten (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 5 Risotto aux champignons
(5, 2), -- Lait
(5, 1); -- Gluten (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 6 Tarte aux pommes
(6, 1), -- Gluten
(6, 2), -- Lait
(6, 3); -- Œufs

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 7 Mini cakes
(7, 1), -- Gluten
(7, 2), -- Lait
(7, 3); -- Œufs

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 8 Mini nuggets
(8, 1), -- Gluten
(8, 3), -- Œufs
(8, 2); -- Lait (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 9 Gâteau d'anniversaire
(9, 1), -- Gluten
(9, 2), -- Lait
(9, 3); -- Œufs

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 10 Velouté de légumes d'hiver
(10, 1), -- Gluten (traces)
(10, 2); -- Lait (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 11 Salade printanière croquante
(11, 1), -- Gluten (traces)
(11, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 12 Œufs mimosa
(12, 3), -- Œufs
(12, 6), -- Moutarde
(12, 1); -- Gluten (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 13 Verrines de crevettes
(13, 5), -- Crustacés
(13, 1), -- Gluten (traces)
(13, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 14 Lasagnes végétariennes
(14, 1), -- Gluten
(14, 2), -- Lait
(14, 3); -- Œufs (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 15 Parmentier végétal de légumes
(15, 1), -- Gluten (traces)
(15, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 16 Riz sauté aux légumes printaniers
(16, 1), -- Gluten (traces)
(16, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 17 Riz sauté légumes & volaille
(17, 1), -- Gluten (traces)
(17, 2); -- Lait (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 18 Suprême de volaille sauce douce
(18, 2), -- Lait
(18, 1); -- Gluten (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 19 Mini brochettes de poulet marinées
(19, 1), -- Gluten (traces)
(19, 2); -- Lait (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 20 Moelleux au chocolat
(20, 1), -- Gluten
(20, 2), -- Lait
(20, 3), -- Œufs
(20, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 21 Moelleux au chocolat vegan
(21, 1), -- Gluten
(21, 7), -- Soja (traces)
(21, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 22 Fondant au chocolat
(22, 1), -- Gluten
(22, 2), -- Lait
(22, 3), -- Œufs
(22, 4); -- Fruits à coque (traces)

INSERT IGNORE INTO plat_allergene (plat_id, allergene_id) VALUES
-- 23 Mini verrines chocolat noisette
(23, 4), -- Fruits à coque
(23, 2), -- Lait
(23, 1); -- Gluten (traces)



--Menu Vegan Savoureux--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(1, 1),   -- Velouté de légumes
(1, 2),   -- Aubergines rôties
(1, 3);   -- Salade de fruits

--Menu Festif de Noel--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(2, 10),  -- Velouté de légumes d’hiver
(2, 18),  -- Suprême de volaille
(2, 22);  -- Fondant chocolat

--Menu Gourmand Végétarien--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(3, 4),   -- Tomates Mozzarella
(3, 5),   -- Risotto aux champignons
(3, 6);   -- Tarte aux pommes

--Menu Anniversaire Enfant--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(4, 7),   -- Mini cakes
(4, 8),   -- Mini nuggets
(4, 9);   -- Gâteau d’anniversaire

--Menu Cocktail Premium--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(5, 13),  -- Verrines de crevettes
(5, 19),  -- Mini brochettes de poulet
(5, 23);  -- Mini verrines chocolat

--Menu Pâques Savoureux--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(6, 12),  -- Œufs mimosa
(6, 16),  -- Riz sauté aux légumes printaniers
(6, 22);  -- Fondant chocolat

--Menu Vegan Festif--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(7, 11),  -- Salade printanière croquante
(7, 15),  -- Parmentier végétal de légumes
(7, 21);  -- Moelleux chocolat vegan

--Menu Végétarien Convivial--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(8, 1),   -- Velouté de légumes
(8, 14),  -- Lasagnes végétariennes
(8, 20);  -- Moelleux au chocolat

--Menu Noël Tradition--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(9, 10),  -- Velouté de légumes d’hiver
(9, 18),  -- Suprême de volaille
(9, 22);  -- Fondant chocolat

--Menu Noël Végétarien--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(10, 10), -- Velouté de légumes d’hiver
(10, 5),  -- Risotto aux champignons
(10, 6);  -- Tarte aux pommes

--Menu Pâques Gourmand--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(11, 12), -- Œufs mimosa
(11, 16), -- Riz sauté aux légumes printaniers
(11, 22); -- Fondant chocolat

--Menu Pâques Végétarien--
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(12, 11), -- Salade printanière croquante
(12, 15), -- Parmentier végétal de légumes
(12, 20); -- Moelleux au chocolat


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

DELETE FROM commande WHERE utilisateur_id = 3;



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


TRUNCATE TABLE menu;
SOURCE seed.sql;

