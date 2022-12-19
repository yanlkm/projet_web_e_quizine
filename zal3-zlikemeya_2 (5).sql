-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 08 déc. 2022 à 17:46
-- Version du serveur : 10.5.12-MariaDB-0+deb11u1
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zal3-zlikemeya_2`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `activationquestion` (IN `ID` INT)   begin 
UPDATE T_question_que set que_activation='A' where que_id=ID;
end$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `activationquiz` (IN `ID` INT)   begin 
UPDATE T_quiz_qui set qui_activation='A' where qui_id=ID;
end$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `actu` (IN `IDMATCH` INT)   begin  
	select mat_intitule into @intmatch from T_match_mat where mat_id=IDMATCH;
	select mat_datefin into @finmatch from T_match_mat where mat_id=IDMATCH;
	select mat_datedebut into @debutmatch from T_match_mat where mat_id=IDMATCH;
	select joueurmatch(idmatch) into @liste ;
    select (GROUP_CONCAT('date debut :',@debutmatch,'date de de fin :',@finmatch,'liste des joueurs',@liste)) into @chaine;
    
	if (@finmatch is not null) then
	INSERT INTO T_actualite_act values (NULL,@intmatch,@chaine,'rien',NOW(),4);
	end if;
    END$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `desactivationquestion` (IN `ID` INT)   begin 
UPDATE T_question_que set que_activation='D' where que_id=ID;
end$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `desactivationquiz` (IN `ID` INT)   begin 
UPDATE T_quiz_qui set qui_activation='D' where qui_id=ID;
end$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `moyenne` (IN `ID` CHAR(8), OUT `moy` DOUBLE)   BEGIN
set @chaine=concat(ID);
SELECT avg(jou_score) into MOY from T_joueur_jou where mat_id=@chaine;

end$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `renvoi1` (OUT `ENCOURS` INT, OUT `AVENIR` INT, OUT `FINI` INT)   BEGIN

select count(mat_id) into ENCOURS from T_match_mat where mat_datefin is null;


select count(mat_id) into AVENIR from T_match_mat where mat_datedebut > NOW() and mat_datefin is null;

select count(mat_id) into FINI from T_match_mat where mat_datefin is not null and mat_datefin < NOW();

end$$

CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `test` ()   begin 
select count(mat_id) from T_match_mat;
END$$

--
-- Fonctions
--
CREATE DEFINER=`zlikemeya`@`%` FUNCTION `joueurmatch` (`idmatch` INT) RETURNS CHAR(100) CHARSET utf8mb4  begin 
	declare retour char(100) default "";
    set retour := ( select GROUP_CONCAT(jou_pseudo) from T_joueur_jou where mat_id=idmatch);
   return retour;
    

   END$$

CREATE DEFINER=`zlikemeya`@`%` FUNCTION `moyscore` (`idmatch` CHAR) RETURNS DOUBLE  begin
 set @nombre:=0;
set @chaine:=concat(idmatch);
 select avg(jou_score) into @nombre from scorematchjoueur where mat_id=@chaine;
 return @nombre; 
 end$$

CREATE DEFINER=`zlikemeya`@`%` FUNCTION `ps` (`ID` INT) RETURNS VARCHAR(11) CHARSET utf8mb4  BEGIN
set @pseudo:=(select com_pseudo from T_compte_com where com_id=ID);
return @pseudo;
end$$

CREATE DEFINER=`zlikemeya`@`%` FUNCTION `scorejoueur` (`idjoueur` INT) RETURNS INT(11)  begin 
set @nombre:=0;
select jou_score into @nombre from T_joueur_jou where jou_id=idjoueur;
return @nombre;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `lancement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `lancement` (
`que_texte` varchar(250)
,`rep_libelle` varchar(150)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `psdquiz`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `psdquiz` (
`com_pseudo` varchar(20)
,`qui_id` int(11)
,`qui_intitule` varchar(45)
,`qui_image` varchar(200)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `rep_co`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `rep_co` (
`que_id` int(11)
,`rep_id` int(11)
,`rep_libelle` varchar(150)
,`rep_valide` int(1)
,`que_texte` varchar(250)
,`que_ordre` int(11)
,`qui_id` int(11)
,`que_activation` varchar(1)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `scorematchjoueur`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `scorematchjoueur` (
`jou_id` int(11)
,`jou_score` int(11)
,`mat_id` char(8)
);

-- --------------------------------------------------------

--
-- Structure de la table `T_actualite_act`
--

CREATE TABLE `T_actualite_act` (
  `act_id` int(11) NOT NULL,
  `act_intitule` varchar(45) NOT NULL,
  `act_texte` varchar(500) DEFAULT NULL,
  `act_extension` varchar(45) DEFAULT NULL,
  `act_date` datetime NOT NULL,
  `com_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_actualite_act`
--

INSERT INTO `T_actualite_act` (`act_id`, `act_intitule`, `act_texte`, `act_extension`, `act_date`, `com_id`) VALUES
(1, 'Bienvenue sur YANQUIZ', 'Un tout nouveau quiz 100% en ligne 100% Rap', NULL, '2022-10-04 22:57:02', 4),
(2, 'Nouveauté pour les visiteurs', 'Chaque visteur aura accès à notre page d\'accueil', NULL, '2022-10-04 22:59:02', 4),
(3, 'Ninho', 'Encore une certification : 3x disque de platine pour le JEFE', NULL, '2022-10-04 22:59:01', 1),
(4, 'Le hit de l\'hiver', 'Ziak ft. Kerchak? Un banger ! top 1 Apple Music', NULL, '2022-10-04 22:59:02', 7),
(5, 'Quizz Drill', 'La drill, oui vous avez bien lu, bientôt dans nos quizz', NULL, '2022-10-04 22:59:02', 7),
(6, 'Ninho (encore le Jefe)', 'Une préparation avec Franglish bientôt dis^po?', NULL, '2022-10-04 22:59:02', 5),
(57, ' Modification du quiz : 5', ' Suppression d’une question \n\n                    la liste des matchs est : Session 2 le nombre de question qui restent : 5\n                     le compte associé au match est : soso58', NULL, '2022-12-01 20:04:41', 4);

-- --------------------------------------------------------

--
-- Structure de la table `T_compte_com`
--

CREATE TABLE `T_compte_com` (
  `com_id` int(11) NOT NULL,
  `com_pseudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `com_mdp` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_compte_com`
--

INSERT INTO `T_compte_com` (`com_id`, `com_pseudo`, `com_mdp`) VALUES
(1, 'Fred44', '39b058483b5f4fc2f2e1864e6d485b27ce03656d2e4378cafc7fdda0163b2c93'),
(2, 'format1', '0193183de9be75947e242e10d50a2eb7508a502fa93e60ed17f4fc3e00466353'),
(3, 'Manuel12', '591c73995795da727232785a9168be48adbc9a4d8e49b335ccea05c73820d37f'),
(4, 'responsable', 'd85c2a80f29fd0b287d36e791c6040457a9e6fd57e0889d5e561d1f21f87bf0b'),
(5, 'YanLik', 'a8f6fba6e1168a49330267e78952e35afb211028c6dcdcc782b8c0cecdb3cc49'),
(6, 'eric17', 'a75eaadae746c7b438fe6df2f69576fe737cee6babe3bc5aa587d481d4644125'),
(7, 'soso58', 'a1c63482367045a749eb8f80c701ef54207dac4daaa4fa6c9fe8da90bab8f984'),
(8, 'trafalgareric', '5d4fd8535a87d40be187d97440d74a09f4e216256d1604e51f5f7200e5542e8a');

-- --------------------------------------------------------

--
-- Structure de la table `T_joueur_jou`
--

CREATE TABLE `T_joueur_jou` (
  `jou_id` int(11) NOT NULL,
  `jou_pseudo` varchar(15) NOT NULL,
  `jou_score` int(11) DEFAULT NULL,
  `mat_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_joueur_jou`
--

INSERT INTO `T_joueur_jou` (`jou_id`, `jou_pseudo`, `jou_score`, `mat_id`) VALUES
(124, 'babouche', 0, 'PLMO009K'),
(125, 'Patrick', 25, 'PLMO009K'),
(127, 'chahcha', 0, 'PLMO009K'),
(128, 'chacha', 0, 'PLMO009K'),
(129, 'eff', 0, 'PLMO009K'),
(130, 'test', 20, 'PLMO009K'),
(131, 'tesst', 0, 'PLMO009K'),
(141, 'fifi12', 100, 'FW4Q27Z3'),
(142, 'fifi300', 16, 'FW4Q27Z3'),
(143, 'johan', 100, 'G8743VX1'),
(144, 'johan', 100, '14LXAVJI');

-- --------------------------------------------------------

--
-- Structure de la table `T_match_mat`
--

CREATE TABLE `T_match_mat` (
  `mat_id` char(8) NOT NULL,
  `mat_activation` varchar(1) NOT NULL,
  `mat_intitule` varchar(45) NOT NULL,
  `mat_datedebut` datetime NOT NULL,
  `mat_datefin` datetime DEFAULT NULL,
  `qui_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_match_mat`
--

INSERT INTO `T_match_mat` (`mat_id`, `mat_activation`, `mat_intitule`, `mat_datedebut`, `mat_datefin`, `qui_id`, `com_id`) VALUES
('14LXAVJI', 'A', 'Deuxieme session', '2022-12-08 14:16:52', NULL, 3, 1),
('2ODFVGB2', 'D', 'Match rap1', '2022-12-06 21:25:51', NULL, 3, 3),
('FW4Q27Z3', 'A', 'test vm', '2022-12-07 14:19:32', '2022-12-07 14:31:41', 1, 1),
('G8743VX1', 'A', 'Match 21 savage', '2022-12-07 13:30:00', NULL, 1, 1),
('GGYHO556', 'D', 'Session 3', '2022-12-05 02:17:55', NULL, 3, 3),
('GJK78U67', 'A', 'Session 0', '2022-12-07 13:43:41', NULL, 4, 6),
('HVG45DDE', 'A', 'Session 4', '2022-12-11 16:24:09', '2022-12-06 13:27:05', 1, 7),
('PLMO009K', 'A', 'Session 6', '2022-11-20 16:30:15', NULL, 2, 2),
('TFTGD543', 'A', 'Session 2', '2022-12-07 06:16:00', NULL, 5, 7),
('YUVK3OL1', 'A', 'Match de Fred', '2022-12-07 11:47:14', NULL, 1, 1);

--
-- Déclencheurs `T_match_mat`
--
DELIMITER $$
CREATE TRIGGER `remz` AFTER UPDATE ON `T_match_mat` FOR EACH ROW begin
if(new.mat_datedebut > CURRENT_DATE() and new.mat_datefin is NULL) 
then 
DELETE from T_joueur_jou where mat_id=old.mat_id; 
end if; 

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_profil_pro`
--

CREATE TABLE `T_profil_pro` (
  `pro_nom` varchar(60) NOT NULL,
  `pro_prenom` varchar(55) NOT NULL,
  `pro_datecreation` date NOT NULL,
  `pro_validite` char(1) NOT NULL,
  `pro_role` char(1) NOT NULL,
  `com_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_profil_pro`
--

INSERT INTO `T_profil_pro` (`pro_nom`, `pro_prenom`, `pro_datecreation`, `pro_validite`, `pro_role`, `com_id`) VALUES
('Leblé', 'Fred François', '2022-01-08', 'V', 'F', 1),
('Diouf', 'Corinthes', '2022-01-27', 'V', 'F', 2),
('Yoan', 'Valode', '2021-11-15', 'V', 'F', 3),
('Yanito', 'Marcel', '2017-01-01', 'V', 'A', 4),
('Likeme', 'Yan', '2017-01-05', 'V', 'A', 5),
('LePil', 'Eméric', '2018-11-01', 'V', 'F', 6),
('Loucas', 'Dorianty', '2018-01-02', 'V', 'F', 7),
('Liboma', 'Armans', '2018-01-01', 'V', 'F', 8);

-- --------------------------------------------------------

--
-- Structure de la table `T_question_que`
--

CREATE TABLE `T_question_que` (
  `que_id` int(11) NOT NULL,
  `que_texte` varchar(250) DEFAULT NULL,
  `que_ordre` int(11) DEFAULT NULL,
  `qui_id` int(11) NOT NULL,
  `que_activation` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_question_que`
--

INSERT INTO `T_question_que` (`que_id`, `que_texte`, `que_ordre`, `qui_id`, `que_activation`) VALUES
(1, 'Quel rappeur détient le plus de single de diamant depuis le début de l\'année?', 1, 1, 'A'),
(2, 'Quel rappeur détient le plus de single de d\'or depuis le début de l\'année?', 2, 1, 'A'),
(3, 'Quelle certification Koba LaD obtient-il avec l\'Affranchi cette année?', 3, 1, 'A'),
(4, 'Quel disque Tiakola obtient-il au bout de 3 mois après la sortie de Mélo?', 4, 1, 'A'),
(5, 'Combien de single de diamant Damso détient-il?', 5, 1, 'A'),
(6, 'Quel est le premier single de diamant de Freeze Corleone?', 6, 1, 'A'),
(7, 'Cest plus la même qu\'avant, j\'suis dans l\'plavon gâté ...', 1, 2, 'A'),
(8, 'Ter-ter comme TN,jai rajouté W après BM, Et ...', 2, 2, 'A'),
(9, 'J\'détaille ma vie d\'laud-sa j\'arrive plus à les cotoyer, ...', 3, 2, 'A'),
(10, 'J\'viendrais tier sur tes copains, d\'puis l\'CE1 j\'suis matrixé,...', 4, 2, 'D'),
(11, 'Ma chérie veut Yves Saint Lau-lau, ...', 5, 2, 'A'),
(12, 'Trappin\' like the narco, Got ...', 1, 3, 'A'),
(13, 'Dance with ly dogs in the night time, Trap n**** ...', 2, 3, 'A'),
(14, 'And my charm like a crystal ball, when I pull up make a wish ...', 3, 3, 'A'),
(15, 'Poppa was a rolling stone, but now I got rolling in the bezel ...', 4, 3, 'A'),
(16, 'Yeah, (Soo), we gone (Huh),stop we good (Stop) ...', 5, 3, 'A'),
(17, 'Real-deal stepper, put my toe on that boy ...', 1, 4, 'A'),
(18, 'I grew up in the streets without no heart, I praying to my glock ...', 2, 4, 'A'),
(19, 'Wrist on Milly Rock, them diamonds on me dancin\'', 3, 4, 'A'),
(20, 'Choppa get to preachin\',I\'m the reverend (21)...', 4, 4, 'A'),
(21, 'Way back when D-Lo had the spot in Trestletree...', 5, 4, 'A'),
(22, 'A combien est estimée la fortune de Ninho?', 1, 5, 'A'),
(23, 'A combien estime-t-on le nombre de rappeurs impliqués dans des gangs aux USA?', 2, 5, 'A'),
(24, 'Combien de millions de dollars a généré l\'album de Drake DLDT ?', 3, 5, 'A'),
(25, 'Combien d\'ecoutes pour cummuler un single d\'or?', 4, 5, 'A'),
(26, 'Quelle est la fortune de Kayne West le plus riche selon Forbes?', 5, 5, 'D');

--
-- Déclencheurs `T_question_que`
--
DELIMITER $$
CREATE TRIGGER `desactiver_quiz` AFTER DELETE ON `T_question_que` FOR EACH ROW begin
call desactivationquiz(old.qui_id);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `supques` AFTER DELETE ON `T_question_que` FOR EACH ROW begin 
delete from T_actualite_act where act_intitule like "%Modification du quiz%";
set @nb:=0;
select count(que_id) into @nb from T_question_que where qui_id=old.qui_id;
if (@nb > 1 ) then
set @var1:= " Suppression d’une question \r\n"; 
end if;
if (@nb=1) then 
set @var1:= " ATTENTION, plus qu'une question\r\n"; 
end if; 
if (@nb = 0 )
then 
set @var1:= " Quiz vide \r\n"; 
end if; 
set @match:="";
select group_concat(distinct mat_intitule) into @match from T_question_que join T_quiz_qui using (qui_id) join T_match_mat using (qui_id) where qui_id=old.qui_id;
if (@match is null) then 
set @match1:=concat("  Aucun match associé à ce quiz pour l’instant ! \r\n                    ",' le nombre de question qui restent : ',@nb);
end if; 
if (@match is not null) then 
set @match1:=concat("\r\n                    la liste des matchs associés est : ",@match, ' le nombre de question qui restent : ',@nb,'\n');
end if;
select group_concat( distinct com_pseudo) into @form from T_question_que join T_quiz_qui  using(qui_id) join T_compte_com using(com_id) where qui_id=old.qui_id;
if( @form is not null ) then 
set @form1 := concat( "\r\n                     le compte associé au match est : ",@form) ;
else   
set  @form1:="\r\naucun compte reconnu associé au match associé";
end if;
set @toutechaine := concat(@var1,@match1,@form1); 
set @presquechaine:= concat(" Modification du quiz : ",old.qui_id);
Insert into T_actualite_act values (NULL,@presquechaine,@toutechaine,NULL,NOW(),4);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_quiz_qui`
--

CREATE TABLE `T_quiz_qui` (
  `qui_id` int(11) NOT NULL,
  `qui_intitule` varchar(45) NOT NULL,
  `qui_image` varchar(200) NOT NULL,
  `com_id` int(11) NOT NULL,
  `qui_activation` char(1) NOT NULL,
  `qui_rep` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_quiz_qui`
--

INSERT INTO `T_quiz_qui` (`qui_id`, `qui_intitule`, `qui_image`, `com_id`, `qui_activation`, `qui_rep`) VALUES
(1, 'Les Certifications du rap FR', '4.jpg', 1, 'A', 'A'),
(2, 'Blind test : Ninho', '3.jpg', 2, 'A', 'A'),
(3, 'Blind test : Migos', '2.jpg', 3, 'A', 'A'),
(4, 'Blind test : 21 Savage', '1.jpg', 6, 'A', 'A'),
(5, 'Les impacts du rap', '5.jpg', 7, 'A', 'D');

-- --------------------------------------------------------

--
-- Structure de la table `T_reponse_rep`
--

CREATE TABLE `T_reponse_rep` (
  `rep_id` int(11) NOT NULL,
  `rep_libelle` varchar(150) NOT NULL,
  `rep_valide` int(1) NOT NULL,
  `que_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_reponse_rep`
--

INSERT INTO `T_reponse_rep` (`rep_id`, `rep_libelle`, `rep_valide`, `que_id`) VALUES
(51, 'Tiakola ', 0, 1),
(52, 'Ninho ', 1, 1),
(53, 'Guy2bezbar ', 0, 2),
(54, 'Gazo ', 1, 2),
(55, 'Double disque de platine ', 1, 3),
(56, 'Double disque de diamant ', 0, 3),
(57, 'Disque de diamant ', 0, 4),
(58, 'Disque de platine ', 1, 4),
(59, '10', 0, 5),
(60, '19', 1, 5),
(61, 'INTERLUDE', 0, 6),
(62, 'Freeze Srael', 1, 6),
(63, 'Jogging alligator, on fait partie des grands', 1, 7),
(64, 'l\'équipe en face est menacée, normal c\'est les boss du rain-té', 0, 7),
(65, 'Jsuis dans le RS, à ma gauche y a tahed', 1, 8),
(66, 'paire Nike ou addidas, peu importe tant que t\'as ta faciale', 0, 8),
(67, 'Air max un pillon, et si il y a doute il faut tailler', 1, 9),
(68, 'air max ou air min, au fond y aura du biff', 0, 9),
(69, 'ils font les gros poissons, en vrai ils savent pas nager', 1, 10),
(70, 'c\'est mechant depuis le début on l\'disait', 0, 10),
(71, 'J\'te donne mon coeur fait pas bobo', 1, 11),
(72, 'j\'ai pas encore les talles, on y va molo', 0, 11),
(73, 'Got dope like Pablo', 1, 12),
(74, 'Cut throat like Pablo', 0, 12),
(75, 'Trap n**** with the chickens like Popeye\'s', 1, 13),
(76, 'Dance the situations, pain ain\'t main', 0, 13),
(77, 'makin\' a,makin\' a profit, big boy big boy, yeah,narcotics', 1, 14),
(78, 'sweatin sweatin da conflits', 0, 14),
(79, 'Momma at home all alone, hustling trying to keep together', 1, 15),
(80, 'and nothing to do but gang was here', 0, 15),
(81, 'Chill, we on, scale, let\'s go', 1, 16),
(82, 'break, the wall, yeah', 0, 16),
(83, 'turn around, slide and people die', 0, 17),
(84, 'You mickey Mouse  b****, you went and told on that boy', 1, 17),
(85, 'qhoot on guys playin\' with folks', 0, 18),
(86, 'wrist on milly rock, them diamonds on me dancin\'', 1, 18),
(87, 'boy of the sreets ain\'t never lie (21)', 0, 19),
(88, 'call him new era he cappin\' (21)', 1, 19),
(89, 'too short on slide i had to verify', 0, 20),
(90, 'so many hoes I had to get vasectomy ?', 1, 20),
(91, '40 millions d\'euros', 0, 22),
(92, '4 millions d\'euros', 1, 22),
(93, 'pas plus de 30%', 0, 23),
(94, 'jusqu\'à 90%', 1, 23),
(95, 'moins de 1 million', 0, 24),
(96, 'Près de 30 million', 1, 24),
(97, '15 000 écoutes', 0, 25),
(98, '15 millions d\'écoutes', 1, 25),
(99, '28 miilions de dollars', 0, 26),
(100, '4 milliards de dollars', 1, 26);

-- --------------------------------------------------------

--
-- Structure de la vue `lancement`
--
DROP TABLE IF EXISTS `lancement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zlikemeya`@`%` SQL SECURITY DEFINER VIEW `lancement`  AS SELECT `T_question_que`.`que_texte` AS `que_texte`, `T_reponse_rep`.`rep_libelle` AS `rep_libelle` FROM (`T_question_que` left join `T_reponse_rep` on(`T_question_que`.`que_id` = `T_reponse_rep`.`que_id`)) ORDER BY `T_question_que`.`que_texte` ASC  ;

-- --------------------------------------------------------

--
-- Structure de la vue `psdquiz`
--
DROP TABLE IF EXISTS `psdquiz`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zlikemeya`@`%` SQL SECURITY DEFINER VIEW `psdquiz`  AS SELECT `T_compte_com`.`com_pseudo` AS `com_pseudo`, `T_quiz_qui`.`qui_id` AS `qui_id`, `T_quiz_qui`.`qui_intitule` AS `qui_intitule`, `T_quiz_qui`.`qui_image` AS `qui_image` FROM (`T_compte_com` left join `T_quiz_qui` on(`T_compte_com`.`com_id` = `T_quiz_qui`.`com_id`))  ;

-- --------------------------------------------------------

--
-- Structure de la vue `rep_co`
--
DROP TABLE IF EXISTS `rep_co`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zlikemeya`@`%` SQL SECURITY DEFINER VIEW `rep_co`  AS SELECT `T_reponse_rep`.`que_id` AS `que_id`, `T_reponse_rep`.`rep_id` AS `rep_id`, `T_reponse_rep`.`rep_libelle` AS `rep_libelle`, `T_reponse_rep`.`rep_valide` AS `rep_valide`, `T_question_que`.`que_texte` AS `que_texte`, `T_question_que`.`que_ordre` AS `que_ordre`, `T_question_que`.`qui_id` AS `qui_id`, `T_question_que`.`que_activation` AS `que_activation` FROM (`T_reponse_rep` join `T_question_que` on(`T_reponse_rep`.`que_id` = `T_question_que`.`que_id`)) WHERE `T_reponse_rep`.`rep_valide` = 11  ;

-- --------------------------------------------------------

--
-- Structure de la vue `scorematchjoueur`
--
DROP TABLE IF EXISTS `scorematchjoueur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zlikemeya`@`%` SQL SECURITY DEFINER VIEW `scorematchjoueur`  AS SELECT `T_joueur_jou`.`jou_id` AS `jou_id`, `T_joueur_jou`.`jou_score` AS `jou_score`, `T_joueur_jou`.`mat_id` AS `mat_id` FROM `T_joueur_jou` WHERE `T_joueur_jou`.`jou_score` is not nullnot null  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `T_actualite_act`
--
ALTER TABLE `T_actualite_act`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `fk_T_act_actualite_T_com_compte1_idx` (`com_id`);

--
-- Index pour la table `T_compte_com`
--
ALTER TABLE `T_compte_com`
  ADD PRIMARY KEY (`com_id`),
  ADD UNIQUE KEY `com_id` (`com_id`);

--
-- Index pour la table `T_joueur_jou`
--
ALTER TABLE `T_joueur_jou`
  ADD PRIMARY KEY (`jou_id`),
  ADD KEY `fk_T_jou_joueur_T_mat_match1_idx` (`mat_id`);

--
-- Index pour la table `T_match_mat`
--
ALTER TABLE `T_match_mat`
  ADD PRIMARY KEY (`mat_id`),
  ADD KEY `fk_T_mat_match_T_qui_quiz1_idx` (`qui_id`),
  ADD KEY `fk_T_mat_match_T_com_compte1_idx` (`com_id`);

--
-- Index pour la table `T_profil_pro`
--
ALTER TABLE `T_profil_pro`
  ADD PRIMARY KEY (`com_id`),
  ADD UNIQUE KEY `com_id` (`com_id`),
  ADD KEY `fk_T_pro_profil_T_com_compte1_idx` (`com_id`);

--
-- Index pour la table `T_question_que`
--
ALTER TABLE `T_question_que`
  ADD PRIMARY KEY (`que_id`),
  ADD KEY `fk_T_que_question_T_qui_quiz1_idx` (`qui_id`);

--
-- Index pour la table `T_quiz_qui`
--
ALTER TABLE `T_quiz_qui`
  ADD PRIMARY KEY (`qui_id`),
  ADD KEY `fk_T_qui_quiz_T_com_compte1_idx` (`com_id`);

--
-- Index pour la table `T_reponse_rep`
--
ALTER TABLE `T_reponse_rep`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `fk_T_rep_reponse_T_que_question1_idx` (`que_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `T_actualite_act`
--
ALTER TABLE `T_actualite_act`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `T_compte_com`
--
ALTER TABLE `T_compte_com`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `T_joueur_jou`
--
ALTER TABLE `T_joueur_jou`
  MODIFY `jou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `T_question_que`
--
ALTER TABLE `T_question_que`
  MODIFY `que_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `T_quiz_qui`
--
ALTER TABLE `T_quiz_qui`
  MODIFY `qui_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `T_reponse_rep`
--
ALTER TABLE `T_reponse_rep`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `T_actualite_act`
--
ALTER TABLE `T_actualite_act`
  ADD CONSTRAINT `fk_T_act_actualite_T_com_compte1` FOREIGN KEY (`com_id`) REFERENCES `T_compte_com` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_joueur_jou`
--
ALTER TABLE `T_joueur_jou`
  ADD CONSTRAINT `fk_T_jou_joueur_T_mat_match1` FOREIGN KEY (`mat_id`) REFERENCES `T_match_mat` (`mat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_match_mat`
--
ALTER TABLE `T_match_mat`
  ADD CONSTRAINT `fk_T_mat_match_T_com_compte1` FOREIGN KEY (`com_id`) REFERENCES `T_compte_com` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_T_mat_match_T_qui_quiz1` FOREIGN KEY (`qui_id`) REFERENCES `T_quiz_qui` (`qui_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_profil_pro`
--
ALTER TABLE `T_profil_pro`
  ADD CONSTRAINT `fk_T_pro_profil_T_com_compte1` FOREIGN KEY (`com_id`) REFERENCES `T_compte_com` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_question_que`
--
ALTER TABLE `T_question_que`
  ADD CONSTRAINT `fk_T_que_question_T_qui_quiz1` FOREIGN KEY (`qui_id`) REFERENCES `T_quiz_qui` (`qui_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_quiz_qui`
--
ALTER TABLE `T_quiz_qui`
  ADD CONSTRAINT `fk_T_qui_quiz_T_com_compte1` FOREIGN KEY (`com_id`) REFERENCES `T_compte_com` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_reponse_rep`
--
ALTER TABLE `T_reponse_rep`
  ADD CONSTRAINT `fk_T_rep_reponse_T_que_question1` FOREIGN KEY (`que_id`) REFERENCES `T_question_que` (`que_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
