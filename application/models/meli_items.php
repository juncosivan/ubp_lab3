<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of meli_items
 *
 * @author usuario
 */
class meli_items extends CI_Model{
    
    function get_sites()
    {
        $this->load->library('Meli');
        
        return $this->meli->get("/sites/");
    }
    
    function search($site_id, $search_string)
    {
        $this->load->library('Meli');
        $params = array('q' => $search_string);
        
        $params["q"] = urlencode($search_string);
        
        return $this->meli->get("/sites/MLA/search", $params);
    }
}
