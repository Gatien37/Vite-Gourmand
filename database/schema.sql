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

CREATE TABLE menu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    theme VARCHAR(100),
    nb_personnes_min INT NOT NULL,
    prix_base DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    statut VARCHAR(50) DEFAULT 'disponible'
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

CREATE TABLE avis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    commande_id INT NOT NULL,
    note INT CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    valide BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (commande_id) REFERENCES commande(id)
);

CREATE TABLE plat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    menu_id INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    allergenes VARCHAR(255),

    FOREIGN KEY (menu_id) REFERENCES menu(id)
);

CREATE TABLE horaire (
    id INT PRIMARY KEY AUTO_INCREMENT,
    jour VARCHAR(20) NOT NULL,
    ouverture TIME NOT NULL,
    fermeture TIME NOT NULL
);
