
<?php
/*=============================================================================================================
//Nom du fichier : Accueil
//Auteur : Yan L'Informaticien
//Date de création : Octobre 2022
//Version : V2
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
///Description : Ceci est une page de type controller contenant la classe Accueil 
qui elle contient l'ensemble des fonctions qui affiche la page d'acueil, s'occupent de la saisie d'un code de match 
nécéssaires l'utilisation du  site internet.*/


class Accueil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	public function afficher_actu()
	{
        $data['titre']=' LES ACTUALITES DU SITE ';
        $data['news']=$this->db_model->get_all_news();
		$data['error']=0;
		$this->load->view('templates/haut');
        $this->load->view('page_accueil',$data);
        $this->load->view('templates/bas');
	}
	public function afficher()
	{	
		

        $data['titre']=' LES ACTUALITES DU SITE ';
        $data['news']=$this->db_model->get_all_news();
		$data['nb_match']=$this->db_model->get_all_match();	
		$data['error']=0;		
				$this->load->view('templates/haut');
				$this->load->view('menu_visiteur',$data);
				$this->load->view('templates/bas');
			
				
	}
	public function verifier()
    {
       
		$this->form_validation->set_rules('num_match', 'num_match',  ['required', 'alpha_numeric']);
		$code_m=$this->input->post('num_match');
        $data['code_m']=$code_m;

         
		if ($this->form_validation->run() != FALSE)
        {
			
			$requet=$this->db_model->get_match_id($code_m);
			
				$date = date('Y-m-d H:i:s');

			if($requet != NULL)
			{ 
				if($requet[0]['mat_activation']=='A' && $requet[0]['mat_datefin']==NULL )			  
			   {

				   if ($requet[0]['qui_activation']=='A')
				 {
					if($requet[0]['mat_datedebut'] < $date)
					 
					{redirect('match/jouer/'.$code_m); }
					 else 
					{
						$data['titre']=' LES ACTUALITES DU SITE ';
						$data['news']=$this->db_model->get_all_news();
						$data['nb_match']=$this->db_model->get_all_match();	
						$data['error']=4;
						$this->load->view('templates/haut');
						$this->load->view('menu_visiteur',$data);
						$this->load->view('templates/bas');
						//$this->afficher();
					    //echo ' <h1> Match non démarré ! </h1>';
					} 
				 } 

				 else
				{
					$data['titre']=' LES ACTUALITES DU SITE ';
					$data['news']=$this->db_model->get_all_news();
					$data['nb_match']=$this->db_model->get_all_match();	
					$data['error']=3;
					$this->load->view('templates/haut');
					$this->load->view('menu_visiteur',$data);
					$this->load->view('templates/bas');
					//$this->afficher();
					// echo ' <h1> Quiz désactivé ! </h1>';
					 /*redirect('accueil/afficher');*/
				   
				}
			
			}
				else 
				{
					//$this->afficher();
					 //echo ' <h1> Match désactivé ou non démarré! </h1>';
					 $data['titre']=' LES ACTUALITES DU SITE ';
					 $data['news']=$this->db_model->get_all_news();
					 $data['nb_match']=$this->db_model->get_all_match();	
				$data['error']=2;
			   $this->load->view('templates/haut');
			   $this->load->view('menu_visiteur',$data);
			   $this->load->view('templates/bas');
				}
			}
				
			
           else {
			

			$data['titre']=' LES ACTUALITES DU SITE ';
			$data['news']=$this->db_model->get_all_news();
			$data['nb_match']=$this->db_model->get_all_match();	
			$data['error']=1;
			$this->load->view('templates/haut');
			$this->load->view('menu_visiteur',$data);
			$this->load->view('templates/bas');
				//redirect('accueil/afficher');
			  
		   }
		
		
	}
	else{
		$data['titre']=' LES ACTUALITES DU SITE ';
		$data['news']=$this->db_model->get_all_news();
		$data['nb_match']=$this->db_model->get_all_match();	
		$data['error']=5;
		   $this->load->view('templates/haut');
		   $this->load->view('menu_visiteur',$data);
		   $this->load->view('templates/bas');

	}
}
        
		
			


    
}

?>