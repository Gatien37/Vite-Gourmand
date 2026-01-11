CREATE DATABASE vite_gourmand;
USE vite_gourmand;

CREATE TABLE utilisateur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    gsm VARCHAR(150),
    actif BOOLEAN DEFAULT TRUE,
    role VARCHAR(50) DEFAULT 'user'
);

ALTER TABLE utilisateur
ADD prenom VARCHAR(50) NOT NULL,
ADD adresse VARCHAR(255) NOT NULL,
ADD ville VARCHAR(100) NOT NULL,
ADD code_postal VARCHAR(10) NOT NULL;

ALTER TABLE utilisateur
ADD reset_token VARCHAR(255) AFTER mot_de_passe,
ADD reset_expires DATETIME AFTER reset_token;

ALTER TABLE utilisateur
MODIFY prenom VARCHAR(50) NOT NULL AFTER id;

ALTER TABLE utilisateur
MODIFY nom VARCHAR(50) NOT NULL AFTER prenom;

ALTER TABLE utilisateur
MODIFY email VARCHAR(100) NOT NULL UNIQUE AFTER nom;

ALTER TABLE utilisateur
MODIFY gsm VARCHAR(150) AFTER email;

ALTER TABLE utilisateur
MODIFY adresse VARCHAR(255) NOT NULL AFTER gsm;

ALTER TABLE utilisateur
MODIFY ville VARCHAR(100) NOT NULL AFTER adresse;

ALTER TABLE utilisateur
MODIFY code_postal VARCHAR(10) NOT NULL AFTER ville;

ALTER TABLE utilisateur
MODIFY mot_de_passe VARCHAR(255) NOT NULL AFTER code_postal;

ALTER TABLE utilisateur
MODIFY role VARCHAR(50) DEFAULT 'user' AFTER mot_de_passe;

ALTER TABLE utilisateur
MODIFY actif BOOLEAN DEFAULT TRUE AFTER role;

ALTER TABLE utilisateur DROP COLUMN actif;

ALTER TABLE utilisateur
ADD actif BOOLEAN DEFAULT TRUE;



CREATE TABLE menu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    theme VARCHAR(100),
    regime VARCHAR(100),
    nb_personnes_min INT NOT NULL,
    prix_base DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    image VARCHAR(255)
);

ALTER TABLE menu
ADD presentation TEXT AFTER description,
ADD description_longue TEXT AFTER presentation;

CREATE TABLE plat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    image VARCHAR(255)
);

ALTER TABLE plat
DROP COLUMN allergenes;


CREATE TABLE allergene (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);


CREATE TABLE plat_allergene (
    plat_id INT NOT NULL,
    allergene_id INT NOT NULL,
    PRIMARY KEY (plat_id, allergene_id),
    FOREIGN KEY (plat_id) REFERENCES plat(id) ON DELETE CASCADE,
    FOREIGN KEY (allergene_id) REFERENCES allergene(id) ON DELETE CASCADE
);


CREATE TABLE commande (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    menu_id INT NOT NULL,
    date_prestation DATETIME NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    nb_personnes INT NOT NULL,
    prix_total DECIMAL(10, 2) NOT NULL,
    statut VARCHAR(50) DEFAULT 'en_attente',

    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id),
    FOREIGN KEY (menu_id) REFERENCES menu(id)
);


CREATE TABLE commande_suivi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    statut VARCHAR(50) NOT NULL,
    date_statut DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (commande_id) REFERENCES commande(id)
);



CREATE TABLE avis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    commande_id INT NOT NULL,
    note INT CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    valide BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (commande_id) REFERENCES commande(id)
);

ALTER TABLE avis ADD UNIQUE (commande_id);



CREATE TABLE menu_plat (
  menu_id INT NOT NULL,
  plat_id INT NOT NULL,
  PRIMARY KEY (menu_id, plat_id),
  FOREIGN KEY (menu_id) REFERENCES menu(id)
    ON DELETE CASCADE,
  FOREIGN KEY (plat_id) REFERENCES plat(id)
    ON DELETE CASCADE
);


CREATE TABLE horaire (
    id INT PRIMARY KEY AUTO_INCREMENT,
    jour VARCHAR(20) NOT NULL,
    ouverture TIME NOT NULL,
    fermeture TIME NOT NULL
);

ALTER TABLE horaire
MODIFY ouverture TIME NULL,
MODIFY fermeture TIME NULL;

