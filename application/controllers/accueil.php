<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class accueil extends CI_Controller
{
        function __construct()
        {
            parent::__construct();
            $this->load->model('user','',TRUE);
        }
	function index()
	{
            
                if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $data['username'] = $session_data['username'];                 
                    $result = $this->user->user_data($data['username']);
                    $data['name'] = $result['name'];
                    $data['firstname'] = $result['firstname'];
                    
                    
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
                
                // définition des données variables du template
                $data['title'] = 'Open-Note - Acceuil';
                $data['description'] = 'La description de la page pour les moteurs de recherche';
                $data['keywords'] = 'les, mots, clés, de, la, page';
                // TEST Affichage date
                setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
                
                $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

                // on charge la view qui contient le corps de la page
                $data['contents'] = 'accueil';
                
                $data['sidebar'] = 'normal';

                // on charge la page dans le template
                $this->load->view('templates/template', $data);
                
	}

	function logout()
        {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('accueil', 'refresh');
        }
 }
