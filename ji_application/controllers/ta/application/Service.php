<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(){
        $this->load->view('manager_app_header');
        $this->load->view('manager_app_workshop');
    }
    
    public function openworkshop(){
        
    }
    
}