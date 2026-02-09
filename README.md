Vite-Gourmand
Objectif du document
Ce fichier README.md décrit la démarche à suivre pour installer et lancer l’application Vite-Gourmand en environnement local, conformément aux consignes de l’épreuve.
________________________________________
Prérequis techniques
Avant toute installation, vérifier que les éléments suivants sont disponibles sur la machine :
•	Système d’exploitation : Windows
•	Serveur local : XAMPP
•	PHP : 8.2
•	MySQL : 8.x
•	Docker : installé et fonctionnel (pour MongoDB)
•	Navigateur web : Chrome, Firefox ou équivalent
________________________________________
Installation du projet en local
1. Cloner le dépôt
git clone https://github.com/Gatien37/Vite-Gourmand.git
Placer le dossier du projet dans le répertoire htdocs de XAMPP.
________________________________________
2. Démarrer les services locaux
Lancer XAMPP, puis démarrer :
•	Apache
•	MySQL
Vérifier que Docker est actif (MongoDB).
________________________________________
3. Configuration de la base de données MySQL
a. Création de la base
Créer une base de données nommée :
vite_gourmand
Encodage recommandé : utf8mb4
b. Import des scripts SQL
Dans phpMyAdmin, importer les fichiers suivants dans l’ordre :
1.	database/schema.sql
2.	database/seed.sql
________________________________________
4. Configuration de la connexion MySQL

Le fichier suivant n’est pas versionné pour des raisons de sécurité :
config/database.php

Pour configurer la base de données en local :

1. Copier le fichier :
   config/database.example.php
2. Le renommer en :
   config/database.php
3. Adapter les paramètres de connexion MySQL locaux si nécessaire
   (hôte, nom de base, utilisateur, mot de passe).

________________________________________
5. MongoDB (statistiques)
•	MongoDB est utilisé pour le stockage des statistiques
•	Il est lancé via Docker
•	La base et les collections sont créées automatiquement lors de la première utilisation
•	Aucune action manuelle n’est requise
________________________________________
Lancement de l’application
Une fois les services actifs (Apache, MySQL, Docker), accéder à l’application via :
http://localhost/vite-gourmand/public/index.php
________________________________________
Comptes de test
Les comptes de test (emails et mots de passe) sont fournis dans un fichier joint séparé, pour des raisons de sécurité.
________________________________________
Structure du projet (simplifiée)
vite-gourmand/
├── config/
├── database/
├── middlewares/
├── models/
├── services/
├── public/
│   ├── index.php
│   └── assets/
├── vendor/
├── docker-compose.yml
└── README.md
