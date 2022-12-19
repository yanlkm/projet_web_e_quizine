<?php


class Nouveau extends CI_Controller {

	
        public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper('url_helper');
	}
     
    public function connexion()
	{
        
		
		$this->load->view('templates/haut');
        $this->load->view('nouveau');
        $this->load->view('templates/bas');
	}
}
    
   