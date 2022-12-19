<?php
/*=============================================================================================================
//Nom du fichier : Compte
//Auteur : Yan L'Informaticien
//Date de création : Octobre 2022
//Version : V2
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
///Description : Ceci est une page de type controller contenant la classe Compte
qui elle contient l'ensemble des fonctions qui permet la connexion et la deconnexion d'un utilisateur, l'affiche des données d'un utilisateur connecté
la gestion CRUD des matchs par un formateur, nécéssaires l'utilisation du  site internet.*/


class Compte extends CI_Controller 
        {

	public function __construct()
        {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('db_model');
        $this->load->helper('url_helper');
        }
        
        public function lister()
        {
        $data['titre'] = 'Liste des pseudos assoxiés aux comptes :';
        $data['nbc'] = $this->db_model->get_compte_compte();
        $data['pseudos'] = $this->db_model->get_all_compte();
        
        $this->load->view('templates/haut');
        $this->load->view('compte_liste',$data);
        $this->load->view('templates/bas');
        }

        public function b_connecter()
        {
                $data['error']=0;
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter',$data);
                $this->load->view('templates/bas');



        }


        public function connecter()
        {
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['error']=0;
                
                $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
                $this->form_validation->set_rules('mdp', 'mdp', 'required');
                
        
      
        if ($this->form_validation->run() != FALSE)
        {
                
                $data['error']=0;
                $username = $this->input->post('pseudo'); 
                $pass = $this->input->post('mdp');
                $salt = "souscrivezunabonnement";
                $password = hash('sha256', $salt.$pass);
                
                $data['info']=$username;
                $data['compte']=$this->db_model->verif_role($username,$password);
                $rol= $this->db_model->verif_role($username,$password);

                if($this->db_model->connect_compte($username,$password))
                { 
                        
                        $session_data = array(
                                'username'  => $username,
                                'logged_in' => TRUE,
                                'role' => $rol->pro_role
                              );
  
                             $this->session->set_userdata($session_data); 
                             redirect('compte/backer');
             
                }
                else
                {
                        $data['error']=2;
                        $this->load->view('templates/haut');
                        $this->load->view('compte_connecter',$data);
                        $this->load->view('templates/bas');
                }
        }

        else
        {       
                $data['error']=1;
                $this->load->view('templates/haut');
                
                $this->load->view('compte_connecter',$data);
                $this->load->view('templates/bas');
                
        }

        }
        public function com_gerer()
        {
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                $data['pseudos'] = $this->db_model->get_all_compte();
                $data['nbc']='Liste de tous comptes' ;    
                if(!empty($this->session->userdata('username')))
                {
                        if($this->session->userdata('role')!='F') 
                        {

                        $this->load->view('gerer_compte',$data);
                        $this->load->view('templates/bas');
                        }
                        else 
                        {
                        redirect('accueil/afficher');
                        }
                
                }
                else 
                {
                        redirect('compte/b_connecter');
                }
        }
        

        public function backer()
        {
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                $data['pseudos'] = $this->db_model->get_all_compte();
                $data['nbc']='Liste de tous comptes' ;    
                if(!empty($this->session->userdata('username')))
                {

                        $this->load->view('compte_menu',$data);
                        $this->load->view('templates/bas');
                
                }
                else 
                {
                        redirect('compte/b_connecter');
                }
        }

        public function informer()
        {      $data['error']=0;
                $this->load->helper('form');
                $this->load->library('form_validation');

               if(!empty($this->session->userdata('username')))
                {
                $data['pseudos'] = $this->db_model->get_all_compte();
                $data['nbc']='Liste de tous comptes' ;  
                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                $data['title']='Titre'; 
                     
                $this->load->view('menu_info_ad',$data);
               
                $this->load->view('templates/bas');
                }
                else 
                {
                        redirect('compte/b_connecter');
                }
                

        }
        
        public function modifier()
        {
               
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                if(!empty($this->session->userdata('username')))
                {
                        
                        
                      
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['title']='Titre'; 
                        $data['error']=0;
                        
                     
                        $this->load->view('menu_mod_ad',$data);
               
                        {$this->load->view('templates/bas'); }   

                }
                else 
                {
                        redirect('compte/b_connecter');
                }

        }

        public function fupdater()
        {
                $data['error']=0;
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('mdp1', 'mdp1', 'required');
                $this->form_validation->set_rules('mdp2', 'mdp2', 'required');
                $name = $this->input->post('nom');
                $full = $this->input->post('prenom');
                $mdp1 = $this->input->post('mdp1');
                $mdp2 =$this->input->post('mdp2');

           if(!empty($this->session->userdata('username')))
           {
                $v=$this->db_model->get_info_compte($this->session->userdata('username'));
                if ($this->form_validation->run() != FALSE)
                {
                        $id=$this->db_model->get_info_compte($this->session->userdata('username'));

                        if($mdp1==$mdp2)
                        {
                          

                           $salt = "souscrivezunabonnement";
                           $password = hash('sha256', $salt.$mdp1);

                           $test = $this->db_model->get_mdp_compte($this->session->userdata('username'));

                                if ( $test->com_mdp == $mdp1 )

                                {
                                        $this->db_model->up_mdp($mdp1,$this->session->userdata('username'));
                                }

                                if ($test->com_mdp != $mdp1 )
                                {
                                        $this->db_model->up_mdp($password,$this->session->userdata('username'));
                                } 
                                
                                        
                                $this->db_model->up_nom((string) $name,$id->com_id);
                                $this->db_model->up_prenom($full,$id->com_id) ;    
  
                                

                                
                                   redirect('compte/informer');
                        } 
                          
                          
                                
                       
                        else
                        {
                                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['title']='Titre'; 

                                $data['error']=1;
                               
                        $this->load->view('menu_mod_ad',$data);
               
                        $this->load->view('templates/bas');   
                        }
                        
                }

                else
                        {
                                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['title']='Titre'; 
                                $data['error']=2;
                                
                        $this->load->view('menu_mod_ad',$data);
               
                        $this->load->view('templates/bas');    
                        
                        }

           }
        //else 
               /* {
                        redirect('compte/b_connecter');
                }*/


        }
        public function supdater()
        {
                $data['error']=0;
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('mdp1', 'mdp1', 'required');
                $this->form_validation->set_rules('mdp2', 'mdp2', 'required');
               
                $mdp1 = $this->input->post('mdp1');
                $mdp2 =$this->input->post('mdp2');

           if(!empty($this->session->userdata('username')))
           {
                $v=$this->db_model->get_info_compte($this->session->userdata('username'));
                if ($this->form_validation->run() != FALSE)
                {
                        $id=$this->db_model->get_info_compte($this->session->userdata('username'));

                        if($mdp1==$mdp2)
                        {
                          

                           $salt = "souscrivezunabonnement";
                           $password = hash('sha256', $salt.$mdp1);

                           $test = $this->db_model->get_mdp_compte($this->session->userdata('username'));

                                if ( $test->com_mdp == $mdp1 )

                                {
                                        $this->db_model->up_mdp($mdp1,$this->session->userdata('username'));
                                }

                                if ($test->com_mdp != $mdp1 )
                                {
                                        $this->db_model->up_mdp($password,$this->session->userdata('username'));
                                } 

                                
                                   redirect('compte/informer');
                        } 
                          
                          
                                
                       
                        else
                        {
                                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['title']='Titre'; 

                                $data['error']=1;
                               
                        $this->load->view('menu_mod_ad',$data);
               
                        $this->load->view('templates/bas');   
                        }
                        
                }

                else
                        {
                                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                                $data['title']='Titre'; 
                                $data['error']=2;
                                
                        $this->load->view('menu_mod_ad',$data);
               
                        $this->load->view('templates/bas');    
                        
                        }

           }
        }

        public function list_matcher()
        {
                if(!empty($this->session->userdata('username')) )
                {    
                        if($this->session->userdata('role')=='F')
                       {
                        $data['error']=0;
                        $data['quiz']=$this->db_model->get_all_quiz();
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['list']=$this->db_model->get_un_match_id();
                        
        
                        $this->load->view('menu_ges_ma',$data);
                
                        $this->load->view('templates/bas'); 
                }
                else 
                {
                        redirect('accueil/afficher');
                }
                       } 
                else 
                {
                        redirect('accueil/afficher');
                }
        }
        

        public function matcher($numero)

        {
        
       

            if(!empty($this->session->userdata('username')))
           {
                if($this->session->userdata('role')=='F')
                { 
            $data['titre']=' LE MATCH DE NOTRE QUIZ ';
            $data['ligne']=$this->db_model->get_match_id($numero);
            $data['joueur']=$this->db_model->get_info_joueur($numero);
            $data['res']=$this->db_model->score_match($numero);
            $data['test']= $this->db_model->get_info_compte($this->session->userdata('username'));
            
            $this->load->view('templates/haut');
            $this->load->view('match_page_ad',$data);
            $this->load->view('templates/bas');  
                }
                else 
                {
                        redirect('accueil/afficher');
                }
           } 
           else {
                redirect('accueil/afficher');

           }
        
	

        }

       

        public function list_reper($numero)

        {
        
       

            if(!empty($this->session->userdata('username')))
               {
        
                if($this->session->userdata('role')=='F') { 

           
            $data['titre']=' LES REPONSES AU MATCH ! ';
            $data['ligne']=$this->db_model->get_match_id($numero);
            $data['joueur']=$this->db_model->get_info_joueur($numero);
            $data['res']=$this->db_model->score_match($numero);
            $this->db_model->fini_match($numero);

            $this->load->view('templates/haut');
            $this->load->view('rep_page_ad',$data);
            $this->load->view('templates/bas');  
                }
                else 
                {
                        redirect('accueil/afficher');
                }}

        else 
                {
                        redirect('accueil/afficher');
                }
	

        }
        public function match_desactiver($code)
        {

                if(!empty($this->session->userdata('username')))
                {if($this->session->userdata('role')=='F') 
                        {
                        $data['quiz']=$this->db_model->get_all_quiz();
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['list']=$this->db_model->get_un_match_id();

                        $this->db_model->desac_match($code);

                        redirect('compte/list_matcher',$data);
                        
            
            
                }
                else 
                {
                        redirect('accueil/afficher');
                }}
                else 
                {
                        redirect('accueil/afficher');
                }

        }
        public function match_activer($code)
        {

                if(!empty($this->session->userdata('username')))
                {if($this->session->userdata('role')=='F') 
                        {
                        $data['quiz']=$this->db_model->get_all_quiz();
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['list']=$this->db_model->get_un_match_id();

                        $this->db_model->ac_match($code);

                        redirect('compte/list_matcher',$data);
                        
            
            
                }
                else 
                {
                        redirect('accueil/afficher');
                }}
                else 
                {
                        redirect('accueil/afficher');
                }

        }
        public function match_razer($code)
        {

                if(!empty($this->session->userdata('username')))
                { 
                        if($this->session->userdata('role')=='F') 
                        {
                        $data['quiz']=$this->db_model->get_all_quiz();
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['list']=$this->db_model->get_un_match_id();

                        $this->db_model->dater_match($code);
                        $this->db_model->nuller_match($code);
                        

                        redirect('compte/list_matcher',$data);
                        
            
            
                }
                else 
                {
                        redirect('accueil/afficher');
                }
                        }
                        else 
                {
                        redirect('accueil/afficher');
                }
                        
        }
        public function match_super($code)
        {

                if(!empty($this->session->userdata('username')))
                { 
                        if($this->session->userdata('role')=='F') 
                        {
                        $data['quiz']=$this->db_model->get_all_quiz();
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['list']=$this->db_model->get_un_match_id();

                        $this->db_model->dater_match($code);
                        $this->db_model->nuller_match($code);
                        $this->db_model->super_match($code);

                        redirect('compte/list_matcher',$data);
                        
            
            
                }
                else 
                {
                        redirect('accueil/afficher');
                }
        }

         else 
                {
                        redirect('accueil/afficher');
                }
        }

        public function match_creer()
        {
                if(!empty($this->session->userdata('username')))
                { 
                        if($this->session->userdata('role')=='F') 
                        {

                $data['error']=0;
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                $data['quiz'] = $this->db_model->get_all_quiz();
                               
                $this->load->view('creer_match',$data);
                $this->load->view('templates/bas');  
                        }

                        else 
                        {
                                redirect('accueil/afficher');
                        }
                }
                
         else 
         {
                 redirect('accueil/afficher');
         }

        }
        public function finir_match_creer()
        {
                        
                if(!empty($this->session->userdata('username')))
                {
                        if($this->session->userdata('role')=='F') 
                        {
                         $data['error']=0;
                         $this->load->helper('form');
                         $this->load->library('form_validation');
                         
                         $this->form_validation->set_rules('titre', 'titre', ['required','alpha_numeric_spaces']);
                         $quiz = $this->input->post('quiz');
                         $titre = $this->input->post('titre');

                        if ($this->form_validation->run() != FALSE)
                        {
                                        $id=$this->db_model->get_info_compte($this->session->userdata('username'));

                                        $cpt=$this->db_model->cpt_quiz($quiz);

                                        if($cpt->nb > 0 )
                                {
                                                        $strings = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
                                                        $stringLength = strlen($strings);
                                                        $random = '';
                                                        for ($i = 0; $i < 8; $i++) {
                                                        $random .= $strings[rand(0, $stringLength - 1)];
                                                        }

                                                                if($this->db_model->insert_match($random,$titre,$quiz,$id->com_id))
                                                                {
                                                                redirect('compte/list_matcher');   
                                                                }
                                                                else
                                                                {
                                                                $data['error']=3;
                                                                $data['quiz']=$this->db_model->get_all_quiz();
                                                                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                                                                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                                                                $data['list']=$this->db_model->get_un_match_id();
                                                                $this->load->view('menu_ges_ma',$data);
                                                        
                                                                $this->load->view('templates/bas'); 
                                                                
                                                                }
                                                        
                                } 
                                else{
                                                $data['error']=1;
                                                $data['quiz']=$this->db_model->get_all_quiz();
                                                $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                                                $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                                                $data['list']=$this->db_model->get_un_match_id();
                                        
                        
                                                $this->load->view('menu_ges_ma',$data);
                                        
                                                $this->load->view('templates/bas'); 

                                }
                                
                }
                else 
                {
                        $data['error']=2;
                        $data['quiz']=$this->db_model->get_all_quiz();
                        $data['compte']=$this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['fic'] = $this->db_model->get_info_compte($this->session->userdata('username'));
                        $data['list']=$this->db_model->get_un_match_id();
                

                        $this->load->view('creer_match',$data);
                
                        $this->load->view('templates/bas'); 
                }
        }

        else 
                {
                redirect('accueil/b_connecter');
                }

                        

}
else 
        {
        redirect('accueil/b_connecter');
        }

        }

        public function deconnecter()
        {
              
                $this->load->library('session');
                $this->load->helper('form');
                $this->load->library('form_validation');
               
                
                session_destroy();
                 if (session_status() == 1)
                 {
                        $this->b_connecter();
                 }
                
                
        }

        
                 
                  
                   
                        
                 
                
                
                
                
                
        }


        
?>  