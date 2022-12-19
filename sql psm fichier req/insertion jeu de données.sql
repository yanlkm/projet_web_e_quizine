INSERT INTO `T_compte_com` (`com_pseudo`, `com_mdp`) VALUES
('Fred44', 'ciel'),
('format1','lise'),
('Manuel12','soleil'),
('responsable', 'resp22_ZUIQ'),
('YanLik','wano'),
('eric17', 'luffy'),
('soso58', 'noracism'),
('trafalgareric','ace');


INSERT INTO `T_profil_pro` (`pro_nom`, `pro_prenom`,`pro_datecreation`, `pro_validite`,`pro_role`, `com_id`) VALUES
('LeBlé', 'Fred François', '2022-01-08', 'V', 'F',1),
('Diouf', 'Corinthes', '2022-01-27', 'V', 'F',2),
('Yoan', 'Valode', '2021-11-15', 'V', 'F', 3),
('Yanito', 'Marcel', '2017-01-01', 'V', 'A', 4),
('Likeme', 'Yan', '2017-01-05', 'V', 'A', 5),
('Le Pil', 'Eméric', '2018-11-01','V', 'F', 6),
('Luc', 'Dorian', '2018-01-02','V', 'F', 7),
('Liboma', 'Armans', '2018-01-01', 'V', 'F',8);

INSERT INTO `T_actualite_act` (`act_id`, `act_intitule`, `act_texte`, `act_extension`, `act_date`, `com_id`) VALUES
('1', 'Bienvenue sur YANQUIZ', 'Un tout nouveau quiz 100% en ligne 100% Rap', NULL, '2022-10-04 22:57:02.000000', '4'),
( '2','Nouveauté pour les visiteurs', 'Chaque visteur aura accès à notre page d\'accueil', NULL, '2022-10-04 22:59:02', '4'),
( '3','Ninho', 'Encore une certification : 3x disque de platine pour le JEFE', NULL, '2022-10-04 22:59:01', '1'),
( '4','Le hit de l\'hiver', 'Ziak ft. Kerchak? Un banger ! top 1 Apple Music', NULL, '2022-10-04 22:59:02', '7'),
( '5','Quizz Drill', 'La drill, oui vous avez bien lu, bientôt dans nos quizz', NULL, '2022-10-04 22:59:02', '7'),
( '6','Ninho (encore le Jefe)', 'Une préparation avec Franglish bientôt dis^po?', NULL, '2022-10-04 22:59:02', '5');

INSERT INTO `T_quiz_qui` ( `qui_intitule`, `qui_image`, `com_id`, `qui_activation`) VALUES
('Les Certifications du rap FR','chemin à venir',1,'A'),
('Blind test : Ninho','chemin à venir',2,'A'),
('Blind test : Migos','chemin à venir',3,'A'),
('Blind test : 21 Savage','chemin à venir',6,'A'),
('Les impacts du rap','chemin à venir',7,'A');

INSERT INTO `T_question_que` ( `que_texte`, `que_ordre`, `qui_id`, `que_activation`) VALUES
('Quel rappeur détient le plus de single de diamant depuis le début de l\'année?',1,1,'A'),
('Quel rappeur détient le plus de single de d\'or depuis le début de l\'année?',2,1,'A'),
('Quelle certification Koba LaD obtient-il avec l\'Affranchi cette année?',3,1,'A'),
('Quel disque Tiakola obtient-il au bout de 3 mois après la sortie de Mélo?',4,1,'A'),
('Combien de single de diamant Damso détient-il?',5,1,'A'),
('Quel est le premier single de diamant de Freeze Corleone?',6,1,'A'),
('C\est plus la même qu\'avant, j\'suis dans l\'plavon gâté ...',1,2,'A'),
('Ter-ter comme TN,j\ai rajouté W après BM, Et ...',2,2,'A'),
('J\'détaille ma vie d\'laud-sa j\'arrive plus à les cotoyer, ...',3,2,'A'),
('J\'viendrais tier sur tes copains, d\'puis l\'CE1 j\'suis matrixé,...',4,2,'A'),
('Ma chérie veut Yves Saint Lau-lau, ...',5,2,'A'),
('Trappin\' like the narco, Got ...',1,3,'A'), 
('Dance with ly dogs in the night time, Trap n**** ...',2,3,'A'),
('And my charm like a crystal ball, when I pull up make a wish ...',3,3,'A'),
('Poppa was a rolling stone, but now I got rolling in the bezel ...',4,3,'A'),
('Yeah, (Soo), we gone (Huh),stop we good (Stop) ...',5,3,'A'),
('Real-deal stepper, put my toe on that boy ...',1,4,'A'),
('I grew up in the streets without no heart, I praying to my glock ...',2,4,'A'),
('Wrist on Milly Rock, them diamonds on me dancin\'',3,4,'A'),
('Choppa get to preachin\',I\'m the reverend (21)...',4,4,'A'),
('Way back when D-Lo had the spot in Trestletree...',5,4,'A'),
('A combien est estimée la fortune de Ninho?',1,5,'A'),
('A combien estime-t-on le nombre de rappeurs impliqués dans des gangs aux USA?',2,5,'A'),
('Combien de millions de dollars a généré l\'album de Drake DLDT ?',3,5,'A'),
('Combien d\'ecoutes pour cummuler un single d\'or?',4,5,'A'),
('Quelle est la fortune de Kayne West le plus riche selon Forbes?',5,5,'A');

INSERT INTO `T_reponse_rep` ( `rep_libelle`, `rep_valide`, `que_id`) VALUES 
('Tiakola ',0,1),
('Ninho ',1,1),
('Guy2bezbar ',0,2),
('Gazo ',1,2),
('Double disque de platine ',1,3),
('Double disque de diamant ',0,3),
('Disque de diamant ',0,4),
('Disque de platine ',1,4),
('10',0,5),
('19',1,5),
('INTERLUDE',0,6),
('Freeze Srael',1,6),
('Jogging alligator, on fait partie des grands',1,7),
('l\'équipe en face est menacée, normal c\'est les boss du rain-té',0,7),
('J\suis dans le RS, à ma gauche y a tahed',1,8),
('paire Nike ou addidas, peu importe tant que t\'as ta faciale',0,8),
('Air max un pillon, et si il y a doute il faut tailler',1,9),
('air max ou air min, au fond y aura du biff',0,9),
('ils font les gros poissons, en vrai ils savent pas nager',1,10),
('c\'est mechant depuis le début on l\'disait',0,10),
('J\'te donne mon coeur fait pas bobo',1,11),
('j\'ai pas encore les talles, on y va molo',0,11),
('Got dope like Pablo',1,12),
('Cut throat like Pablo',0,12),
('Trap n**** with the chickens like Popeye\'s',1,13),
('Dance the situations, pain ain\'t main',0,13),
('makin\' a,makin\' a profit, big boy big boy, yeah,narcotics',1,14),
('sweatin sweatin da conflits',0,14),
('Momma at home all alone, hustling trying to keep together',1,15),
('and nothing to do but gang was here',0,15),
('Chill, we on, scale, let\'s go',1,16),
('break, the wall, yeah',0,16),
('turn around, slide and people die',0,17),
('You mickey Mouse  b****, you went and told on that boy',1,17),
('qhoot on guys playin\' with folks',0,18),
('wrist on milly rock, them diamonds on me dancin\'',1,18),
('boy of the sreets ain\'t never lie (21)',0,19),
('call him new era he cappin\' (21)',1,19),
('too short on slide i had to verify',0,20),
('so many hoes I had to get vasectomy ?',1,20),
('40 millions d\'euros',0,21),
('4 millions d\'euros',1,21),
('pas plus de 30%',0,22),
('jusqu\'à 90%',1,22),
('moins de 1 million',0,23),
('Près de 30 million',1,23),
('15 000 écoutes',0,24),
('15 millions d\'écoutes',1,24),
('28 miilions de dollars',0,25),
('4 milliards de dollars',1,25);

INSERT INTO `T_match_mat` (`mat_id`, `mat_activation`, `mat_intitule`, `mat_datedebut`, `mat_datefin`, `qui_id`, `com_id`) VALUES
 ('	
GJK78U67', 'A', 'Session 1', '2022-10-11 16:20:20.000000', NULL, '4', '6'); 
 INSERT INTO `T_match_mat` (`mat_id`, `mat_activation`, `mat_intitule`, `mat_datedebut`, `mat_datefin`, `qui_id`, `com_id`) VALUES 
 ('GGYHO556', 'A', 'Session 3', '2022-10-11 16:24:09.000000', NULL, '3', '3');
 INSERT INTO `T_match_mat` (`mat_id`, `mat_activation`, `mat_intitule`, `mat_datedebut`, `mat_datefin`, `qui_id`, `com_id`) VALUES 
 ('HVG45DDE', 'A', 'Session 4', '2022-10-11 16:24:09.000000', NULL, '1', '1'); 
 INSERT INTO `T_match_mat` (`mat_id`, `mat_activation`, `mat_intitule`, `mat_datedebut`, `mat_datefin`, `qui_id`, `com_id`) VALUES
 ('PLMO009K', 'A', 'Session 5', '2022-10-11 16:30:15.000000', NULL, '2', '2');
 INSERT INTO `T_match_mat` (`mat_id`, `mat_activation`, `mat_intitule`, `mat_datedebut`, `mat_datefin`, `qui_id`, `com_id`) VALUES
 ('TFTGD543', 'A', 'Session 2', '2022-10-11 16:30:15.000000', NULL, '5', '7');
 
 INSERT INTO `T_joueur_jou` (`jou_id`, `jou_pseudo`, `jou_score`, `mat_id`) VALUES 
 (NULL, 'yoplait', '100', 'PLMO009K');
  INSERT INTO `T_joueur_jou` (`jou_id`, `jou_pseudo`, `jou_score`, `mat_id`) VALUES
 (NULL, 'yop', '100', 'PLMO009K'),
 (NULL, 'lait', '12', 'PLMO009K'),
 (NULL, 'oplai', '10', 'PLMO009K'),
 (NULL, 'yoyo', '20', 'PLMO009K'),
 (NULL, 'ti', '100', 'HVG45DDE'),
 (NULL, 'laiticia', '12', 'HVG45DDE'),
 (NULL, 'oplaisir', '10', 'HVG45DDE'),
 (NULL, 'yoko', '20', 'HVG45DDE'),
 (NULL, 'ko', '30', 'HVG45DDE'),
 (NULL, 'tilo', '100', 'HVG45DDE'),
 (NULL, 'lia', '12', 'HVG45DDE'),
 (NULL, 'solor', '10', 'GGYHO556'),
 (NULL, 'yumxer', '20', 'GGYHO556'),
 (NULL, 'kalol', '30', 'GGYHO556'),
 (NULL, 'tilode', '100', 'GGYHO556'),
 (NULL, 'liaaa', '12', 'TFTGD543'),
 (NULL, 'sirsa', '10', 'TFTGD543'),
 (NULL, 'yumaaa', '20', 'TFTGD543'),
 (NULL, 'koloculot', '30', 'TFTGD543'),
 (NULL, 'tiloptere', '100', 'GJK78U67'),
 (NULL, 'liamoustache', '12', 'GJK78U67'),
 (NULL, 'sirrery', '10', 'GJK78U67'),
 (NULL, 'yuhim', '20', 'GJK78U67'),
 (NULL, 'kolic', '30', 'GJK78U67');









