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
class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('meli_access');
        $this->load->model('meli_orders');
    }

    public function index() {
        $orders=null;
        $this->meli_access->get_token();
        if(isset($_SESSION['access_token']))
        $orders=$this->meli_orders->get_orders($_SESSION['access_token']);
        
        if($orders!=null)
        var_dump(json_encode($orders->results));

    }

}
