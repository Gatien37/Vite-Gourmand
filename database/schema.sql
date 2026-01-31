/* ================ BASE DE DONNÉES ================ */

/*CREATE DATABASE vite_gourmand;
USE vite_gourmand;*/


/* ================ UTILISATEUR ================ */

CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    gsm VARCHAR(150),
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255),
    reset_expires DATETIME,
    role VARCHAR(50) DEFAULT 'user',
    actif BOOLEAN DEFAULT TRUE
);


/* ================ MENU ================ */

CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    description_longue TEXT,
    theme VARCHAR(100),
    regime VARCHAR(100),
    nb_personnes_min INT NOT NULL,
    prix_base DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    image VARCHAR(255)
);


/* ================ PLAT ================ */

CREATE TABLE plat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    image VARCHAR(255),
    actif BOOLEAN DEFAULT TRUE
);


/* ================ ALLERGÈNE ================ */

CREATE TABLE allergene (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);


/* ================ PLAT ↔ ALLERGÈNE ================ */

CREATE TABLE plat_allergene (
    plat_id INT NOT NULL,
    allergene_id INT NOT NULL,
    PRIMARY KEY (plat_id, allergene_id),
    FOREIGN KEY (plat_id) REFERENCES plat(id) ON DELETE CASCADE,
    FOREIGN KEY (allergene_id) REFERENCES allergene(id) ON DELETE CASCADE
);


/* ================ COMMANDE ================ */

CREATE TABLE commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    menu_id INT NOT NULL,
    date_prestation DATETIME NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    nb_personnes INT NOT NULL,
    prix_total DECIMAL(10,2) NOT NULL,
    statut VARCHAR(50) DEFAULT 'en_attente',
    pret_materiel BOOLEAN DEFAULT FALSE,
    date_limite_retour DATE,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id),
    FOREIGN KEY (menu_id) REFERENCES menu(id)
);


/* ================ SUIVI COMMANDE ================ */

CREATE TABLE commande_suivi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    statut VARCHAR(50) NOT NULL,
    date_statut DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (commande_id) REFERENCES commande(id)
);


/* ================ ACTIONS COMMANDE (EMPLOYÉ) ================ */

CREATE TABLE commande_actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    employe_id INT NOT NULL,
    action VARCHAR(20) NOT NULL,
    contact_mode VARCHAR(10) NOT NULL,
    motif TEXT NOT NULL,
    created_at DATETIME NOT NULL
);


/* ================ AVIS ================ */

CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL UNIQUE,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    valide BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (commande_id) REFERENCES commande(id)
);


/* ================ MENU ↔ PLAT ================ */

CREATE TABLE menu_plat (
    menu_id INT NOT NULL,
    plat_id INT NOT NULL,
    PRIMARY KEY (menu_id, plat_id),
    FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE,
    FOREIGN KEY (plat_id) REFERENCES plat(id) ON DELETE CASCADE
);


/* ================ HORAIRES ================ */

CREATE TABLE horaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jour VARCHAR(20) NOT NULL,
    ouverture TIME NULL,
    fermeture TIME NULL
);
