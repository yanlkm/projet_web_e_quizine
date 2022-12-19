<?php


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
        public function connecter()
        {
                
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
                $this->form_validation->set_rules('mdp', 'mdp', 'required');
        
         if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter');
                $this->load->view('templates/bas');
        }
        else
        {
                $username = $this->input->post('pseudo'); 
                $password = $this->input->post('mdp');

                if($this->db_model->connect_compte($username,$password))
                {
                        $session_data = array('username' => $username );
                        $this->session->set_userdata($session_data); 
                        $this->load->view('templates/haut');
                        $this->load->view('compte_menu');
                        $this->load->view('templates/bas');
                }
                else
                {
                        $this->load->view('templates/haut');
                        $this->load->view('compte_connecter');
                        $this->load->view('templates/bas');
                }
        }
        }

    

        }
?>  