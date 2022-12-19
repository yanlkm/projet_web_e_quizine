<?php
/*=============================================================================================================
//Nom du fichier : Actualité
//Auteur : Yan L'Informaticien
//Date de création : Octobre 2022
//Version : V2
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
///Description : Ceci est une page de type controller contenant la classe Actualite 
qui elle contient l'ensemble des fonctions qui affichent la page d'une actualité en passant son id dans l'url',nécéssaires l'utilisation du  site internet.*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Actualite extends CI_Controller {
 
    public function __construct()
        {
            parent::__construct();
            $this->load->model('db_model');
            $this->load->helper('url_helper');
        }
    public function afficher($numero =FALSE)
        {

        if ($numero==FALSE) 
        { 
            $url=base_url(); 
            header("Location:$url");
        }
        else
        {
            $data['titre'] = 'Actualité :';
            $data['actu'] = $this->db_model->get_actualite($numero);
        
            $this->load->view('templates/haut');
            $this->load->view('actualite_afficher',$data);
            $this->load->view('templates/bas');
        
        }

            
        }
    }