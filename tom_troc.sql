-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 22 oct. 2024 à 12:30
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tom_troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`book_id`, `picture`, `title`, `author`, `description`, `availability`, `user_id`) VALUES
(1, 'images/bookPicture/7cda4fb0ef79187d0cbe84b3fd36b23a6cf2b91f_bookPicture_1_20241022_094738.webp', 'Livre d&#39;art Fang', 'Louis Perrois , Marta Sierra Delage', 'Beau Livre rare L\'art Fang Guinée Équatoriale\r\n\r\nAuteurs : Louis Perrois , Marta Sierra Delage\r\n\r\nÉditeur : Aurore éditions d\'art\r\n\r\nEnviron 180 pages\r\n\r\nTrès bon état\r\nUn beau cadeau à offrir ou à s\'offrir !\r\n\r\nMerci de m\'avoir lu,prenez soin de vous !', 0, 1),
(2, 'images/bookPicture/7b413d802ea827fd3827a3ba98d1134c5995c105_bookPicture_2_20241010_151333.jpg', ' L\'espionnage', 'Alain Bauer', 'livres s\'appellent l\'espionnage. ça parle surtout des histoires de l\'espionnage commence à évaluer et comment devenir espion quels sont les étapes à faire, quels sont les choses à maîtriser, est-ce que l\'espionnage existe toujours est-ce que l\'espionnage va exister et q à quoi sert ce travail\r\n\r\nplutôt ça parle comment devenir espion\r\n\r\nlivre tout neuf, jamais utilisé', 1, 2),
(3, 'images/bookPicture/Livre_format_02_bookPicture_3_20241012_213214.jpg', 'Quatre nuits d\'effroi', 'Patrick Schneckenburger', 'Il dort seul au rez-de-chaussée. Les autres occupants logent à l\'étage. Il entend des bruits étranges provenant de la cuisine. Il hésite, n\'ose appeler. Il veut en avoir le coeur net. Dans le couloir, la porte de la cave est entrebâillée. Il est d\'autant plus inquiet que cet accès se trouve habituellement verrouillé. Puis c\'est l\'effroi. Devant lui, l\'innommable, l\'abject. Ils l\'attendaient. C\'est ainsi que durant quatre nuits, un garçonnet de sept ans en pension dans une famille qui le chérit assistera à des scènes effrayantes. Pourtant, il ne fuira pas, il restera à les observer, finira par s\'approcher, comme fasciné par elles.Un roman fantastique où se côtoient l\'intime et l\'occulte ; où le destin d\'innocents est la proie d\'un passé meurtri à la recherche de réponses.', 1, 3),
(4, 'images/bookPicture/4455707fd4345428bc5f28b6b7916ba61bb2d51e_bookPicture_6_20241015_092214.jpg', 'Kiara - : Kiara, diamant écorché par le sang - Tome 1', 'Hazel Diaz', '\"Chaque jour, je dois récupérer des armes, de la drogue, commettre des assassinats pour le compte de mon père, Ahmed, et de son gang. Mon géniteur est mon pire bourreau. Il m\'a élevée dans l\'optique d\'être une tueuse. Son but : faire de moi son petit soldat. Malgré ce qu\'il m\'a fait endurer, je lui reste dévouée. Même lorsqu\'il m\'envoie dans une prison où est détenu l\'un des plus grands criminels du pays, afin de découvrir ce qu\'il dissimule... \"\r\n\r\nKiara doit connaître les intentions d\'Amir Ben Khalif, un caïd qui inspire respect et crainte à tous les gangs. Mais, lorsqu\'Amir croise la jeune femme, c\'est l\'explosion : deux machines de guerre psychotiques qui se détestent autant qu\'elles s\'attirent.\r\n\r\nAmir est lancé dans une quête qui mettrait à mal toutes les organisations criminelles internationales. Kiara est malgré elle impliquée dans cette quête périlleuse. Leur avenir commun est à présent scellé même s\'ils ne le savent pas...\"', 1, 6),
(5, 'images/bookPicture/ea2849768383c279d2b9301609c7281c4d528754_bookPicture_6_20241015_103943.jpg', 'La Couleur des sentiments', 'Kathryn Stockett', 'Chez les Blancs de Jackson, Mississippi, ce sont les Noires qui font le ménage, la cuisine, et qui s\'occupent des enfants. On est en 1962, les lois raciales font autorité. En quarante ans de service, Aibileen a appris à tenir sa langue. L\'insolente Minny, sa meilleure amie, vient tout juste de se faire renvoyer. Si les choses s\'enveniment, elle devra chercher du travail dans une autre ville. Peut-être même s\'exiler dans un autre Etat, comme Constantine, qu\'on n\'a plus revue ici depuis que, pour des raisons inavouables, les Phelan l\'ont congédiée.\r\n\r\nMais Skeeter, la fille des Phelan, n\'est pas comme les autres. De retour à Jackson au terme de ses études, elle s\'acharne à découvrir pourquoi Constantine, qui l\'a élevée avec amour pendant vingt-deux ans, est partie sans même lui laisser un mot.\r\n\r\nLa jeune bourgeoise blanche et les deux bonnes noires, poussées par une sourde envie de changer les choses malgré la peur, vont unir leurs destins, et en grand secret écrire une histoire bouleversante.\r\n', 1, 6),
(11, 'images/bookPicture/5f7e96088994ce29c438db141c2635dcee5e2839_bookPicture_6_20241015_115620.jpg', 'CINÉMA', 'La Grande Imagerie', 'Livre de la collection La Grande Imagerie sur le thème du CINÉMA', 1, 6),
(16, 'images/bookPicture/40a8c007fe87753dd4b7d3bbb2d387267d997b93_bookPicture_5_20241015_162915.webp', 'Arsène Lupin \"L&#39aiguille creuse\"', 'Maurice LeBlanc', 'Arsène Lupin est arrêté : l\'aventure est-elle donc finie pour lui ? Erreur ! Elle ne fait que commencer. C\'est quand il est sous les verrous que la police devrait se méfier. Lupin change de domicile, de costume, de tête, d\'écriture, connait tous les passages secrets et prend rendez-vous avec ses victimes avant de les cambrioler ! C\'est le plus gentleman des cambrioleurs.', 1, 5),
(21, 'images/bookPicture/b1485ff8326fbf4f84531b312ea2aa2c50074682_bookPicture_11_20241021_144718.jpg', 'La Vie secrète des écrivains', 'Guillaume Musso', '“Tout le monde a trois vies : une vie privée, une vie publique et une vie secrète…”\r\n\r\nGabriel García Márquez\r\n\r\nEn 1999, après avoir publié trois romans devenus cultes, le célèbre écrivain Nathan Fawles annonce qu’il arrête d’écrire et se retire à Beaumont, une île sauvage et sublime au large des côtes de la Méditerranée.\r\nAutomne 2018. Fawles n’a plus donné une seule interview depuis vingt ans. Alors que ses romans continuent de captiver les lecteurs, Mathilde Monney, une jeune journaliste suisse, débarque sur l’île, bien décidée à percer son secret.\r\n\r\nLe même jour, un corps de femme est découvert sur une plage et l’île est bouclée par les autorités. Commence alors entre Mathilde et Nathan un dangereux face à face, où se heurtent vérités occultées et mensonges assumés, où se frôlent l’amour et la peur…\r\nUne lecture inoubliable, un puzzle littéraire fascinant qui se révèle diabolique lorsque l’auteur y place sa dernière pièce.', 1, 11),
(24, 'images/bookPicture/727d618210a4a3df93d786c254280d802140ab63_bookPicture_12_20241022_095447.jpg', 'Livre « Abitibi Témiscamingue »', 'Mathieu Dupuis', 'Gros livre en très bon état, sur la région canadienne Abitibi Témiscamingue\r\nBeaucoup de photographies et des explications', 0, 12);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `userAtInitiativeOfRequest` int(11) NOT NULL,
  `userWhoReceivesRequest` int(11) NOT NULL,
  `lastMessageSend` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`conversation_id`, `userAtInitiativeOfRequest`, `userWhoReceivesRequest`, `lastMessageSend`) VALUES
(12, 1, 2, '2024-10-22 10:30:49'),
(31, 3, 1, '2024-10-17 17:41:26'),
(111, 11, 1, '2024-10-22 10:30:10'),
(212, 2, 12, '2024-10-22 10:33:08');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sending_datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `view` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message_id`, `conversation_id`, `user_id`, `sending_datetime`, `content`, `view`) VALUES
(29, 12, 1, '2024-10-14 13:49:10', 'bonjour, le livre est-il toujours disponible ?', 1),
(30, 12, 2, '2024-10-14 13:49:45', 'oui, pour quand le voudriez-vous ?', 1),
(31, 12, 1, '2024-10-14 13:50:39', 'Dès que vous le pouvez ', 1),
(32, 31, 3, '2024-10-14 13:51:08', 'Le livre est-il en bonne état ?', 1),
(33, 31, 1, '2024-10-14 13:51:43', 'oui biensur !', 1),
(71, 12, 1, '2024-10-17 20:43:19', 'coucou comment tu vas ?', 1),
(72, 12, 2, '2024-10-17 20:44:17', 'Ca va et toi ?', 1),
(73, 12, 2, '2024-10-18 08:58:16', 'alors ?', 1),
(74, 12, 1, '2024-10-18 09:01:59', 'nickel !', 1),
(88, 111, 11, '2024-10-21 14:24:54', 'Est ce que vos livres sont toujours disponible ?', 1),
(89, 111, 1, '2024-10-21 16:35:30', 'oui bien sur !', 1),
(90, 111, 1, '2024-10-22 10:30:10', 'Alors ?', 0),
(92, 212, 2, '2024-10-22 10:33:08', 'Votre livre est t\'il dispo ?', 0);

-- --------------------------------------------------------

--
-- Structure de la table `siteManagement`
--

CREATE TABLE `siteManagement` (
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `siteManagement`
--

INSERT INTO `siteManagement` (`lastUpdate`) VALUES
('2024-10-22 11:16:01');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `profilePicture` text NOT NULL,
  `registration_date` date NOT NULL,
  `unreadMessage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `pseudo`, `email`, `password`, `profilePicture`, `registration_date`, `unreadMessage`) VALUES
(1, 'ShipLoulou', 'exemple@exemple.com', '$2y$10$eb2pCFn3GaG49D0FCHl0muwK9biABJhxkhox70FGvulbEIBxHhz4q', 'images/profilePicture/medium_profilePicture_20241014_153956.webp', '2023-10-01', 0),
(2, 'Mimi', 'mimi@gmail.com', '$2y$10$eb2pCFn3GaG49D0FCHl0muwK9biABJhxkhox70FGvulbEIBxHhz4q', 'images/profilePicture/images_profilePicture_20241010_150954.jpeg', '2024-09-18', 0),
(3, 'Gege', 'gg.boileve@gmail.com', '$2y$10$CeH05EOBzCKNewrWL8bq9OLIb/T6J4Tp.QS7XIMe4a7eDv0E2nY9a', 'images/profilePicture/vbhg_profilePicture_20241012_213112.jpeg', '2024-10-12', 0),
(4, 'Test44', 'test@gmail.com', '$2y$10$kRyGikYo.r/LsM7JElsYy.cRdrHIvybwY7USdy04QcwUmZtyq.yIW', 'images/static/profilePictureDefault.png', '2024-10-13', 0),
(5, 'Aurelia_23', 'aurelia23@example.com', '$2y$10$WtpPlr1mz4rS/h2GnL0QjeA3vqeg4HSj/UWvu4gc0DhAqJAIAfGHW', 'images/profilePicture/12_profilePicture_20241014_200846.jpg', '2022-10-11', 0),
(6, 'Lucas1984', 'lucas1984@example.com', '$2y$10$5YYss/xwymI.Vas8HqKfouQbEiRljWRyirZ95Xe6.zP95.rInvn9u', 'images/profilePicture/45_profilePicture_20241014_201048.jpg', '2022-11-21', 0),
(7, 'MarieB92', 'marieb92@example.com', '$2y$10$l3MgwPu/q6xAD98vEHL3SutDep3hRdMXSwr4IXNydjtllpmIVtSya', 'images/profilePicture/5_profilePicture_20241014_201153.jpg', '2021-09-14', 0),
(8, 'Tommy_X', 'tommy.x@example.com', '$2y$10$uBbC281ZTPiiDI3s7JQLyuj1X9nRCpEox2VlC2rIiGZ9GIZCw.ktK', 'images/profilePicture/33_profilePicture_20241014_201244.jpg', '2023-03-25', 0),
(9, 'Elodie_Pic', 'elodie.pic@example.com', '$2y$10$D32xdWoJjgFsoiVjLCDl6uxZgEgtOExZuCXtgXDpgRaNDSBl2dbwG', 'images/profilePicture/33 (1)_profilePicture_20241014_201546.jpg', '2023-06-14', 0),
(10, 'Maxime1991', 'maxime1991@example.com', '$2y$10$rt25liMWDSUu2tQPgM3vSu/0HC525bOrpBg8Z1ntURmUSUacJCilu', 'images/profilePicture/14_profilePicture_20241014_201708.jpg', '2024-04-10', 0),
(11, 'm@elLol', 'test@test.com', '$2y$10$QKBsOo5RyHA/uCx1nu2Dv.73ert39urvHEc44pJJetbFupwa.kfQy', 'images/profilePicture/photo-1541516160071-4bb0c5af65ba_profilePicture_20241021_143329.jpeg', '2024-10-21', 0),
(12, 'Lilou_80', 'lilou@gmail.com', '$2y$10$DYe7VbxZCu3fXdhVj5i3/.x1PV5ngCkFC2gIlGC691cCB2ZlhcEVW', 'images/profilePicture/photo-portrait_apprendre-la-photo_laurent-breillat-6_profilePicture_20241022_084012.jpg', '2024-10-21', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`),
  ADD KEY `user_id_1` (`userAtInitiativeOfRequest`),
  ADD KEY `user_id_2` (`userWhoReceivesRequest`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `user_book` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `userInitiative_user` FOREIGN KEY (`userAtInitiativeOfRequest`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userReceives_user` FOREIGN KEY (`userWhoReceivesRequest`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`conversation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
