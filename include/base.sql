CREATE DATABASE examens2;

use examens2;

CREATE TABLE membre (
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100) UNIQUE,
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);



CREATE TABLE categorie_objet (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(100)
);


CREATE TABLE objet (
    id_objet INT PRIMARY KEY AUTO_INCREMENT,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

CREATE TABLE images_objet (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
);

CREATE TABLE emprunt (
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);


set FOREIGN_KEY_CHECKS = 0;
set FOREIGN_KEY_CHECKS = 1;

drop table categorie_objet;

select * from objet;

drop table emprunt;



-- Membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice Dupont', '1995-03-15', 'Femme', 'alice@example.com', 'Paris', 'a', 'null.jpg'),
('Bob Martin', '1990-07-22', 'Homme', 'bob@example.com', 'Lyon', 'a', 'null.jpg'),
('Claire Leroy', '1988-11-05', 'Femme', 'claire@example.com', 'Marseille', 'a', 'null.jpg'),
('Jean Baptiste', '1986-09-03', 'Homme', 'jean@example.com', 'Marseille', 'a', 'null.jpg');

-- Catégories d'objet
INSERT INTO categorie_objet (nom_categorie) VALUES
('esthetique'),
('bricolage'),
('mecanique'),
('cuisine');

-- Objets
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),         -- esthetique
('Perceuse', 2, 2),              -- bricolage
('Clé à molette', 3, 3),         -- mecanique
('Mixeur', 4, 4),                -- cuisine
('Lisseur', 1, 2),               -- esthetique
('Tournevis électrique', 2, 1),  -- bricolage
('Cric hydraulique', 3, 4),      -- mecanique
('Robot pâtissier', 4, 3),       -- cuisine
('Brosse nettoyante', 1, 3),     -- esthetique
('Scie sauteuse', 2, 4);         -- bricolage

-- Images des objets
INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'seche_cheveux.jpg'),
(2, 'perceuse.jpg'),
(3, 'cle_molette.jpg'),
(4, 'mixeur.jpg'),
(5, 'lisseur.jpg'),
(6, 'tournevis_electrique.jpg'),
(7, 'cric_hydraulique.jpg'),
(8, 'robot_patissier.jpg'),
(9, 'brosse_nettoyante.jpg'),
(10, 'scie_sauteuse.jpg');

-- Emprunts
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-10'),
(2, 3, '2025-07-05', null),
(3, 1, '2025-07-07', '2025-07-20'),
(4, 2, '2025-07-10', null),
(5, 4, '2025-07-12', '2025-07-22'),
(6, 1, '2025-07-15', null),
(7, 3, '2025-07-18', '2025-07-28'),
(8, 2, '2025-07-20', '2025-07-30'),
(9, 4, '2025-07-22', null),
(10, 1, '2025-07-25', '2025-08-05');
