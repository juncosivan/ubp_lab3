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
class Items  extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('meli_items');
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('table');
    }
    
    public function index()
    {
        $data['title'] = 'Mini buscador';
        $search_string = $this->input->post('search_string');
        
        if ($search_string != NULL)
        {
            $data["meli_items"] = $this->meli_items->search("MLA", $search_string);
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('items/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function save()
    {
        die(var_dump($this->input->post('items')));
    }
    
}
