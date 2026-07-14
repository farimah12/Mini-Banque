-- ============================================================
--  gestion_banque — reconstruit à partir du code PHP fourni
--  (ControlConnexion.php, AjoutUser/Client/Compte.php,
--   Modif*.php, TransactionCompte.php, comptes.php...)
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `gestion_banque`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gestion_banque`;

-- ------------------------------------------------------------
-- Table : utilisateurs
-- Utilisée dans : ControlConnexion.php (connexion), user.php,
--                 AjoutUser.php, ModifUser.php
-- Remarque : ControlConnexion.php compare le mot de passe en
-- clair (pas de password_hash/password_verify dans ton code),
-- donc cette table le stocke en clair pour rester compatible.
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom`         VARCHAR(100) NOT NULL,
  `login`       VARCHAR(50)  NOT NULL,
  `password`    VARCHAR(255) NOT NULL,   -- en clair, voir remarque ci-dessus
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table : clients
-- Utilisée dans : AjoutClient.php, ModifClient.php, Clients.php
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom`         VARCHAR(100) NOT NULL,
  `prenom`      VARCHAR(100) NOT NULL,
  `telephone`   VARCHAR(30)  NOT NULL,
  `age`         TINYINT UNSIGNED NOT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table : comptes
-- Utilisée dans : AjoutCompte.php, ModifCompte.php, comptes.php,
--                 TransactionCompte.php (dépôt/retrait -> solde)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `comptes`;
CREATE TABLE `comptes` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero`      VARCHAR(30)  NOT NULL,
  `client_id`   INT UNSIGNED NOT NULL,
  `solde`       DECIMAL(14,2) NOT NULL DEFAULT 0,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_numero` (`numero`),
  KEY `idx_client` (`client_id`),
  CONSTRAINT `fk_compte_client`
    FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
--  DONNÉES DE DÉMARRAGE
-- ============================================================

-- Compte de connexion (mot de passe en clair, comme attendu par ControlConnexion.php)
INSERT INTO `utilisateurs` (`nom`, `login`, `password`) VALUES
  ('Adji Farimata Cissé', 'admin', 'admin123');

-- Quelques clients de test
INSERT INTO `clients` (`nom`, `prenom`, `telephone`, `age`) VALUES
  ('Diop',   'Awa',      '77 123 45 67', 34),
  ('Ndiaye', 'Moussa',   '78 234 56 78', 41),
  ('Sarr',   'Fatou',    '76 345 67 89', 27),
  ('Ba',     'Ibrahima', '70 456 78 90', 52);

-- Comptes de test associés
INSERT INTO `comptes` (`numero`, `client_id`, `solde`) VALUES
  ('CB-0001', 1, 250000.00),
  ('CB-0002', 2, 75000.00),
  ('CB-0003', 3, 1200000.00),
  ('CB-0004', 4, 0.00);
