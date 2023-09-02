-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 15 août 2023 à 16:25
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ela`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `idActivity` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `typeActivity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dateActivite` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idActivity`),
  KEY `activities_iduser_foreign` (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`idActivity`, `typeActivity`, `idUser`, `description`, `dateActivite`, `created_at`, `updated_at`) VALUES
(1, 'a Supprimé', 1, 'Le profisseur qzdqd zdddqddqz (14)', '0000-00-00', '2022-11-17 14:13:04', '2022-11-17 14:13:04'),
(2, 'a Réstauré', 1, 'Le profisseur Whitley Steven (4)', '0000-00-00', '2022-11-17 14:23:44', '2022-11-17 14:23:44'),
(3, 'a Réstauré', 1, 'Le profisseur Foreman Maria (5)', '0000-00-00', '2022-11-17 14:23:44', '2022-11-17 14:23:44'),
(4, 'a Réstauré', 1, 'Le profisseur Morgan Ian (6)', '0000-00-00', '2022-11-17 14:23:44', '2022-11-17 14:23:44'),
(5, 'a Réstauré', 1, 'Le profisseur qzdqd zdddqddqz (14)', '0000-00-00', '2022-11-17 14:23:44', '2022-11-17 14:23:44'),
(6, 'a Réstauré', 1, 'Le profisseur qzdqd zdddqddqz (15)', '0000-00-00', '2022-11-17 14:23:44', '2022-11-17 14:23:44'),
(7, 'a Supprimé', 1, 'Le profisseur qzdqd zdddqddqz (15)', '0000-00-00', '2022-11-17 14:28:59', '2022-11-17 14:28:59'),
(8, 'a Ajouté', 1, 'Le profisseur qzqzdqzqzdqdA5554', '0000-00-00', '2022-11-19 14:34:43', '2022-11-19 14:34:43'),
(9, 'a Ajouté', 1, 'Le profisseur otmanmzoughU6461', '0000-00-00', '2022-11-19 14:35:57', '2022-11-19 14:35:57'),
(10, 'a Supprimé', 1, 'Le profisseur qzdqd qzqzdqz (16)', '0000-00-00', '2022-11-19 14:36:07', '2022-11-19 14:36:07'),
(11, 'a Supprimé', 1, 'Le profisseur qzdqd zdddqddqz (14)', '0000-00-00', '2022-11-19 14:36:16', '2022-11-19 14:36:16'),
(12, 'a Ajouté', 1, 'Le étudiants John Deo', '0000-00-00', '2022-11-19 14:39:09', '2022-11-19 14:39:09');

-- --------------------------------------------------------

--
-- Structure de la table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `idAttendance` int(11) NOT NULL AUTO_INCREMENT,
  `absence` varchar(50) DEFAULT NULL,
  `dateAbsence` date DEFAULT NULL,
  `note` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `matricule` varchar(50) NOT NULL,
  `idGroup` int(11) NOT NULL,
  PRIMARY KEY (`idAttendance`),
  KEY `matricule` (`matricule`),
  KEY `idGroup` (`idGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attendance`
--

INSERT INTO `attendance` (`idAttendance`, `absence`, `dateAbsence`, `note`, `updated_at`, `matricule`, `idGroup`) VALUES
(3, '1', '2022-09-11', NULL, '2022-09-28 00:27:36', 'ELA100-2022', 4),
(4, '0', '2022-09-11', NULL, '2022-09-15 01:15:12', 'ELA1-2022', 4),
(5, '1', '2022-09-28', NULL, '2022-09-28 00:27:31', 'ELA100-2022', 6),
(6, '0', '2022-10-07', NULL, '2022-09-27 23:41:06', 'ELA12-2022', 5);

-- --------------------------------------------------------

--
-- Structure de la table `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `idGroup` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classrooms_ibfk_1` (`idGroup`),
  KEY `classrooms_ibfk_2` (`matricule`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classrooms`
--

INSERT INTO `classrooms` (`id`, `CREATED_AT`, `UPDATED_AT`, `matricule`, `idGroup`) VALUES
(15, '2022-08-21 13:49:04', '2022-08-21 13:49:04', 'ELA1-2022', 5),
(18, '2022-08-21 13:55:20', '2022-08-21 13:55:20', 'ELA100-2022', 4),
(20, '2022-08-22 12:21:02', '2022-08-22 12:21:02', 'ELA1-2022', 4);

-- --------------------------------------------------------

--
-- Structure de la table `coursetype`
--

DROP TABLE IF EXISTS `coursetype`;
CREATE TABLE IF NOT EXISTS `coursetype` (
  `idCourseType` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(50) DEFAULT NULL,
  `shortForm` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCourseType`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `coursetype`
--

INSERT INTO `coursetype` (`idCourseType`, `course`, `shortForm`) VALUES
(1, 'Communication', 'C'),
(2, 'Cours de Soutiens', 'CS'),
(12, 'Formation', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `expensepayment`
--

DROP TABLE IF EXISTS `expensepayment`;
CREATE TABLE IF NOT EXISTS `expensepayment` (
  `idExpensePayment` int(11) NOT NULL AUTO_INCREMENT,
  `datePayment` date DEFAULT NULL,
  `amout` double DEFAULT NULL,
  `description` text,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  `DELETED_AT` timestamp NULL DEFAULT NULL,
  `idStaff` int(11) DEFAULT NULL,
  `idExpense` int(11) NOT NULL,
  PRIMARY KEY (`idExpensePayment`),
  KEY `idStaff` (`idStaff`),
  KEY `idExpense` (`idExpense`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `expensepayment`
--

INSERT INTO `expensepayment` (`idExpensePayment`, `datePayment`, `amout`, `description`, `CREATED_AT`, `UPDATED_AT`, `DELETED_AT`, `idStaff`, `idExpense`) VALUES
(4, '2022-09-23', 500, 'dqdqzdqzdqzd', '2022-09-22 23:43:34', '2022-09-24 10:03:18', NULL, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `idExpense` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `code` varchar(3) DEFAULT NULL COMMENT '000: Professeur\r\n111: Staffs',
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idExpense`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `expenses`
--

INSERT INTO `expenses` (`idExpense`, `designation`, `code`, `description`) VALUES
(2, 'Staffs', '111', 'Dépenses payées au Staffs'),
(3, 'Professeurs', '000', 'Dépenses payées aux Professeurs'),
(4, 'Electricité', NULL, 'Factures d\'électricité');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `idGrade` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(50) DEFAULT NULL,
  `idGradeCategory` int(11) NOT NULL,
  PRIMARY KEY (`idGrade`),
  KEY `idGradeCategory` (`idGradeCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`idGrade`, `grade`, `idGradeCategory`) VALUES
(1, '1er Année', 1),
(2, '2ème Année', 1),
(8, '3ème Année', 1),
(9, '4ème Année', 1),
(10, '5ème Année', 1),
(11, '6ème Année', 1),
(12, 'A1', 2),
(13, 'A2', 2),
(14, 'B1', 2),
(15, 'B2', 2),
(16, 'C1', 2),
(17, 'C2', 2),
(18, '1èr Année', 3),
(19, '2ème Année', 3),
(20, '3ème Année', 3),
(21, 'TC', 4),
(22, '1Bac', 4),
(23, '2Bac', 4);

-- --------------------------------------------------------

--
-- Structure de la table `gradescategories`
--

DROP TABLE IF EXISTS `gradescategories`;
CREATE TABLE IF NOT EXISTS `gradescategories` (
  `idGradeCategory` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `idCourseType` int(11) NOT NULL,
  PRIMARY KEY (`idGradeCategory`),
  KEY `FOREIGN KEY TYPE 0` (`idCourseType`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gradescategories`
--

INSERT INTO `gradescategories` (`idGradeCategory`, `category`, `description`, `idCourseType`) VALUES
(1, 'Primaire', 'Les niveaux scolaires du primaire', 2),
(2, 'Communication', 'Les niveaux des langues du communication', 1),
(3, 'Collège', 'Les niveaux scolaires du collège', 2),
(4, 'Lycée', 'Les niveaux Scolaires du Lycée', 2);

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  `idSubject` int(11) NOT NULL,
  `idGrade` int(11) NOT NULL,
  `idStaff` int(11) NOT NULL,
  PRIMARY KEY (`idGroup`),
  KEY `idCourseType` (`idSubject`),
  KEY `idGrade` (`idGrade`),
  KEY `idStaff` (`idStaff`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`idGroup`, `designation`, `capacity`, `CREATED_AT`, `UPDATED_AT`, `idSubject`, `idGrade`, `idStaff`) VALUES
(4, 'G1-ANG-A1', '30', '2022-08-19 17:47:25', '2022-08-19 17:47:25', 2, 12, 4),
(5, 'G2-ANG-A1', '20', '2022-08-19 17:47:43', '2022-08-19 17:47:43', 2, 12, 4),
(6, 'G1-MATH-SM', '20', '2022-08-22 12:26:19', '2022-08-22 12:26:19', 4, 22, 5);

-- --------------------------------------------------------

--
-- Structure de la table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
CREATE TABLE IF NOT EXISTS `incomes` (
  `idIncome` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `code` int(11) DEFAULT NULL COMMENT 'Etudiant:222',
  PRIMARY KEY (`idIncome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `incomes`
--

INSERT INTO `incomes` (`idIncome`, `designation`, `description`, `code`) VALUES
(2, 'mars', 'frais', 222);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2022_10_11_163411_create_roles_table', 2),
(3, '2014_10_12_000000_create_users_table', 3),
(4, '2014_10_12_100000_create_password_resets_table', 3),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 3),
(6, '2019_08_19_000000_create_failed_jobs_table', 3),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(8, '2022_10_16_233704_create_sessions_table', 3),
(11, '2022_10_19_010928_create_activites_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `idPayment` int(11) NOT NULL AUTO_INCREMENT,
  `datePayment` date DEFAULT NULL,
  `paymentMode` varchar(50) DEFAULT NULL COMMENT 'Virement Bancaire / Espèce',
  `amout` double DEFAULT NULL,
  `description` text,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  `DELETED_AT` timestamp NULL DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `idIncome` int(11) NOT NULL,
  PRIMARY KEY (`idPayment`),
  KEY `matricule` (`matricule`),
  KEY `idIncome` (`idIncome`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`idPayment`, `datePayment`, `paymentMode`, `amout`, `description`, `CREATED_AT`, `UPDATED_AT`, `DELETED_AT`, `matricule`, `idIncome`) VALUES
(4, '2022-09-21', 'Espece', 200, 'arabe', '2022-09-23 01:31:16', '2022-09-22 23:31:16', NULL, 'ELA100-2022', 2),
(5, '2022-09-23', 'Espece', 200, 'espanol', '2022-09-23 01:26:11', '2022-09-22 23:26:11', NULL, 'ELA1-2022', 2),
(6, '2022-09-23', 'Espece', 200, 'dqqdqdqd', '2022-09-23 09:30:42', '2022-09-23 09:30:42', NULL, 'ELA1-2022', 2);

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `responsibles`
--

DROP TABLE IF EXISTS `responsibles`;
CREATE TABLE IF NOT EXISTS `responsibles` (
  `cnieResponsible` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `numTel` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  PRIMARY KEY (`cnieResponsible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `responsibles`
--

INSERT INTO `responsibles` (`cnieResponsible`, `nom`, `prenom`, `numTel`, `sexe`, `CREATED_AT`, `UPDATED_AT`) VALUES
('U10000', 'Rylee', 'Regina', '0621551053', 'Homme', '2022-03-23 01:51:36', '2022-08-07 17:15:40'),
('U10002', 'Caesar', 'Merrill', '0635447122', 'Homme', '2022-01-17 11:08:34', '2022-08-07 17:15:40'),
('U10003', 'Maxwell', 'Barrett', '0652515192', 'Femme', '2022-06-10 23:20:09', '2022-08-07 17:15:40'),
('U10004', 'Rashad', 'Adrian', '0668987653', 'Femme', '2022-03-13 15:24:08', '2022-08-07 17:15:40'),
('U10005', 'Marvin', 'Glenna', '0675786844', 'Homme', '2021-10-06 18:10:00', '2022-08-07 17:15:40'),
('U10006', 'Grace', 'Mercedes', '0628847585', 'Homme', '2022-04-15 08:21:17', '2022-08-07 17:15:40'),
('U10007', 'Meghan', 'Halee', '0629603871', 'Homme', '2022-01-05 15:56:18', '2022-08-07 17:15:40'),
('U10008', 'Martin', 'Xander', '0654678076', 'Homme', '2021-12-07 22:52:10', '2022-08-07 17:15:40'),
('U10009', 'Daria', 'Darrel', '0621813126', 'Homme', '2022-03-28 06:47:42', '2022-08-07 17:15:40'),
('U10010', 'Simone', 'Duncan', '0684735579', 'Homme', '2021-11-23 02:57:39', '2022-08-07 17:15:40'),
('U10011', 'Dale', 'Acton', '0604274251', 'Homme', '2022-01-15 01:17:13', '2022-08-07 17:15:40'),
('U10012', 'Tana', 'Indigo', '0627967976', 'Femme', '2021-10-25 02:08:52', '2022-08-07 17:15:40'),
('U10013', 'Patricia', 'Charlotte', '0684860556', 'Femme', '2021-08-16 11:23:21', '2022-08-07 17:15:40'),
('U10014', 'Katelyn', 'Dean', '0693512698', 'Homme', '2022-05-30 04:58:11', '2022-08-07 17:15:40'),
('U10015', 'Howard', 'Celeste', '0648366178', 'Femme', '2022-04-03 05:44:12', '2022-08-07 17:15:40'),
('U10016', 'Julian', 'Drew', '0632683170', 'Femme', '2021-09-03 00:24:12', '2022-08-07 17:15:40'),
('U10017', 'Armando', 'Elvis', '0678454660', 'Homme', '2022-07-02 15:28:28', '2022-08-07 17:15:40'),
('U10018', 'Irene', 'Garrison', '0699602075', 'Femme', '2022-05-14 15:00:08', '2022-08-07 17:15:40'),
('U10019', 'Wynne', 'Wayne', '0645790736', 'Homme', '2022-07-18 15:20:31', '2022-08-07 17:15:40'),
('U10020', 'Lee', 'Blaze', '0635361967', 'Homme', '2021-11-16 08:24:23', '2022-08-07 17:15:40'),
('U10021', 'Ivy', 'Ginger', '0614424872', 'Homme', '2021-12-01 03:20:02', '2022-08-07 17:15:40'),
('U10022', 'Jamalia', 'Caryn', '0602569842', 'Femme', '2022-03-05 18:55:34', '2022-08-07 17:15:40'),
('U10023', 'Colton', 'Katelyn', '0633316812', 'Femme', '2022-03-03 23:06:38', '2022-08-07 17:15:40'),
('U10024', 'Driscoll', 'Shay', '0638673746', 'Homme', '2022-07-10 16:02:49', '2022-08-07 17:15:40'),
('U10025', 'Bianca', 'Kenneth', '0616138112', 'Femme', '2022-04-22 05:41:52', '2022-08-07 17:15:40'),
('U10026', 'Kenyon', 'Avye', '0654649373', 'Homme', '2022-05-15 07:59:30', '2022-08-07 17:15:40'),
('U10027', 'Gavin', 'Wing', '0647133746', 'Femme', '2022-01-18 23:07:27', '2022-08-07 17:15:40'),
('U10028', 'Emerald', 'Troy', '0656754846', 'Homme', '2021-09-07 10:58:01', '2022-08-07 17:15:40'),
('U10029', 'Arthur', 'Catherine', '0665524782', 'Femme', '2021-09-25 05:25:15', '2022-08-07 17:15:40'),
('U10030', 'Charles', 'Sheila', '0635784775', 'Femme', '2022-05-09 10:18:55', '2022-08-07 17:15:40'),
('U10031', 'Keane', 'Plato', '0644511436', 'Femme', '2022-05-23 22:31:26', '2022-08-07 17:15:40'),
('U10033', 'Ariana', 'Chandler', '0618454515', 'Femme', '2022-01-02 21:16:21', '2022-08-07 17:15:40'),
('U10034', 'Noel', 'Logan', '0690158668', 'Homme', '2021-09-26 10:45:06', '2022-08-07 17:15:40'),
('U10035', 'Tyler', 'Germaine', '0698315115', 'Femme', '2022-03-07 14:03:44', '2022-08-07 17:15:40'),
('U10036', 'Kylie', 'Dominique', '0649874641', 'Femme', '2022-06-24 04:27:33', '2022-08-07 17:15:40'),
('U10037', 'Zephania', 'Jeremy', '0634222268', 'Homme', '2022-01-10 12:16:28', '2022-08-07 17:15:40'),
('U10038', 'Reagan', 'Ali', '0634562865', 'Homme', '2022-03-06 00:54:09', '2022-08-07 17:15:40'),
('U10039', 'Colin', 'Lewis', '0678612773', 'Femme', '2022-02-14 12:10:50', '2022-08-07 17:15:40'),
('U10040', 'Jamalia', 'Angelica', '0650776386', 'Femme', '2022-06-28 17:32:18', '2022-08-07 17:15:40'),
('U10041', 'Claire', 'Xaviera', '0653235593', 'Homme', '2022-01-01 06:19:26', '2022-08-07 17:15:40'),
('U10042', 'Beatrice', 'Flavia', '0674329713', 'Homme', '2022-05-15 04:16:11', '2022-08-07 17:15:40'),
('U10043', 'Shelley', 'Uma', '0653852218', 'Femme', '2021-08-19 03:40:55', '2022-08-07 17:15:40'),
('U10044', 'TaShya', 'Xantha', '0649789819', 'Homme', '2022-02-11 10:36:20', '2022-08-07 17:15:40'),
('U10045', 'Trevor', 'Duncan', '0624585446', 'Homme', '2021-12-26 03:51:40', '2022-08-07 17:15:40'),
('U10046', 'Sean', 'Reese', '0694775721', 'Homme', '2021-12-18 09:25:10', '2022-08-07 17:15:40'),
('U10047', 'Lisandra', 'Raymond', '0667513634', 'Femme', '2021-11-30 11:05:54', '2022-08-07 17:15:40'),
('U10048', 'Serena', 'Germane', '0668529652', 'Homme', '2022-01-09 08:37:57', '2022-08-07 17:15:40'),
('U10049', 'Rajah', 'Lydia', '0667282799', 'Homme', '2022-06-22 10:43:56', '2022-08-07 17:15:40'),
('U10050', 'Bethany', 'August', '0655467219', 'Homme', '2022-01-14 21:53:52', '2022-08-07 17:15:40'),
('U10051', 'Nyssa', 'Christopher', '0684685667', 'Femme', '2021-12-12 16:16:56', '2022-08-07 17:15:40'),
('U10052', 'Adria', 'Lee', '0645847644', 'Homme', '2021-10-05 22:08:53', '2022-08-07 17:15:40'),
('U10053', 'William', 'April', '0659431280', 'Femme', '2021-08-19 13:13:18', '2022-08-07 17:15:40'),
('U10054', 'Jerry', 'Keane', '0631982945', 'Homme', '2022-07-09 18:30:23', '2022-08-07 17:15:40'),
('U10055', 'Stuart', 'Emma', '0647533273', 'Homme', '2022-04-11 19:29:50', '2022-08-07 17:15:40'),
('U10056', 'Chaney', 'Colette', '0633746487', 'Femme', '2022-02-10 11:30:30', '2022-08-07 17:15:40'),
('U10057', 'Cassady', 'Laith', '0681434551', 'Homme', '2021-10-10 04:06:04', '2022-08-07 17:15:40'),
('U10058', 'Bruce', 'Uriel', '0666984184', 'Femme', '2022-07-24 08:55:07', '2022-08-07 17:15:40'),
('U10059', 'Martina', 'Desiree', '0651743746', 'Homme', '2021-11-14 14:46:54', '2022-08-07 17:15:40'),
('U10060', 'Jamalia', 'Erasmus', '0627033463', 'Femme', '2021-12-28 12:49:58', '2022-08-07 17:15:40'),
('U10061', 'Castor', 'Mari', '0614665052', 'Femme', '2022-04-19 15:28:56', '2022-08-07 17:15:40'),
('U10062', 'Quin', 'Jane', '0640628601', 'Femme', '2022-04-17 15:17:08', '2022-08-07 17:15:40'),
('U10063', 'Vielka', 'Rama', '0694822839', 'Femme', '2021-11-02 04:09:00', '2022-08-07 17:15:40'),
('U10064', 'Isabella', 'Beck', '0637827893', 'Femme', '2022-05-17 12:39:55', '2022-08-07 17:15:40'),
('U10065', 'Preston', 'Candice', '0645218758', 'Femme', '2021-12-11 19:07:20', '2022-08-07 17:15:40'),
('U10066', 'Fay', 'Quynn', '0669707154', 'Femme', '2022-04-01 04:31:07', '2022-08-07 17:15:40'),
('U10067', 'Jacob', 'Jordan', '0611815517', 'Femme', '2022-02-15 16:02:46', '2022-08-07 17:15:40'),
('U10068', 'Gareth', 'Isabelle', '0626486305', 'Femme', '2022-07-24 03:25:07', '2022-08-07 17:15:40'),
('U10069', 'Stella', 'Iona', '0692163885', 'Homme', '2021-11-19 14:12:44', '2022-08-07 17:15:40'),
('U10070', 'Lydia', 'Lani', '0646417123', 'Femme', '2022-04-21 09:16:37', '2022-08-07 17:15:40'),
('U10071', 'Stone', 'Axel', '0640495217', 'Homme', '2022-07-16 11:04:10', '2022-08-07 17:15:40'),
('U10072', 'Nathan', 'Kristen', '0616462165', 'Femme', '2022-05-14 19:12:20', '2022-08-07 17:15:40'),
('U10073', 'Savannah', 'Xandra', '0624315115', 'Homme', '2021-10-21 07:18:52', '2022-08-07 17:15:40'),
('U10074', 'Karly', 'Ayanna', '0650405425', 'Femme', '2021-10-31 21:51:59', '2022-08-07 17:15:40'),
('U10075', 'Vivian', 'Clark', '0684679849', 'Homme', '2022-07-21 10:38:43', '2022-08-07 17:15:40'),
('U10076', 'Hilda', 'Pandora', '0615537449', 'Femme', '2021-09-24 05:42:53', '2022-08-07 17:15:40'),
('U10077', 'Cairo', 'Zachary', '0669829516', 'Homme', '2022-01-04 02:46:54', '2022-08-07 17:15:40'),
('U10078', 'Keane', 'Buckminster', '0684633316', 'Homme', '2021-10-12 12:22:11', '2022-08-07 17:15:40'),
('U10079', 'Lamar', 'Garrison', '0630925414', 'Femme', '2021-12-20 11:04:31', '2022-08-07 17:15:40'),
('U10080', 'Aladdin', 'Fredericka', '0697348664', 'Femme', '2021-10-06 10:19:15', '2022-08-07 17:15:40'),
('U10081', 'Rigel', 'Ralph', '0691425257', 'Femme', '2022-07-15 09:02:27', '2022-08-07 17:15:40'),
('U10082', 'Lawrence', 'Halee', '0688411181', 'Homme', '2022-07-20 17:40:02', '2022-08-07 17:15:40'),
('U10083', 'Blake', 'Barclay', '0674937831', 'Homme', '2022-07-27 08:54:39', '2022-08-07 17:15:40'),
('U10084', 'Kathleen', 'Chandler', '0628384275', 'Homme', '2022-04-29 19:48:58', '2022-08-07 17:15:40'),
('U10085', 'Ursa', 'Cheyenne', '0658353626', 'Femme', '2021-09-30 20:07:59', '2022-08-07 17:15:40'),
('U10086', 'Dorian', 'Silas', '0615704430', 'Femme', '2021-12-18 20:45:19', '2022-08-07 17:15:40'),
('U10087', 'Kalia', 'Avram', '0662733870', 'Femme', '2021-12-23 15:34:00', '2022-08-07 17:15:40'),
('U10088', 'Georgia', 'Hoyt', '0635245389', 'Homme', '2021-12-21 14:02:29', '2022-08-07 17:15:40'),
('U10089', 'Colt', 'Oren', '0661496686', 'Femme', '2022-02-21 03:00:40', '2022-08-07 17:15:40'),
('U10090', 'Arden', 'Elton', '0643310286', 'Femme', '2022-07-10 10:11:26', '2022-08-07 17:15:40'),
('U10091', 'Kasper', 'Candice', '0688854221', 'Femme', '2022-06-10 03:04:59', '2022-08-07 17:15:40'),
('U10092', 'Barrett', 'Maya', '0632784260', 'Femme', '2021-09-14 00:01:47', '2022-08-07 17:15:40'),
('U10093', 'Blossom', 'David', '0668142518', 'Homme', '2021-08-18 03:54:38', '2022-08-07 17:15:40'),
('U10094', 'Tasha', 'Deirdre', '0698221741', 'Homme', '2022-05-29 01:55:17', '2022-08-07 17:15:40'),
('U10095', 'Brody', 'Bell', '0685163296', 'Homme', '2021-09-29 20:00:25', '2022-08-07 17:15:40'),
('U10096', 'Lars', 'Chastity', '0651214633', 'Femme', '2022-05-13 20:12:12', '2022-08-07 17:15:40'),
('U10097', 'Iliana', 'Iris', '0623088636', 'Homme', '2021-09-13 12:01:55', '2022-08-07 17:15:40'),
('U10098', 'Jasmine', 'Renee', '0642442815', 'Femme', '2022-03-31 14:38:44', '2022-08-07 17:15:40'),
('U10099', 'Keefe', 'Jackson', '0628448442', 'Homme', '2021-12-13 09:23:15', '2022-08-07 17:15:40');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRole` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codeRole` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idRole`),
  UNIQUE KEY `roles_coderole_unique` (`codeRole`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `role`, `codeRole`, `color`) VALUES
(2, 'Administrateur', '00', '#ff0000'),
(3, 'Moderator', '11', '#0000ff');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3ctNGQdZ1Ye9MqQ6dWdUniIMxngJSgveFx2ypllR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiOTZQdzNvOUlCZjlmdGpPNnRNTEpyQk5kRUNObGV1SVo4ZlJvclNrdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6InVzZXIiO086MTU6IkFwcFxNb2RlbHNcVXNlciI6MzI6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjQ6e2k6MDtzOjQ6Im5hbWUiO2k6MTtzOjU6ImVtYWlsIjtpOjI7czo4OiJwYXNzd29yZCI7aTozO3M6NjoiaWRSb2xlIjt9czo5OiIAKgBoaWRkZW4iO2E6NDp7aTowO3M6ODoicGFzc3dvcmQiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7aToyO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO2k6MztzOjE3OiJ0d29fZmFjdG9yX3NlY3JldCI7fXM6ODoiACoAY2FzdHMiO2E6MTp7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6ODoiZGF0ZXRpbWUiO31zOjEwOiIAKgBhcHBlbmRzIjthOjE6e2k6MDtzOjE3OiJwcm9maWxlX3Bob3RvX3VybCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToidXNlcnMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxNzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czoxMjoiT3RtYW4gTXpvdWdoIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMCRJWmZMNXVzRTJabmdNaTZ5RkxFVzBlQVNKdU9aUUw1aHYuZHlxM3dmZDJNQzMyQWdMZi54aSI7czoxNzoidHdvX2ZhY3Rvcl9zZWNyZXQiO047czoyNToidHdvX2ZhY3Rvcl9yZWNvdmVyeV9jb2RlcyI7TjtzOjIzOiJ0d29fZmFjdG9yX2NvbmZpcm1lZF9hdCI7TjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjE1OiJjdXJyZW50X3RlYW1faWQiO047czoxODoicHJvZmlsZV9waG90b19wYXRoIjtOO3M6NjoiaWRSb2xlIjtpOjI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMi0xMC0xOCAxNTo0NTo1MCI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMi0xMC0xOCAxNTo0NTo1MCI7czo0OiJyb2xlIjtzOjE0OiJBZG1pbmlzdHJhdGV1ciI7czo4OiJjb2RlUm9sZSI7czoyOiIwMCI7czo1OiJjb2xvciI7czo3OiIjZmYwMDAwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTc6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6MTI6Ik90bWFuIE16b3VnaCI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7TjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTAkSVpmTDV1c0UyWm5nTWk2eUZMRVcwZUFTSnVPWlFMNWh2LmR5cTN3ZmQyTUMzMkFnTGYueGkiO3M6MTc6InR3b19mYWN0b3Jfc2VjcmV0IjtOO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO047czoyMzoidHdvX2ZhY3Rvcl9jb25maXJtZWRfYXQiO047czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxNToiY3VycmVudF90ZWFtX2lkIjtOO3M6MTg6InByb2ZpbGVfcGhvdG9fcGF0aCI7TjtzOjY6ImlkUm9sZSI7aToyO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjItMTAtMTggMTU6NDU6NTAiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjItMTAtMTggMTU6NDU6NTAiO3M6NDoicm9sZSI7czoxNDoiQWRtaW5pc3RyYXRldXIiO3M6ODoiY29kZVJvbGUiO3M6MjoiMDAiO3M6NToiY29sb3IiO3M6NzoiI2ZmMDAwMCI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fXM6MjA6IgAqAHJlbWVtYmVyVG9rZW5OYW1lIjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7czoxNDoiACoAYWNjZXNzVG9rZW4iO047fXM6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJElaZkw1dXNFMlpuZ01pNnlGTEVXMGVBU0p1T1pRTDVodi5keXEzd2ZkMk1DMzJBZ0xmLnhpIjt9', 1668874908),
('anQnDes3hXtZhnOpAQLu3aTRgAFsoHv8UHeXwVHB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaVpGMW5CQ2s3YUFNaVpUc0RkZENtTGx0T1k1MmhxdFJYVFlhbWhBUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1668872008),
('wW1kZsepCpZiYk2mH3D5CL3OlmocDa5RP3aMcjDv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTFdTdDRUMU5WcWhXSWZzVDlWT3VxQmVha2JISTU3bkxqNHJuS3FTVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbml2ZWF1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6InVzZXIiO086MTU6IkFwcFxNb2RlbHNcVXNlciI6MzI6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjQ6e2k6MDtzOjQ6Im5hbWUiO2k6MTtzOjU6ImVtYWlsIjtpOjI7czo4OiJwYXNzd29yZCI7aTozO3M6NjoiaWRSb2xlIjt9czo5OiIAKgBoaWRkZW4iO2E6NDp7aTowO3M6ODoicGFzc3dvcmQiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7aToyO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO2k6MztzOjE3OiJ0d29fZmFjdG9yX3NlY3JldCI7fXM6ODoiACoAY2FzdHMiO2E6MTp7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6ODoiZGF0ZXRpbWUiO31zOjEwOiIAKgBhcHBlbmRzIjthOjE6e2k6MDtzOjE3OiJwcm9maWxlX3Bob3RvX3VybCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToidXNlcnMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxNzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czoxMjoiT3RtYW4gTXpvdWdoIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMCRJWmZMNXVzRTJabmdNaTZ5RkxFVzBlQVNKdU9aUUw1aHYuZHlxM3dmZDJNQzMyQWdMZi54aSI7czoxNzoidHdvX2ZhY3Rvcl9zZWNyZXQiO047czoyNToidHdvX2ZhY3Rvcl9yZWNvdmVyeV9jb2RlcyI7TjtzOjIzOiJ0d29fZmFjdG9yX2NvbmZpcm1lZF9hdCI7TjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjE1OiJjdXJyZW50X3RlYW1faWQiO047czoxODoicHJvZmlsZV9waG90b19wYXRoIjtOO3M6NjoiaWRSb2xlIjtpOjI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMi0xMC0xOCAxNTo0NTo1MCI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMi0xMC0xOCAxNTo0NTo1MCI7czo0OiJyb2xlIjtzOjE0OiJBZG1pbmlzdHJhdGV1ciI7czo4OiJjb2RlUm9sZSI7czoyOiIwMCI7czo1OiJjb2xvciI7czo3OiIjZmYwMDAwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTc6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6MTI6Ik90bWFuIE16b3VnaCI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7TjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTAkSVpmTDV1c0UyWm5nTWk2eUZMRVcwZUFTSnVPWlFMNWh2LmR5cTN3ZmQyTUMzMkFnTGYueGkiO3M6MTc6InR3b19mYWN0b3Jfc2VjcmV0IjtOO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO047czoyMzoidHdvX2ZhY3Rvcl9jb25maXJtZWRfYXQiO047czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxNToiY3VycmVudF90ZWFtX2lkIjtOO3M6MTg6InByb2ZpbGVfcGhvdG9fcGF0aCI7TjtzOjY6ImlkUm9sZSI7aToyO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjItMTAtMTggMTU6NDU6NTAiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjItMTAtMTggMTU6NDU6NTAiO3M6NDoicm9sZSI7czoxNDoiQWRtaW5pc3RyYXRldXIiO3M6ODoiY29kZVJvbGUiO3M6MjoiMDAiO3M6NToiY29sb3IiO3M6NzoiI2ZmMDAwMCI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fXM6MjA6IgAqAHJlbWVtYmVyVG9rZW5OYW1lIjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7czoxNDoiACoAYWNjZXNzVG9rZW4iO047fXM6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJElaZkw1dXNFMlpuZ01pNnlGTEVXMGVBU0p1T1pRTDVodi5keXEzd2ZkMk1DMzJBZ0xmLnhpIjt9', 1681837752);

-- --------------------------------------------------------

--
-- Structure de la table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `idSetting` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `logo` text NOT NULL,
  PRIMARY KEY (`idSetting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `idStaff` int(11) NOT NULL AUTO_INCREMENT,
  `cnie` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numTel` varchar(50) DEFAULT NULL,
  `dateEngagement` date DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `DELETED_AT` datetime DEFAULT NULL,
  `idStaffType` int(11) DEFAULT NULL,
  `idSubject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idStaff`),
  KEY `idStaffType` (`idStaffType`),
  KEY `idSubject` (`idSubject`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`idStaff`, `cnie`, `nom`, `prenom`, `sexe`, `email`, `numTel`, `dateEngagement`, `UPDATED_AT`, `DELETED_AT`, `idStaffType`, `idSubject`) VALUES
(1, 'U156123', 'Deo', 'John', '', 'johnexample@gmail.com', '0612345678', '2022-08-03', '2022-11-16 18:13:04', NULL, 4, NULL),
(3, '539', 'Lam', 'June', 'F', 'ezekiel_lueilwi@hotmail.com', '443-405-3105', '2022-08-05', '2022-11-15 15:39:28', NULL, NULL, 1),
(4, '544', 'Whitley', 'Steven', 'M', 'oren2004@yahoo.com', '512-544-5406', '2022-08-05', '2022-11-17 15:23:44', NULL, NULL, 2),
(5, '650', 'Foreman', 'Maria', 'F', 'hunter_grad6@gmail.com', '847-650-2181', '2022-08-05', '2022-11-17 15:23:44', NULL, NULL, 4),
(6, '5094', 'Morgan', 'Ian', 'M', 'santina1999@gmail.com', '716-693-5094', '2022-08-05', '2022-11-17 15:23:44', NULL, NULL, 5),
(10, 'U156', 'Deo', 'John', '', 'johnexample@gmail.com', '0612345678', '2022-10-19', '2022-11-16 18:18:14', NULL, 1, NULL),
(14, '42', 'qzdqd', 'zdddqddqz', 'M', 'chakirouassim@gmail.com', '7577575', '2022-11-17', '2022-11-19 15:36:16', '2022-11-19 15:36:16', NULL, 2),
(15, '42', 'qzdqd', 'zdddqddqz', 'M', 'chakirouassim@gmail.com', '7577575', '2022-11-17', '2022-11-17 15:28:59', '2022-11-17 15:28:59', NULL, 2),
(16, 'A5554', 'qzdqd', 'qzqzdqz', 'M', 'chakirouassim@gmail.com', '0675775775', '2022-11-19', '2022-11-19 15:36:07', '2022-11-19 15:36:07', NULL, 4),
(17, 'U6461', 'mzough', 'otman', 'M', 'oxman12@gmail.com', '0646044127', '2022-11-19', '2022-11-19 15:35:57', NULL, NULL, 5),
(18, 'U156', 'Deo', 'John', 'Homme', 'johnexample@gmail.com', '0612345678', '2022-11-19', '2022-11-19 15:39:09', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stafftype`
--

DROP TABLE IF EXISTS `stafftype`;
CREATE TABLE IF NOT EXISTS `stafftype` (
  `idStaffType` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idStaffType`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stafftype`
--

INSERT INTO `stafftype` (`idStaffType`, `designation`) VALUES
(1, 'Secrétaires'),
(3, 'Professeurs'),
(4, 'Manager'),
(5, 'Ménage');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `matricule` varchar(50) NOT NULL,
  `nom_ar` varchar(50) DEFAULT NULL,
  `nom_fr` varchar(50) DEFAULT NULL,
  `prenom_ar` varchar(50) DEFAULT NULL,
  `prenom_fr` varchar(50) DEFAULT NULL,
  `cnie` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numTel` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `dateNaissance` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `cnieResponsible` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`matricule`),
  KEY `idResponsible` (`cnieResponsible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`matricule`, `nom_ar`, `nom_fr`, `prenom_ar`, `prenom_fr`, `cnie`, `email`, `numTel`, `sexe`, `adresse`, `dateNaissance`, `CREATED_AT`, `UPDATED_AT`, `deleted_at`, `cnieResponsible`) VALUES
('ELA1-2022', NULL, 'Shad', NULL, 'Alec', 'T2763471', 'ac.libero@aol.edu', '0344156389', 'Homme', 'P.O. Box 469, 5051 Mattis Avenue', '2001-02-15', '2022-08-07 17:07:11', '2022-11-16 17:21:18', NULL, NULL),
('ELA10-2022', NULL, 'Ali', NULL, 'Susan', 'V8569296', 'semper.egestas.urna@icloud.ca', '0797376625', 'Femme', '508-5745 Morbi Av.', '2002-06-14', '2022-08-07 17:07:11', '2022-11-16 17:21:18', NULL, 'U10010'),
('ELA100-2022', NULL, 'Dai', NULL, 'Joseph', 'S2237124', 'enim@protonmail.com', '0659544774', 'Homme', 'Ap #123-2963 Gravida Road', '2004-06-27', '2022-08-07 17:07:11', '2022-10-20 15:37:18', '2022-10-20 15:37:18', 'U10000'),
('ELA11-2022', 'qdzd', 'Lillian', '8تا', 'Daquan', 'I8744871', 'tempor@hotmail.org', '0845811067', 'Femme', '960-3897 Pellentesque St.', '2004-04-01', '2022-08-07 17:07:11', '2022-11-15 17:04:45', '2022-11-15 17:04:45', 'U10011'),
('ELA12-2022', NULL, 'Farrah', NULL, 'Wallace', 'J8142728', 'phasellus@google.org', '0423182102', 'Homme', 'P.O. Box 897, 4510 A, Street', '2002-04-18', '2022-08-07 17:07:11', '2022-11-16 15:35:21', '2022-11-16 15:35:21', 'U10012'),
('ELA13-2022', NULL, 'Veronica', NULL, 'Acton', 'C3108439', 'mollis.nec@protonmail.com', '0105716361', 'Femme', 'Ap #955-9851 Velit St.', '2001-01-25', '2022-08-07 17:07:11', '2022-08-25 22:54:43', '2022-08-25 22:54:43', 'U10013'),
('ELA14-2022', NULL, 'Gray', NULL, 'Macaulay', 'H4821262', 'cursus.et@yahoo.ca', '0758344521', 'Homme', 'P.O. Box 690, 2867 Malesuada St.', '2001-12-05', '2022-08-07 17:07:11', '2022-10-20 02:30:00', '2022-10-20 02:30:00', 'U10014'),
('ELA15-2022', NULL, 'Zeph', NULL, 'Camilla', 'R4333444', 'suspendisse.commodo@outlook.com', '0238284743', 'Femme', 'P.O. Box 920, 9110 Augue Av.', '2003-04-17', '2022-08-07 17:07:11', '2022-11-16 15:36:25', '2022-11-16 15:36:25', 'U10015'),
('ELA16-2022', NULL, 'Ulric', NULL, 'Kerry', 'F7369888', 'arcu@yahoo.com', '0290923757', 'Femme', '345-1821 Arcu. Road', '2003-10-09', '2022-08-07 17:07:11', '2022-11-16 15:41:06', '2022-11-16 15:41:06', 'U10016'),
('ELA17-2022', NULL, 'Brielle', NULL, 'Tamara', 'J2345857', 'nec.enim@google.couk', '0248315361', 'Homme', '4419 Urna St.', '2003-01-29', '2022-08-07 17:07:11', '2022-11-16 15:46:07', '2022-11-16 15:46:07', 'U10017'),
('ELA18-2022', NULL, 'Samson', NULL, 'Zachary', 'L4838055', 'vestibulum.lorem.sit@hotmail.org', '0912484846', 'Homme', '5734 Egestas Av.', '2004-11-29', '2022-08-07 17:07:11', '2022-11-16 15:36:58', '2022-11-16 15:36:58', 'U10018'),
('ELA19-2022', NULL, 'Ivan', NULL, 'Wynter', 'O2155183', 'ut.cursus@protonmail.ca', '0185515767', 'Femme', '217-928 Quis Rd.', '2001-10-09', '2022-08-07 17:07:11', '2022-11-16 17:21:40', NULL, 'U10019'),
('ELA2-2022', NULL, 'Travis', NULL, 'Melinda', 'S4148837', 'volutpat.ornare@google.couk', '0777236603', 'Homme', '2025 Suspendisse Street', '2003-07-09', '2022-08-07 17:07:11', '2022-11-16 15:53:33', '2022-11-16 15:53:33', 'U10002'),
('ELA20-2022', NULL, 'Andrew', NULL, 'Oleg', 'W1203223', 'lacinia.at@icloud.net', '0874350015', 'Femme', 'Ap #835-6896 Urna. Road', '2001-04-29', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10020'),
('ELA21-2022', NULL, 'Demetria', NULL, 'Sarah', 'X3713383', 'lobortis@outlook.org', '0358851593', 'Homme', 'Ap #579-4588 Sed Rd.', '2002-07-05', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10021'),
('ELA22-2022', NULL, 'Dale', NULL, 'Suki', 'T1771508', 'semper.erat@google.edu', '0317669694', 'Homme', '309-3291 Sed Street', '2003-05-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10022'),
('ELA23-2022', NULL, 'Kellie', NULL, 'Fritz', 'Z6371015', 'vel@google.edu', '0364580892', 'Homme', '1751 Mauris. Avenue', '2004-08-22', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10023'),
('ELA24-2022', NULL, 'Micah', NULL, 'Plato', 'H2668787', 'erat@google.net', '0363449126', 'Femme', '4758 Duis Rd.', '2004-11-30', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10024'),
('ELA25-2022', NULL, 'Owen', NULL, 'Carla', 'B8464582', 'risus.a@icloud.ca', '0986135008', 'Homme', '2436 Urna, Street', '2005-02-17', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10025'),
('ELA26-2022', NULL, 'Wesley', NULL, 'Kessie', 'W8710822', 'enim.nisl.elementum@icloud.com', '0928356682', 'Homme', '216-5162 Nec Ave', '2003-09-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10026'),
('ELA27-2022', NULL, 'Christine', NULL, 'Brenden', 'W3641504', 'vitae.erat@google.ca', '0387816428', 'Femme', '576-3135 Magna St.', '2004-07-20', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10027'),
('ELA28-2022', NULL, 'Maris', NULL, 'Brady', 'H4125506', 'lacus.mauris.non@icloud.com', '0863328360', 'Homme', '3598 Integer Road', '2004-02-02', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10028'),
('ELA29-2022', NULL, 'Darius', NULL, 'Jescie', 'P2806067', 'ipsum@yahoo.edu', '0257885778', 'Femme', '9964 Consequat Street', '2004-05-10', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10029'),
('ELA3-2022', NULL, 'Jordan', NULL, 'Desiree', 'Y7675457', 'vitae@google.couk', '0514656476', 'Femme', 'Ap #201-7858 Sollicitudin St.', '2003-01-12', '2022-08-07 17:07:11', '2022-11-16 17:21:19', NULL, 'U10003'),
('ELA30-2022', NULL, 'Peter', NULL, 'Aimee', 'N9160691', 'euismod@aol.org', '0575357297', 'Homme', '109-2596 Sed Ave', '2005-02-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10030'),
('ELA31-2022', NULL, 'Josephine', NULL, 'Samson', 'A1827973', 'ac.ipsum.phasellus@yahoo.couk', '0746469187', 'Homme', 'Ap #541-6014 Sed Road', '2003-04-28', '2022-08-07 17:07:11', '2022-11-16 17:21:19', NULL, 'U10031'),
('ELA33-2022', NULL, 'Priscilla', NULL, 'Darryl', 'K3272492', 'odio.sagittis@outlook.edu', '0384488378', 'Femme', '293-8843 Eget St.', '2002-01-30', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10033'),
('ELA34-2022', NULL, 'Sonia', NULL, 'Melodie', 'U6387336', 'ultrices@google.org', '0615344468', 'Femme', '679-6056 Ut Av.', '2001-05-15', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10034'),
('ELA35-2022', NULL, 'Dolan', NULL, 'Scarlet', 'Q7843066', 'varius.orci@hotmail.couk', '0585491613', 'Femme', '652-7727 Consectetuer Rd.', '2003-03-14', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10035'),
('ELA36-2022', NULL, 'Mariko', NULL, 'Raven', 'L8192386', 'nunc.laoreet@protonmail.couk', '0529608909', 'Femme', 'Ap #117-9183 Non, Ave', '2002-09-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10036'),
('ELA37-2022', NULL, 'Jasmine', NULL, 'Quinn', 'P8800363', 'ut.eros.non@aol.net', '0934352635', 'Homme', '777-3199 Vel Avenue', '2002-06-20', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10037'),
('ELA38-2022', NULL, 'Bryar', NULL, 'Denton', 'O3676836', 'neque@google.net', '0296494245', 'Homme', '828-9192 Fermentum Road', '2002-02-01', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10038'),
('ELA39-2022', NULL, 'Risa', NULL, 'Autumn', 'F3766331', 'scelerisque.sed.sapien@icloud.org', '0203239165', 'Femme', '1817 Purus. St.', '2004-04-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10039'),
('ELA4-2022', NULL, 'Cassandra', NULL, 'Kiona', 'K2263468', 'curabitur.egestas.nunc@outlook.couk', '0301566630', 'Femme', '333-2475 Aliquet St.', '2001-03-30', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10004'),
('ELA40-2022', NULL, 'Maxine', NULL, 'Rhoda', 'M6812578', 'aliquet.sem@hotmail.com', '0551282892', 'Homme', 'Ap #856-7630 Vestibulum Avenue', '2001-07-04', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10040'),
('ELA41-2022', NULL, 'Dalton', NULL, 'Kelsie', 'K3450683', 'cras@google.com', '0678202338', 'Femme', 'P.O. Box 880, 6108 Integer Road', '2004-08-20', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10041'),
('ELA42-2022', NULL, 'Emmanuel', NULL, 'Noah', 'Y5337219', 'lacinia.mattis@yahoo.org', '0848046370', 'Homme', 'P.O. Box 436, 168 Donec St.', '2003-12-17', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10042'),
('ELA43-2022', NULL, 'Plato', NULL, 'Holmes', 'B5186314', 'mattis@icloud.couk', '0447018474', 'Femme', '7057 Velit Street', '2001-08-15', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10043'),
('ELA44-2022', NULL, 'Rooney', NULL, 'Autumn', 'F0658082', 'netus.et@yahoo.org', '0257941840', 'Homme', 'P.O. Box 578, 4255 Semper Ave', '2001-06-30', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10044'),
('ELA45-2022', NULL, 'Brynn', NULL, 'Solomon', 'B1524604', 'integer.id@yahoo.edu', '0806380197', 'Homme', '736-8777 Nam Avenue', '2002-03-23', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10045'),
('ELA46-2022', NULL, 'Susan', NULL, 'Hyacinth', 'V4822685', 'ornare.libero@icloud.edu', '0206941536', 'Femme', 'P.O. Box 818, 1164 Imperdiet, Rd.', '2003-01-20', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10046'),
('ELA47-2022', NULL, 'Ruby', NULL, 'Paloma', 'W2533332', 'ipsum@google.couk', '0302917763', 'Homme', '405-599 Nec, Rd.', '2003-05-30', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10047'),
('ELA48-2022', NULL, 'Georgia', NULL, 'Nevada', 'K6811817', 'amet.consectetuer@yahoo.ca', '0357167585', 'Homme', 'Ap #557-8634 Penatibus Road', '2002-09-18', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10048'),
('ELA49-2022', NULL, 'Maite', NULL, 'Adria', 'A5710845', 'fermentum.convallis@yahoo.edu', '0038828621', 'Homme', '843-3716 Molestie Rd.', '2003-10-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10049'),
('ELA5-2022', NULL, 'Sara', NULL, 'Magee', 'N3858657', 'vitae.purus@yahoo.com', '0667381451', 'Femme', '8372 Quis, Av.', '2002-07-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10005'),
('ELA50-2022', NULL, 'Sonia', NULL, 'Neil', 'I8783727', 'ipsum.dolor@yahoo.couk', '0430505664', 'Homme', 'Ap #168-3344 Gravida Av.', '2003-09-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10050'),
('ELA51-2022', NULL, 'Lavinia', NULL, 'Phyllis', 'J2784777', 'erat@aol.com', '0132880419', 'Femme', 'Ap #523-7742 Facilisis St.', '2005-01-03', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10051'),
('ELA52-2022', NULL, 'Elvis', NULL, 'Bruno', 'A4266294', 'sed.eu@yahoo.couk', '0934390620', 'Homme', 'P.O. Box 735, 8017 Tellus Avenue', '2003-11-12', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10052'),
('ELA53-2022', NULL, 'Alea', NULL, 'Alvin', 'F7154713', 'semper.erat@aol.net', '0718262433', 'Homme', '874-4441 Libero. Street', '2003-12-22', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10053'),
('ELA54-2022', NULL, 'Kelly', NULL, 'Katell', 'U8132363', 'velit.cras@hotmail.com', '0655434154', 'Femme', '406-8622 Non Rd.', '2003-05-11', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10054'),
('ELA55-2022', NULL, 'Jerome', NULL, 'Ciara', 'G7682461', 'dui@hotmail.org', '0222845552', 'Homme', 'P.O. Box 434, 7535 Nulla. St.', '2001-07-23', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10055'),
('ELA56-2022', NULL, 'Roanna', NULL, 'Anjolie', 'K6971578', 'ultricies.adipiscing@icloud.ca', '0817165163', 'Femme', '635 Egestas Av.', '2002-04-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10056'),
('ELA57-2022', NULL, 'Craig', NULL, 'Simon', 'I7775203', 'dictum.mi@hotmail.com', '0808794445', 'Homme', '271-595 Hymenaeos. Ave', '2004-07-14', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10057'),
('ELA58-2022', NULL, 'Juliet', NULL, 'Lars', 'D9102442', 'mi@yahoo.couk', '0331449484', 'Femme', '9849 Adipiscing Rd.', '2005-02-04', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10058'),
('ELA59-2022', NULL, 'Myra', NULL, 'Dora', 'Q7262957', 'parturient.montes.nascetur@yahoo.couk', '0161528219', 'Homme', '7645 Mus. Av.', '2003-07-21', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10059'),
('ELA6-2022', NULL, 'Mari', NULL, 'Quintessa', 'U9238306', 'nunc.mauris@aol.net', '0691411739', 'Femme', '353-167 Ante. Ave', '2001-11-02', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10006'),
('ELA60-2022', NULL, 'Helen', NULL, 'Sonia', 'O8742488', 'neque.nullam@icloud.ca', '0671342063', 'Femme', 'P.O. Box 329, 6262 Mi Rd.', '2003-09-04', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10060'),
('ELA61-2022', NULL, 'Elizabeth', NULL, 'Ariel', 'O1108966', 'tellus.aenean@yahoo.couk', '0326705793', 'Homme', 'Ap #434-9390 Nulla Avenue', '2003-09-06', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10061'),
('ELA62-2022', NULL, 'Galena', NULL, 'Macaulay', 'A6545015', 'a.sollicitudin@protonmail.edu', '0137366371', 'Homme', '9848 Iaculis Avenue', '2005-02-23', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10062'),
('ELA63-2022', NULL, 'Elmo', NULL, 'Jescie', 'G1584478', 'ultricies.ligula@outlook.com', '0227851220', 'Femme', 'P.O. Box 804, 5044 Nunc Ave', '2003-08-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10063'),
('ELA64-2022', NULL, 'Talon', NULL, 'Amir', 'Y7434648', 'nam.porttitor@outlook.org', '0616742735', 'Femme', '541-9185 Phasellus Ave', '2004-07-09', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10064'),
('ELA65-2022', NULL, 'Kuame', NULL, 'Reese', 'P1192572', 'velit.egestas@icloud.ca', '0837586798', 'Femme', 'Ap #559-8678 Nullam St.', '2001-03-02', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10065'),
('ELA66-2022', NULL, 'Berk', NULL, 'Deacon', 'J9178295', 'aliquet.magna@hotmail.com', '0223115968', 'Homme', '7347 Iaculis Rd.', '2001-10-26', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10066'),
('ELA67-2022', NULL, 'Nadine', NULL, 'Hyatt', 'N1136948', 'sapien.imperdiet.ornare@aol.com', '0377461176', 'Homme', 'Ap #236-2917 Tempor St.', '2005-01-13', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10067'),
('ELA68-2022', NULL, 'Patrick', NULL, 'Raya', 'W3741478', 'lacus.aliquam.rutrum@aol.com', '0718648925', 'Homme', '268-2086 Semper Rd.', '2004-11-14', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10068'),
('ELA69-2022', NULL, 'Constance', NULL, 'Boris', 'I2511884', 'sed.eu@outlook.ca', '0761788352', 'Homme', '8188 Fringilla St.', '2003-04-09', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10069'),
('ELA7-2022', NULL, 'Doris', NULL, 'Kyle', 'D4147718', 'tincidunt.orci.quis@hotmail.couk', '0829855035', 'Homme', 'Ap #878-4935 Mauris, Road', '2004-10-29', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10007'),
('ELA70-2022', NULL, 'Lance', NULL, 'Dawn', 'R3633541', 'sed@icloud.net', '0942706891', 'Homme', '482-9356 Proin Avenue', '2003-10-29', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10070'),
('ELA71-2022', NULL, 'Olga', NULL, 'Ina', 'O5208412', 'semper.tellus@google.net', '0076986581', 'Homme', '600-7622 Dolor Ave', '2002-07-01', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10071'),
('ELA72-2022', NULL, 'Ayanna', NULL, 'Edan', 'X1458451', 'tellus.justo@aol.org', '0108547036', 'Homme', '3229 Mauris. Avenue', '2003-12-05', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10072'),
('ELA74-2022', NULL, 'Venus', NULL, 'Lester', 'R5782131', 'aliquam@icloud.com', '0432873626', 'Femme', 'Ap #492-6644 At St.', '2003-07-16', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10074'),
('ELA75-2022', NULL, 'Mark', NULL, 'Adrian', 'C7661436', 'mi.eleifend.egestas@yahoo.org', '0914825678', 'Femme', 'P.O. Box 357, 4731 At St.', '2004-01-17', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10075'),
('ELA76-2022', NULL, 'Cathleen', NULL, 'Dalton', 'Y4765767', 'in@aol.net', '0912665611', 'Femme', '462-817 Id, Ave', '2001-11-15', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10076'),
('ELA77-2022', NULL, 'Carlos', NULL, 'Sylvester', 'C3738818', 'cum.sociis@aol.com', '0613148816', 'Homme', 'Ap #673-1228 Nulla. Av.', '2002-10-27', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10077'),
('ELA78-2022', NULL, 'Audrey', NULL, 'Kasimir', 'G5807160', 'elementum.at@google.edu', '0381555555', 'Homme', 'P.O. Box 553, 5437 Magna. Road', '2003-08-06', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10078'),
('ELA79-2022', NULL, 'Jameson', NULL, 'Fuller', 'M1408434', 'eget.volutpat@aol.org', '0231306615', 'Femme', 'Ap #545-8592 Auctor St.', '2001-04-04', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10079'),
('ELA8-2022', NULL, 'Herrod', NULL, 'Tatiana', 'B7557840', 'auctor@icloud.org', '0612428226', 'Homme', '8341 Convallis Ave', '2005-02-12', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10008'),
('ELA80-2022', NULL, 'Ezra', NULL, 'Isabella', 'X5751601', 'pede@hotmail.net', '0441777124', 'Femme', '278-3997 Ornare. Av.', '2004-10-07', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10080'),
('ELA81-2022', NULL, 'Catherine', NULL, 'Hammett', 'T2846462', 'lorem.ut@yahoo.net', '0385173561', 'Homme', '419-5551 Orci Avenue', '2004-02-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10081'),
('ELA82-2022', NULL, 'Gary', NULL, 'Genevieve', 'H1038425', 'et.magnis.dis@aol.couk', '0753546455', 'Homme', 'Ap #352-1424 Blandit. Road', '2003-06-18', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10082'),
('ELA83-2022', NULL, 'Anthony', NULL, 'Lacota', 'W4516970', 'sapien.cras.dolor@aol.com', '0244631944', 'Femme', '402-128 Nulla St.', '2001-03-24', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10083'),
('ELA84-2022', NULL, 'Hollee', NULL, 'Azalia', 'N5737795', 'senectus.et@yahoo.ca', '0562447985', 'Homme', '746-3439 Id Avenue', '2003-03-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10084'),
('ELA85-2022', NULL, 'Timothy', NULL, 'Wyoming', 'X5459172', 'urna.suscipit@hotmail.edu', '0265896462', 'Femme', 'P.O. Box 937, 3314 Magna Av.', '2003-09-22', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10085'),
('ELA86-2022', NULL, 'Clark', NULL, 'Kitra', 'I4824175', 'senectus@google.net', '0951956645', 'Femme', '201-6769 Felis. Ave', '2002-01-03', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10086'),
('ELA87-2022', NULL, 'Cherokee', NULL, 'Jarrod', 'D9672166', 'nulla.donec.non@outlook.org', '0361623898', 'Femme', 'Ap #535-1760 Dolor. Street', '2001-12-21', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10087'),
('ELA88-2022', NULL, 'Laurel', NULL, 'Jonas', 'B7166386', 'egestas.rhoncus@icloud.org', '0304109554', 'Femme', '807-3698 Massa. St.', '2004-09-14', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10088'),
('ELA89-2022', NULL, 'Alan', NULL, 'Janna', 'J5575024', 'lorem.fringilla@outlook.org', '0418491323', 'Homme', 'Ap #382-8193 At, Ave', '2001-09-03', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10089'),
('ELA9-2022', NULL, 'Dexter', NULL, 'Mari', 'J7256612', 'enim.sed@hotmail.net', '0384396082', 'Homme', '8524 Ad Road', '2003-05-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10009'),
('ELA90-2022', NULL, 'Rudyard', NULL, 'Meghan', 'U2420083', 'in.lorem@outlook.edu', '0644172359', 'Homme', 'P.O. Box 558, 9558 Non, Ave', '2004-03-21', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10090'),
('ELA91-2022', NULL, 'Renee', NULL, 'Illana', 'K7097109', 'interdum.libero@protonmail.couk', '0220344160', 'Homme', '545-5415 Etiam St.', '2004-07-08', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10091'),
('ELA92-2022', NULL, 'Steven', NULL, 'Elvis', 'B1268667', 'sem.nulla@hotmail.couk', '0155338218', 'Femme', '930-2292 Metus. Av.', '2001-11-29', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10092'),
('ELA93-2022', NULL, 'Serena', NULL, 'Hoyt', 'P6858548', 'consectetuer.cursus@icloud.org', '0576628124', 'Femme', '475-3827 Nonummy St.', '2004-02-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10093'),
('ELA94-2022', NULL, 'Kenneth', NULL, 'Caldwell', 'B7618226', 'parturient.montes@outlook.net', '0170162487', 'Femme', 'P.O. Box 668, 9959 Sed Rd.', '2002-11-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10094'),
('ELA95-2022', NULL, 'Igor', NULL, 'Stephanie', 'Y0410944', 'interdum.libero@icloud.couk', '0557212374', 'Femme', 'Ap #444-3721 Vel Rd.', '2002-07-25', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10095'),
('ELA96-2022', NULL, 'Robert', NULL, 'Ray', 'I6463291', 'consequat.lectus.sit@icloud.couk', '0702652919', 'Femme', 'Ap #136-2263 Eros. St.', '2002-12-31', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10096'),
('ELA97-2022', NULL, 'Lewis', NULL, 'Nina', 'H6864389', 'mauris.sapien.cursus@outlook.edu', '0528407835', 'Homme', 'P.O. Box 250, 8978 Pede St.', '2003-11-19', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10097'),
('ELA98-2022', NULL, 'Willa', NULL, 'Fallon', 'D5823152', 'adipiscing@aol.couk', '0479597436', 'Femme', 'Ap #647-3026 Gravida Road', '2002-12-07', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10098'),
('ELA99-2022', NULL, 'Hermione', NULL, 'Ciaran', 'L7663676', 'nulla.eu.neque@protonmail.edu', '0391618132', 'Homme', '855-657 Egestas St.', '2004-09-20', '2022-08-07 17:07:11', '2022-08-07 16:31:50', NULL, 'U10099');

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `idSubject` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  `short` varchar(5) DEFAULT NULL,
  `idCourseType` int(11) NOT NULL,
  PRIMARY KEY (`idSubject`),
  KEY `idCourseType` (`idCourseType`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subjects`
--

INSERT INTO `subjects` (`idSubject`, `libelle`, `short`, `idCourseType`) VALUES
(1, 'Science de Vie et de Terre', 'SVT', 2),
(2, 'Langue Anglaise', 'ANG', 1),
(3, 'Langue Française', 'FR', 1),
(4, 'Mathématique', 'MATH', 2),
(5, 'Développement Web', 'DW', 12),
(6, 'Graphic Design', 'GD', 12),
(8, 'Histoire et Géographie', 'HG', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idRole` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FOREIGN KEY ROLE` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `idRole`, `created_at`, `updated_at`) VALUES
(1, 'Otman Mzough', 'admin@gmail.com', NULL, '$2y$10$IZfL5usE2ZngMi6yFLEW0eASJuOZQL5hv.dyq3wfd2MC32AgLf.xi', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2022-10-18 13:45:50', '2022-10-18 13:45:50'),
(4, 'secraitaire', 'secretaire@gmail.com', NULL, '$2y$10$wFk9PFrg8kCEfKhujN3Ki.ioPNu22i.aWjKBMpBhV6/UMK6TKKYCS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-18 14:50:54', '2022-10-18 14:50:54'),
(5, 'comptable', 'comptable@gmail.com', NULL, '$2y$10$IOY2XYjO6bY77Cl2733GSe6LDFxCXolRm6bfJ3I/zJzagWsU9J.bW', NULL, NULL, NULL, NULL, NULL, NULL, 3, '2022-10-18 14:52:45', '2022-10-18 14:52:45');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `students` (`matricule`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`idGroup`) REFERENCES `groups` (`idGroup`);

--
-- Contraintes pour la table `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_ibfk_1` FOREIGN KEY (`idGroup`) REFERENCES `groups` (`idGroup`),
  ADD CONSTRAINT `classrooms_ibfk_2` FOREIGN KEY (`matricule`) REFERENCES `students` (`matricule`);

--
-- Contraintes pour la table `expensepayment`
--
ALTER TABLE `expensepayment`
  ADD CONSTRAINT `expensepayment_ibfk_1` FOREIGN KEY (`idStaff`) REFERENCES `staff` (`idStaff`),
  ADD CONSTRAINT `expensepayment_ibfk_2` FOREIGN KEY (`idExpense`) REFERENCES `expenses` (`idExpense`);

--
-- Contraintes pour la table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`idGradeCategory`) REFERENCES `gradescategories` (`idGradeCategory`);

--
-- Contraintes pour la table `gradescategories`
--
ALTER TABLE `gradescategories`
  ADD CONSTRAINT `FOREIGN KEY TYPE 0` FOREIGN KEY (`idCourseType`) REFERENCES `coursetype` (`idCourseType`);

--
-- Contraintes pour la table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`idSubject`) REFERENCES `subjects` (`idSubject`),
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`idGrade`) REFERENCES `grades` (`idGrade`),
  ADD CONSTRAINT `groups_ibfk_3` FOREIGN KEY (`idStaff`) REFERENCES `staff` (`idStaff`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `students` (`matricule`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`idIncome`) REFERENCES `incomes` (`idIncome`);

--
-- Contraintes pour la table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`idStaffType`) REFERENCES `stafftype` (`idStaffType`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`idSubject`) REFERENCES `subjects` (`idSubject`);

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`cnieResponsible`) REFERENCES `responsibles` (`cnieResponsible`);

--
-- Contraintes pour la table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`idCourseType`) REFERENCES `coursetype` (`idCourseType`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FOREIGN KEY ROLE` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
