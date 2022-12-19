/* //////////////////////////////////////////////////////////////////SPRINT 2//////////////////////////////////////////////////////////////////*/
/*////////////////////////////////////Matchs - Joueur////////////////////////////////////*/
/*5. Requête(s) d’affichage, si autorisé, de toutes les questions d’un match et leur
bonne réponse*/
select que_texte ,rep_libelle  from T_reponse_rep join T_question_que using (que_id) join T_match_mat using (qui_id) where rep_valide=1 and que_activation='A' and mat_activation='A' and mat_id=1234;

/*6. Requête de vérification d’une réponse donnée par un joueur (bonne ou
mauvaise ?)*/
select rep_valide from T_reponse_rep where rep_libelle='libelle de reponse'; /*0 pour mauvaise 1 pour bonne*/

/*7. Requête de mise à jour du score d’un joueur particulier (pseudo connu)*/
UPDATE T_joueur_jou set jou_score = 100 where jou_pseudo = 'yoko' order by mat_id;

/*8. Requête de récupération du score d’un joueur particulier (pseudo connu)*/
select jou_score from T_joueur_jou where jou_pseudo='yoko' order by mat_id;

/*////////////////////////////////////Quiz////////////////////////////////////*/
/*3. Requête listant tous les quiz*/
select qui_intitule from T_quiz_qui;

/*4. Requête listant tous les quiz (intitulé et auteur) et les matchs associés (intitulé
et auteur) 
l'auteur du quiz 
faut trouver où est indidiqué l'auteur d'un quiz et l'auteur d'un match
*/
select qui_intitule, com_pseudo from T_quiz_qui join T_compte_com using (com_id)
union 
select mat_intitule, com_pseudo from T_compte_com  join T_match_mat using (com_id);
/*select com_pseudo, qui_intitule, mat_intitule, com_pseudo from T_compte_com join T_quiz_qui using( com_id) join T_match_mat
 using (qui_id) join T_compte_com using(com_id)*/


/*5. Requête listant tous les quiz d’un formateur en particulier (dont on connaît l’ID)*/

select qui_intitule from T_quiz_qui join T_profil_pro using (com_id) where 
/*6. Requête donnant tous les quiz qui ne sont plus associés à un formateur*/
select qui_id, qui_intitule from T_quiz_qui join T_compte_com using(com_id) where com_pseudo='responsable'

/*7. Requête listant, pour un formateur dont on connaît le login, tous les quiz et
leurs matchs, s’il y en a*/
select com_id,qui_intitule,mat_intitule from T_compte_com left outer join T_quiz_qui using(com_id) left outer join T_match_mat using(com_id)

/*////////////////////////////////////Matchs - Joueur////////////////////////////////////*/
/*7. Requête d’ajout d’un match pour un quiz particulier (connaissant son ID)*/
INSERT INTO T_match_mat values (NULL, 'D', 'Session 17', '2022-10-11 16:20:20.000000', NULL, 'ID', '6'); 

/*8. Requête de modification d’un match*/
UPDATE T_match_mat set mat_initule='Session 10' where mat_id = 1234;

/*9. Requête de suppression d’un match dont on connaît l’ID (/le code)*/

Delete from T_match_mat where mat_id = 1234;

/*10. Requête d’activation (/désactivation) d’un match*/

UPDATE T_match_mat set mat_activation=1234;

/*11. Requête(s) de « remise à zéro » (RAZ) d’un match*/

Delete from T_joueur_jou where mat_id=1234;