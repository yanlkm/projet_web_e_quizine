/*ACTIVITE 4 
Préparez plusieurs vues pour votre base de données (au moins une vue par
étudiant) : */
/* vue qui rassemble chaque quiz et son créateur  */

create view psdquiz as  select com_pseudo, qui_id,qui_intitule,qui_image from T_compte_com left outer join  T_quiz_qui using(com_id);
/* 
vue qui affiche chaque question avec ses propositions de réponses */

create view lancement as select que_texte, rep_libelle from T_question_que left outer join T_reponse_rep using (que_id) order by que_texte;

/* Préparez plusieurs fonctions pour votre base de données (au moins une fonction par
étudiant).*/
/* fonction qui retourne le score d'un joueur dont on connaît l'id */
DELIMITER 
//
create function scorejoueur(idjoueur INT) returns INT
begin 
set @nombre:=0;
select jou_score into @nombre from T_joueur_jou where jou_id=idjoueur;
return @nombre;
end;
 // 
 DELIMITER ;

 select scorejoueur(6);
 /*fonction qui retourne la moyenne du score total des participations d'un match

 /*création de vue qui prend en compte le joueur et son score NON NUL à son match*/
 create view scorematchjoueur as select jou_id,jou_score, mat_id from T_joueur_jou where jou_score is not null

 DELIMITER 
 // 
 create function moyscore(idmatch INT) returns DOUBLE
 begin
 set @nombre:=0;
 select avg(jou_score) into @nombre from scorematchjoueur where mat_id=idmatch;
 return @nombre; 
 end; 
// DELIMITER ; 

select moyscore(13322);

/*
Préparez plusieurs procédures pour votre base de données (au moins une procédure
par étudiant). */

/* procédures qui active/désactive une question et un quizz connaissant leur ID*/
/*activation/desactivation question*/

DELIMITER //
create procedure activatonquestion(IN ID INT) 
begin 
UPDATE T_question_que set que_activation='A' where que_id=ID;
end
//
DELIMITER ;

DELIMITER //
create procedure desactivatonquestion(IN ID INT) 
begin 
UPDATE T_question_que set que_activation='D' where que_id=ID;
end
//
DELIMITER ;

call desactivationquestion(11);
call activationquestion(11);

/*activation/desactivation quiz  */

DELIMITER //
create procedure activationquiz(IN ID INT) 
begin 
UPDATE T_quiz_qui set qui_activation='A' where qui_id=ID;
end
//
DELIMITER ;

DELIMITER //
create procedure desactivationquiz(IN ID INT) 
begin 
UPDATE T_quiz_qui set qui_activation='D' where qui_id=ID;
end
//
DELIMITER ;

call desactivationquiz(1);
call activationquiz(3);

/*  Préparez plusieurs triggers pour votre base de données (au moins 2
déclencheurs par étudiant) */
/* trigger permettant de désactiver un quiz dans lequel une question a été supprimé */

DELIMITER //
create trigger desactiver_quiz 
after delete on T_question_que 
for each row 
begin
call desactivationquiz(old.qui_id);
end
// DELIMITER ;

delete from T_reponse_rep where que_id=10;
Delete from T_question_que where que_id=10; 


/*trigger permettant de désactiver toutes les questions du quiz du match créé */

DELIMITER // 
create trigger desactiver_question
after insert on T_match_mat
for each row 
begin 
UPDATE T_question_que set que_activation='D' where qui_id=new.qui_id; 
end; 
// DELIMITER ;

insert into T_match_mat values ('1234', 'A', 'Session 9', '2022-11-11 16:20:20.000000', NULL, '4', '6'); 

/* ACTIVITE 5 */

/*TRIGGER 1*/
DELIMITER // 
Create trigger supques 
after delete on T_question_que 
for each row 
begin 
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
set @match1:=concat("\r\n                    la liste des matchs est : ",@match, ' le nombre de question qui restent : ',@nb);
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
end;
// DELIMITER ;

delete from T_reponse_rep where que_id=10;
Delete from T_question_que where que_id=10; 

/* TRIGGER 2 */
DELIMITER // 
create trigger remz 
after update on T_match_mat
for each row 
begin
if(new.mat_datedebut > NOW() and new.mat_datefin is NULL) then 
DELETE from T_joueur_jou where mat_id=new.mat_id; 
end if; 

end
//  DELIMITER ;

Update T_match_mat set mat_datedebut='2022-11-11 16:20:20.000000' , mat_datedefin is null;

/* //////////////////////////////////////////////////////////////////SPRINT 1//////////////////////////////////////////////////////////////////*/
/*////////////////////////////////////Actualités////////////////////////////////////*/
/*1. Requête listant toutes les actualités de la table des actualités et leur auteur
(login)*/
select act_intitule,act_texte,com_pseudo from T_actualite_act join T_compte_com using(com_id);

/*2. Requête donnant les données d'une actualité dont on connaît l'identifiant (n°)*/
select * from T_actualite_act where act_id=X;

/*3. Requête listant les 5 dernières actualités dans l'ordre décroissant*/
select * from T_actualite_act order by act_id desc limit 5;

/*4. Requête recherchant et donnant la (ou les) actualité(s) contenant un mot
particulier*/
select act_id from T_actualite_act where act_texte like "%mot particulier%";

/*5. Requête listant toutes les actualités postées à une date particulière + le login
de l’auteur*/
select T_actualite_act.*, com_pseudo from T_actualite_act join T_compte_com using(com_id) where act_date > '2022-01-01'

/*////////////////////////////////////Matchs - Joueur////////////////////////////////////*/
/*1. Requête vérifiant l’existence (ou non) du code d’un match*/
select * from T_match_mat where mat_id=1234;

/*2. Requête d’ajout du pseudo d’un joueur pour un match particulier dont l’ID est
connu*/
INSERT INTO T_joueur_jou values (NULL,'MrDUPONT','0',idmatch);

/*3. Requête vérifiant l’existence (ou non) d’un pseudo pour un match particulier*/
select jou_pseudo from T_joueur_jou join T_match_mat using (mat_id) where mat_id = 1234 and jou_pseudo ="lolo";

/*4. Requête(s) d’affichage de toutes les questions (+ réponses) associées à un
match*/
select T_question_que.* , T_reponse_rep.* from T_match_mat join T_question_que using (qui_id) join T_reponse_rep using (que_id) where mat_id=1234; 

/*////////////////////////////////////Actualités////////////////////////////////////*/
/*1. Requête listant toutes les actualités postées par un auteur particulier
(connaissant le login du formateur connecté)*/
select * from T_compte_com join T_actualite_act using(com_id) where com_pseudo='Fred44';

/*////////////////////////////////////Profils (formateurs / administrateurs)////////////////////////////////////*/
/*1. Requête listant toutes les données de tous les profils*/

select * from T_profil_pro;
/*2. Requête listant les données des profils des formateurs (/des administrateurs)*/
select * from T_profil_pro where pro_role='A';
select * from T_profil_pro where pro_role='F';
/*3. Requête de vérification des données de connexion (login et mot de passe)*/
select com_id from T_compte_com where com_pseudo='Fred44' and com_mdp='ciel';

/*4. Requête récupérant les données d'un profil particulier (utilisateur connecté)*/
 select T_profil_pro.* from T_compte_com join T_profil_pro using(com_id) where com_id=1 and c
om_mdp='ciel';

/*5. Requête récupérant tous les logins des profils et l'état du profil (activé /
désactivé)*/
select T_compte_com.com_id, com_pseudo, pro_validite from T_compte_com join T_profil_pro;

/*////////////////////////////////////Quiz////////////////////////////////////*/
/*1. Requête(s) permettant de récupérer toutes les données (questions, choix
possibles) d’un quiz en particulier*/

select T_quiz_qui.qui_id,que_texte,rep_libelle from T_reponse_rep join T_question_que using(
que_id) join T_quiz_qui using (qui_id);

/*2. Requête qui compte les questions d’un quiz dont on connaît l’ID*/
 select count(que_id) from T_question_que where qui_id=1;

/*////////////////////////////////////Matchs - Formateur////////////////////////////////////*/
/*1. Requête permettant de récupérer toutes les données (questions, choix
possibles) d’un questionnaire associé à un match dont on connaît le code*/

select T_reponse_rep.rep_libelle, T_question_que.que_texte from T_match_mat join T_question_
que using (qui_id) join T_reponse_rep using (que_id) where mat_id=1234;
/*2. Requête donnant le nombre de joueurs d’un match particulier*/

select count(jou_id) from T_match_mat join T_joueur_jou using(mat_id) where mat_id=1234;
/*3. Requête permettant de donner le score final d’un match particulier*/

select sum(jou_score) from T_match_mat join T_joueur_jou using (mat_id) where mat_id=1234;
/*4. Requête listant les scores finaux et les pseudos des joueurs d’un match
particulier*/
select sum(jou_score), group_concat(jou_pseudo) from T_match_mat join T_joueur_jou using (ma
t_id) where mat_id=1234;

/*5. Requête listant tous les matchs d’un formateur en particulier (formateur
connecté)*/

select mat_id from T_compte_com join T_match_mat using (com_id) where com_pseudo='Fred44';
/*6. Requête qui récupère tous les matchs associés à un quiz particulier
(connaissant son ID)*/
select mat_id from T_quiz_qui join T_match_mat using (qui_id) where qui_id=2;

/*TOUS LES TRIGGERS */
CREATE TRIGGER `desactiver_question_match` AFTER INSERT ON `T_match_mat`
 FOR EACH ROW begin 
UPDATE T_question_que set que_activation='D' where qui_id=new.qui_id; 
end

CREATE TRIGGER `desactiver_quiz` AFTER DELETE ON `T_question_que`
 FOR EACH ROW begin
call desactivationquiz(old.qui_id);
end

CREATE TRIGGER `remz` AFTER UPDATE ON `T_match_mat`
 FOR EACH ROW begin
if(new.mat_datedebut > NOW() and new.mat_datefin is NULL) then 
DELETE from T_joueur_jou where mat_id=old.mat_id; 
end if; 

end

CREATE TRIGGER `supques` AFTER DELETE ON `T_question_que`
 FOR EACH ROW begin 
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
set @match1:=concat("\r\n                    la liste des matchs est : ",@match, ' le nombre de question qui restent : ',@nb);
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

CREATE TRIGGER `trouver1` AFTER UPDATE ON `T_match_mat`
 FOR EACH ROW BEGIN
	if NEW.mat_datefin is not null then 
		call actu(NEW.mat_id);
        end if;
END
/* les fonctions*/
DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` FUNCTION `joueurmatch`(idmatch INT) RETURNS char(100) CHARSET utf8mb4
begin 
	declare retour char(100) default "";
    set retour := ( select GROUP_CONCAT(jou_pseudo) from T_joueur_jou where mat_id=idmatch);
   return retour;
    

   END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` FUNCTION `moyscore`(`idmatch` INT) RETURNS double
begin
 set @nombre:=0;
 select avg(jou_score) into @nombre from scorematchjoueur where mat_id=idmatch;
 return @nombre; 
 end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` FUNCTION `ps`(`ID` INT) RETURNS varchar(11) CHARSET utf8mb4
BEGIN
set @pseudo:=(select com_pseudo from T_compte_com where com_id=ID);
return @pseudo;
end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` FUNCTION `scorejoueur`(idjoueur INT) RETURNS int(11)
begin 
set @nombre:=0;
select jou_score into @nombre from T_joueur_jou where jou_id=idjoueur;
return @nombre;
end$$
DELIMITER ;

/*les procédures */
DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `activationquestion`(IN `ID` INT)
begin 
UPDATE T_question_que set que_activation='A' where que_id=ID;
end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `activationquiz`(IN `ID` INT)
begin 
UPDATE T_quiz_qui set qui_activation='A' where qui_id=ID;
end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `actu`(IN `IDMATCH` INT)
begin  
	select mat_intitule into @intmatch from T_match_mat where mat_id=IDMATCH;
	select mat_datefin into @finmatch from T_match_mat where mat_id=IDMATCH;
	select mat_datedebut into @debutmatch from T_match_mat where mat_id=IDMATCH;
	select joueurmatch(idmatch) into @liste ;
    select (GROUP_CONCAT('date debut :',@debutmatch,'date de de fin :',@finmatch,'liste des joueurs',@liste)) into @chaine;
    
	if (@finmatch is not null) then
	INSERT INTO T_actualite_act values (NULL,@intmatch,@chaine,'rien',NOW(),4);
	end if;
    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `desactivationquestion`(IN `ID` INT)
begin 
UPDATE T_question_que set que_activation='D' where que_id=ID;
end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `desactivationquiz`(IN `ID` INT)
begin 
UPDATE T_quiz_qui set qui_activation='D' where qui_id=ID;
end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `renvoi1`(OUT `ENCOURS` INT, OUT `AVENIR` INT, OUT `FINI` INT)
BEGIN

select count(mat_id) into ENCOURS from T_match_mat where mat_datefin is null;


select count(mat_id) into AVENIR from T_match_mat where mat_datedebut > NOW() and mat_datefin is null;

select count(mat_id) into FINI from T_match_mat where mat_datefin is not null and mat_datefin < NOW();

end$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`zlikemeya`@`%` PROCEDURE `test`()
begin 
select count(mat_id) from T_match_mat;
END$$
DELIMITER ;

