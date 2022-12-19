<?php 
/*=============================================================================================================
//Nom du fichier : Db_Model
//Auteur : Yan L'Informaticien
//Date de création : Octobre 2022
//Version : V2
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Description : Ceci est une page de type model contenant la classe Db_model qui elle contient l'ensemble des fonctions qui exécutent 
les requêtes récupérant les informations tirées des données de la base de données, nécéssaires l'utilisation à l'application web.*/
class Db_model extends CI_Model
{
    /*constructeur de la classe db_model qui récupère la connexion à la base de données*/
        public function __construct()
        {
            parent::__construct();

            $this->load->database();
        }
    /* Ensemble des fonctions du Db_Model */
        /* Function qui retourne le resultat de la requête de listant toute les actualités de la base de données */
        public function get_all_news()
        {
                    $query = $this->db->query("SELECT * 
                    from T_actualite_act join T_compte_com using(com_id) 
                    order by act_id desc limit 5;");

                    return $query->result_array();
        }
        /* Fonction qui retourne le résultat de la rêquete permettant d'afficher les 5 dernières actualités du la base de données*/
        public function get_five_news()
        {
                    $query = $this->db->query("SELECT act_intitule,act_texte,act_date,act_id
                    from T_actualite_act 
                    order by act_id desc limit 5;");

                    return $query->result_array();
        }
        /*fonction qui retourne le résultat de la requête qui liste la totalité des informations de la table des comptes de la base de données */
        public function get_all_compte()
        {
                    $query = $this->db->query("SELECT * 
                    from T_compte_com;");

                    return $query->result_array();
        }
        /*fonction qui retourne le résultat de la requête qui compte toutes les lignes de la table des comptes */
        public function get_compte_compte()
        {
                    $query = $this->db->query("SELECT count(com_id) as nb 
                    from T_compte_com;");

                    return $query->row();
        }
        /* function qui permet de récuperer le résultat de la requête récupérant toutes les informations d'une seule actualité dont l'identifiant
            est passé en paramètre de cette fonction*/
        public function get_actualite($numero)
        {

                    $query = $this->db->query("SELECT * 
                    FROM T_actualite_act 
                    join T_compte_com using(com_id) WHERE
                    act_id=".$numero.";");

                    return $query->row();
        }
        /* function qui retourne le résultat de la requête qui récupère toutes les informations d'une ligne la table des matchs,  la table des questions qui leurs sont
            rattachées et celle des réponses correspondantes en passant l'identifiant de ce match en paramètre de la fonction*/
        public function get_match_id($numero)
        {
                    $query = $this->db->query("SELECT que_id,qui_id, mat_id, mat_activation,mat_intitule,mat_datedebut,mat_datefin,ps(T_match_mat.com_id) as Auteur_match	,qui_intitule	,qui_image	,ps(T_quiz_qui.com_id) as Auteur_quiz	,qui_activation	,qui_rep,que_texte	,que_ordre, que_activation,rep_id	,rep_libelle, rep_valide	
                    from T_match_mat 
                    join T_quiz_qui using(qui_id) 
                    join T_question_que using(qui_id) 
                    join T_reponse_rep using(que_id) where mat_id='".$numero."';");

                    return $query->result_array();
        }
        /* fonction qui retourne le résultat de la requête qui liste les informations de la table des match considérés comme activés et en cours*/
        public function get_all_match()
        {
                    $query = $this->db->query("SELECT * from T_match_mat where mat_activation='A' and mat_datefin is null ;");

                    return $query->result_array();
        }
        /* fonction qui retourne le résultat de la rêquete qui insère des données dans la table compte (qui ajoute un nouveau compte)
            dont le pseudo et le mot de passe sont saisis directement depuis un formulaire*/
        public function set_compte()
        {

                    $this->load->helper('url');

                    $id=$this->input->post('id');

                    $mdp=$this->input->post('mdp');

                    $req="INSERT INTO T_compte_com VALUES (NULL,'".$id."','".$mdp."');";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }
        /* function qui retourne le résultat de la requête qui vérifie si un joueur dont on connait les pseudos et le match associés existe, les 
        pseudo et identifiant de match sont passés en paramètre de la fonction*/
        public function check_joueur($mat_id,$jou_pseudo)
        {
                    $req = "SELECT * FROM T_joueur_jou WHERE mat_id='".$mat_id."' and jou_pseudo='".$jou_pseudo."';";

                    $query = $this->db->query($req);

                    return $query->row();

        }
        /*Function qui retourne le résultat de la requête qui insère un nouveau joueur dans la table joueur dans le pseudo et l'identifiant
        du match associé sont passés en paramètre*/
        public function insert_joueur($mat_id,$jou_pseudo)
        {
                    $req = "INSERT INTO T_joueur_jou VALUES (NULL,'".$jou_pseudo."', '0','".$mat_id."');";

                    $query = $this->db->query($req);

                    return ($query);

        }
         /*Function qui retourne un booleen vrai/faux en fonction du résultat de la requête qui affiche le compte dont on connait le pseudo et le mot de passe*/
        public function connect_compte($username, $password)
        {
        $query =$this->db->query("SELECT *
                                FROM T_compte_com
                                JOIN T_profil_pro
                                WHERE com_pseudo='".$username."' AND com_mdp='".$password."';");
           
                if($query->num_rows() > 0) 
                    { 
                        return true; 
                    } 
                    else 
                    { 
                        return false;
                    } 
        }

        /*Function qui retourne le résultat de la requête donne les informations d'un d'un compte et du profil associé */

        public function verif_role($username, $password)
        {
            $query = $this->db->query("SELECT * 
                                        FROM T_compte_com 
                                        JOIN T_profil_pro using(com_id)
                                        WHERE com_pseudo='".$username."' AND com_mdp='".$password."';");
            return $query->row();
            
        }

        /*Function qui retourne le résultat de la requête donne les informations d'un d'un compte et du profil associé*/
        public function get_info_compte($info)
        {
                    $query = $this->db->query("SELECT *
                    from T_compte_com join T_profil_pro using(com_id) WHERE com_pseudo='".$info."';");

                    return $query->row();
        }
        /*Function qui retourne le résultat de la requête qui vérifie l'existence d'un compte dont on connait le mdp*/
        public function get_mdp_compte($info)
        {
                    $query = $this->db->query("SELECT *
                    from T_compte_com  WHERE com_pseudo='".$info."';");

                    return $query->row();
        }
        /*Functions qui retournent le résultat des requêtes qui modifie chacune soit le nom, le prenom ou le mot de passe dont l'identfiant du compte associé est connu */
                     
                            /* cas du prenom */
                            public function up_nom($nom,$id)
                            {

                                        $this->load->helper('url');


                                        $req="UPDATE T_profil_pro set pro_nom ='".$nom."' where com_id='".$id."';";

                                        $query = $this->db->query($req);
                                        
                                        return ($query);

                            }
                            /* cas du prenom */
                            public function up_prenom($nom,$id)
                            {

                                        $this->load->helper('url');


                                        $req="UPDATE T_profil_pro set pro_prenom ='".$nom."' where com_id='".$id."';";

                                        $query = $this->db->query($req);
                                        
                                        return ($query);

                            }
                            /* Cas du mdp */
                            public function up_mdp($mdp,$truc)
                            {

                                        $this->load->helper('url');


                                        $req="UPDATE T_compte_com set com_mdp ='".$mdp."' where com_pseudo='".$truc."';";

                                        $query = $this->db->query($req);
                                        
                                        return ($query);

                             }



        /*Function qui retourne le résultat de la requête qui renvoie toutes les informations de la table des Matchs */
        public function get_all_full_match()
        {
                    $query = $this->db->query("SELECT * from T_match_mat ;");

                    return $query->result_array();
        }
        /*Function qui retourne le résultat de la requête qui renvoie la moyenne des scores des joueurs ayant joué à un match dont on connait l'id */

        public function score_match($id)
        {
            $query1 = $this->db->query("SET @p0='".$id."';");
            $query2 = $this->db->query("CALL `moyenne`(@p0, @p1);"); 
            $query3 = $this->db->query("SELECT @p1 AS `moy`;"); 
            
            
            return $query3->row(); 
        }

        /*Function qui retourne le résultat de la requête */
        public function get_info_match($num)
        {
                    $query = $this->db->query("SELECT * from T_match_mat join T_compte_com using(com_id) ;");

                    return $query->result_array();
        }

        /*Function qui retourne le résultat de la requête */
        public function get_all_quiz()
        {
                    $query = 
                    $this->db->query("SELECT * from T_quiz_qui 
                    join T_compte_com using(com_id) where qui_activation='A' ;");

                    return $query->result_array();
        }

        /*Function qui retourne le résultat de la requête */
        public function cpt_quiz($nb)
        {
            $query = 
            $this->db->query("SELECT count(que_id) as nb 
            from T_question_que where qui_id=".$nb.";");

            return $query->row();
        }

        /*Function qui retourne le résultat de la requête */
        public function get_info_quiz($pd,$id)
        {
                    $query = 
                    $this->db->query("SELECT * from T_quiz_qui 
                    join T_compte_com using(com_id) where com_pseudo='".$pd."' and qui_id='".$id."';");

                    return $query->row();
        }

        /*Function qui retourne le résultat de la requête */
        public function get_quiz_id($numero)
        {
                    $query =
                    $this->db->query("SELECT que_id,qui_id, qui_intitule,qui_image	,ps(T_quiz_qui.com_id) as Auteur_quiz,qui_activation,qui_rep,que_texte,que_ordre, que_activation,rep_id	,rep_libelle, rep_valide	
                    
                    from T_quiz_qui 
                    join T_question_que using(qui_id) 
                    join T_reponse_rep using(que_id) where qui_id='".$numero."';");

                    return $query->result_array();
        }

        /*Function qui retourne le résultat de la requête qui renvoie les infos des quiz activés et de leurs matchs associés */
        public function get_un_match_id()
        {
                    $query = $this->db->query("SELECT qui_rep,qui_id, qui_intitule, qui_activation, qui_image, ps(T_quiz_qui.com_id) as Auteur_quiz,count(que_id) as nb_q,mat_id, mat_intitule, mat_datefin,mat_activation, mat_datedebut,mat_datefin, ps(T_match_mat.com_id) as Auteur_match
                    from T_match_mat right outer join T_quiz_qui using(qui_id)
                    left outer join T_question_que using(qui_id) where qui_activation='A'
                    group by mat_id order by qui_id");

                    return $query->result_array();
        }

        /*Function qui retourne le résultat de la requête */
        public function desac_match($nom)
        {

                    $this->load->helper('url');

                    $req="UPDATE T_match_mat set mat_activation ='D' where mat_id='".$nom."';";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }

        /*Function qui retourne le résultat de la requête */
        public function fini_match($nom)
        {

                    $this->load->helper('url');


                    $req="UPDATE T_match_mat set mat_datefin=NOW() where mat_id='".$nom."';";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }

        /*Function qui retourne le résultat de la requête */
        public function ac_match($nom)
        {

                    $this->load->helper('url');


                    $req="UPDATE T_match_mat set mat_activation ='A' where mat_id='".$nom."';";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }

        /*Function qui retourne le résultat de la requête qui modifie la date d'un match et la met a une date ulterieure (demain) */
        public function dater_match($nom)
        {

                    $this->load->helper('url');


                    $req="UPDATE T_match_mat set mat_datedebut=ADDDATE(NOW(),1) where mat_id='".$nom."';";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }

        /*Function qui retourne le résultat de la requête qui met la date de fin à null et la date debut à une date ulterieure
         d'un match donné   */
        public function nuller_match($nom)
        {
            $this->load->helper('url');


            $req="UPDATE T_match_mat set mat_datefin=NULL where mat_id='".$nom."';";

            $query = $this->db->query($req);
            
            return ($query);

        }

        /*Function qui retourne le résultat de la requête qui met la date de fin à null et la date debut à une date ulterieure
         d'un match donné  */
        public function razer_match($nom)
        {

                    $this->load->helper('url');

                    $req="UPDATE T_match_mat set mat_datefin=NULL where mat_id='".$nom."'; ";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }

        /*Function qui retourne le résultat de la requête */
        public function super_match($nom)
        {

                    $this->load->helper('url');

                    $req="DELETE from T_match_mat where mat_id='".$nom."';";

                    $query = $this->db->query($req);
                    
                    return ($query);
        }

        /*Function qui retourne le résultat de la requête permettant d'inserer un match donc on selectionnne le code et le nom, initialise à 
        la date d'aujourd'hui dont le formateur responsable et le code du quiz associés sont connus */
        public function insert_match($random,$titre,$id_quiz,$id)
        {
                    $req = "INSERT INTO T_match_mat VALUES ('".$random."','D','".$titre."',ADDDATE(NOW(),1),NULL, '".$id_quiz."','".$id."')";

                    $query = $this->db->query($req);

                    return ($query);

        }

        /*Function qui retourne le résultat de la requête qui donne les informations d'un joueur appartenant à un quiz dont on connait l'identifiant*/
        public function get_info_joueur($info)
        {
                    $query = $this->db->query("SELECT *
                    from T_joueur_jou WHERE mat_id='".$info."';");

                return $query->result_array();
        }

        /*Function qui retourne le résultat de la requête qui donne la table contenant la liste des questions, des reponses valides des questions d'un quiz */
        public function get_id_rep_co($id_quiz)
        {
            $query = $this->db->query("SELECT *
            from rep_co WHERE qui_id='".$id_quiz."';");

            return $query->result_array();

        }
        public function check_rep_co($id)
        {
            $query = $this->db->query("SELECT rep_valide
            from T_reponse_rep 
            WHERE rep_id='".$id."';");

            return $query->row();

        }


        /*Function qui retourne le résultat de la requête qui donne le nombre de questions activées d'un quiz*/
        public function get_id_nb_ques_co($id)
        {
            $query = $this->db->query("SELECT count(que_id) as nbc
            from T_question_que WHERE qui_id='".$id."' and que_activation='A';");

            return $query->row();

        }

        /*Function qui retourne le résultat de la requête de modification du score d'un joueur qui a fini de jouer à un match*/
        public function up_score($mdp,$truc)
        {

                    $this->load->helper('url');

                    $req="UPDATE T_joueur_jou set jou_score='".$mdp."' where jou_pseudo='".$truc."';";

                    $query = $this->db->query($req);
                    
                    return ($query);

        }
         
        


    }
?>