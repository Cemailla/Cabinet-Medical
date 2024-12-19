-- Création et insertion pour la table usager
CREATE TABLE usager (
    ID_USAGER int(11) NOT NULL AUTO_INCREMENT,
    Civilite varchar(10) DEFAULT NULL,
    Nom varchar(50) DEFAULT NULL,
    Prenom varchar(50) DEFAULT NULL,
    Adresse varchar(100) DEFAULT NULL,
    Date_Naissance date DEFAULT NULL,
    Numero_Secu varchar(13) DEFAULT NULL,
    Lieu_Naissance varchar(50) DEFAULT NULL,
    ID_Medecin_Ref int(11) DEFAULT NULL,
    PRIMARY KEY (ID_USAGER),
    FOREIGN KEY (ID_Medecin_Ref) REFERENCES medecin (ID_Medecin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usager (Civilite, Nom, Prenom, Adresse, Date_Naissance, Numero_Secu, Lieu_Naissance, ID_Medecin_Ref) VALUES
('Madame', 'Roussel', 'Marie', '333 Avenue de la Santé', '1982-07-12', '2345678901234', 'Lille', 1),
('Monsieur', 'Marchand', 'Thomas', '444 Rue de la Guérison', '1990-09-25', '4321098765432', 'Bordeaux', 2),
('Madame', 'Bertrand', 'Aurélie', '555 Boulevard de la Rééducation', '1978-03-08', '8765432109876', 'Strasbourg', 3),
('Monsieur', 'Fournier', 'Lucas', '666 Chemin du Bien-être', '1993-12-17', '3456789012345', 'Nantes', 4),
('Madame', 'Legrand', 'Camille', '777 Avenue de la Remise en Forme', '1985-05-20', '5678901234567', 'Montpellier', 5),
('Madame', 'Tognini', 'Célia', 'c un secret', '2004-07-01', '5678901234567', 'Toulouse', 1),
('Monsieur', 'Steperaert', 'Jules', 'c un secret aussi', '2004-11-20', '5678901234567', 'Toulouse', 4);
-- Création et insertion pour la table medecin
CREATE TABLE medecin (
    ID_Medecin int(11) NOT NULL AUTO_INCREMENT,
    Civilite varchar(10) DEFAULT NULL,
    Nom varchar(50) DEFAULT NULL,
    Prenom varchar(50) DEFAULT NULL,
    PRIMARY KEY (ID_Medecin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO medecin (Civilite, Nom, Prenom) VALUES
('Monsieur', 'Roussel', 'Julien'),
('Madame', 'Marchand', 'Isabelle'),
('Monsieur', 'Bertrand', 'Luc'),
('Madame', 'Fournier', 'Aurélie'),
('Monsieur', 'Legrand', 'Thomas');
-- Création de la table consultation
CREATE TABLE consultation (
    ID_Consultation int(11) NOT NULL AUTO_INCREMENT,
    ID_USAGER int(11) DEFAULT NULL,
    ID_Medecin int(11) DEFAULT NULL,
    Date_Consultation date DEFAULT NULL,
    Heure time DEFAULT NULL,
    Duree int(11) DEFAULT NULL,
    PRIMARY KEY (ID_Consultation),
    FOREIGN KEY (ID_USAGER) REFERENCES usager (ID_USAGER),
    FOREIGN KEY (ID_Medecin) REFERENCES medecin (ID_Medecin)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des consultations
INSERT INTO consultation (ID_USAGER, ID_Medecin, Date_Consultation, Heure, Duree) VALUES
(1, 1, '2024-01-15', '09:30:00', 60),
(2, 2, '2024-02-22', '14:00:00', 45),
(3, 3, '2024-03-10', '11:15:00', 30),
(4, 4, '2024-04-30', '16:45:00', 60),
(5, 5, '2024-05-18', '08:00:00', 45);


-- Création de la table utilisateurs
CREATE TABLE utilisateurs (
    ID_Utilisateur int(11) NOT NULL AUTO_INCREMENT,
    NomUtilisateur varchar(50) NOT NULL,
    MotDePasse varchar(255) NOT NULL,
    Role varchar(50) DEFAULT NULL,
    PRIMARY KEY (ID_Utilisateur),
    UNIQUE KEY NomUtilisateur (NomUtilisateur)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des utilisateurs
INSERT INTO utilisateurs (NomUtilisateur, MotDePasse, Role) VALUES
('admin', 'admin', 'ADMIN'),
('secretaire', 'secretaire', 'SECRETAIRE');