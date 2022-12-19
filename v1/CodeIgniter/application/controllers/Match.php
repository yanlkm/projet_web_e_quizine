<?php
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

	public function matcher($numero =FALSE)
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
        $this->form_validation->set_rules('num_joueur', 'num_joueur', 'required');

		$jou_pseudo=$this->input->post('num_joueur');

        $req=$this->db_model->check_joueur($num,$jou_pseudo);

       
        if ($this->form_validation->run() != FALSE)
        {
            
        
                    if ($req == NULL ) 
                { 
                    $req1=$this->db_model->insert_joueur($num,$jou_pseudo);
                redirect('match/matcher/'.$num);
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
}
?>
