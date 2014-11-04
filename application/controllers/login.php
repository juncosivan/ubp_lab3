<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of meli
 *
 * @author usuario
 */
class Login  extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('meli_access');
    }
        public function index()
    {
            $this->meli_access->get_token();
            echo $_SESSION['access_token'];
        }

}