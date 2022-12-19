<?php 
/*=============================================================================================================
//Nom du fichier : Db_Model
//Auteur : Yan L'Informaticien
//Date de création : Octbre 2022
//Version : V1
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Description : Ceci est une page de type model contenant la classe Db_model qui elle contient l'ensemble des fonctions qui exécutent 
les requêtes récupérant les informations tirées des données de la base de données, nécéssaires l'utilisation du  site internet.*/
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
                    $query = $this->db->query("SELECT * 
                    from T_match_mat join T_quiz_qui using(qui_id) 
                    join T_question_que using(qui_id) 
                    join T_reponse_rep using(que_id) 
                    where mat_id='".$numero."';");

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
        public function connect_compte($username, $password)
        {
        $query =$this->db->query("SELECT com_pseudo,com_mdp
                                FROM T_compte_com
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
        }






?>