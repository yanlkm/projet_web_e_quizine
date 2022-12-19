<?php
/*=============================================================================================================
//Nom du fichier : Match
//Auteur : Yan L'Informaticien
//Date de création : Octobre 2022
//Version : V2
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
///Description : Ceci est une page de type controller contenant la classe Match
qui elle contient l'ensemble des fonctions qui permet de rejoindre un match par un joueur ayant choisi son pseudo, jouer au match avoir au moins son score
, nécéssaires l'utilisation du  site internet.*/


defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function matcher($numero)
	{
        
        if ($numero==FALSE) 
        { 
            $url=base_url(); 
            header("Location:$url");
        }
        
        else
        {

            
            $data['titre']=' LE MATCH DE NOTRE QUIZ ';
            $data['ligne']=$this->db_model->get_match_id($numero);
            
            $this->load->view('templates/haut');
            $this->load->view('match_page',$data);
            $this->load->view('templates/bas');  
        }
        
	}
    public function jouer($numero =FALSE)
	{
        $data['code_m']=$numero;
          
          if ($numero==FALSE) 
          { 
              $url=base_url(); 
              header("Location:$url");
          }
          
          else
          {
             $data['error']=0;
              $this->load->view('templates/haut');
              $this->load->view('connexion_joueur',$data);
              $this->load->view('templates/bas');  
          }
          
      }
    public function rejoindre($num)
    {   $data['error']=0;
        $data['code_m']=$num;
        
        $this->form_validation->set_rules('num_joueur', 'num_joueur', ['required','alpha_numeric_spaces']);

		$jou_pseudo=$this->input->post('num_joueur');

        $req=$this->db_model->check_joueur($num,$jou_pseudo);

       
        if ($this->form_validation->run() != FALSE)
        {
            
        
                    if ($req == NULL ) 
                { 
                    $req1=$this->db_model->insert_joueur($num,$jou_pseudo);
                redirect('match/matcher/'.$num.'/'.$jou_pseudo);
                }
                    else 
                {
                
                    $data['error']=6;
                    $this->load->view('templates/haut');
                    $this->load->view('connexion_joueur',$data);
                    $this->load->view('templates/bas');  
                    
                }

        }
        else 
        {
            
                $data['error']=7;
                $this->load->view('templates/haut');
                $this->load->view('connexion_joueur',$data);
                $this->load->view('templates/bas');  
                
        }
   

    }

    public function compter($id = FALSE)
    {
        if ($id==FALSE) 
          { 
              $url=base_url(); 
              header("Location:$url");
          }

          else
          {                              $pseudo = $this->input->post('pseudo');
                                        $id_rep = $this->db_model->get_id_rep_co($id);
                                        $nb_rep = $this->db_model-> get_id_nb_ques_co($id);
                                        

                                       
                                        
                                        
                                        $com=0;
                                        foreach($id_rep as $rep)
                                        {
                                        
                                        
                                            $prout = $this->input->post($rep['que_id']);

                                            $rep = $this->db_model->check_rep_co($prout);
                                            if($rep!=NULL)
                                            {
                                                if($rep->rep_valide == 1)
                                            {
                                                $com++;
                                            }
                                            }
                                            
                                           
  
                                        }
                                        $compte =$com;
                                       /*  if ($total > $nb->nbc) 
                                        {
                                            
                                            
                                                $compte = $com - $pte;
                                                
                                                if($compte < 0)
                                                {
                                                    $compte = -1*$compte;
                                                }
                                            
                                            
                                        }*/ /*
   
                                if (($pte + $com)==$nb->nbc)
                                    {
                                            $compte = $com;


                                    }
                                 if (($com==0) || ($pte==5))
                                        {
                                            $compte=0;

                                        }*/

                                        $div = ($compte / $nb_rep->nbc)*100;
                                        $val =intval($div);
                                        

                                        $req = $this->db_model->up_score($val,$pseudo);
                                       

                                        if ($req  == TRUE)
                                        {
                                            $data['score']=$val;
                                            $data['info']=$this->db_model->get_quiz_id($id);
                                            $this->load->view('templates/haut');
                                            $this->load->view('score_joueur',$data);
                                            $this->load->view('templates/bas');  
                                        
                                            
                                        }
                        else 
                        {
                            redirect('accueil/afficher');
                        }

          }
          
       
        

    }


}
?>
