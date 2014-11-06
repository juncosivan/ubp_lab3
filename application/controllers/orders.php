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

    public function callback()
    {
        header("http://localhost/whirlpool/index.php/orders?code=".$_GET['code']);
    }

    public function index() {
        
        $this->meli_access->get_token();
        $orders=$this->meli_orders->get_orders($_SESSION['access_token']);
        
        if($orders!=null)
        {
        
        if(isset($_SESSION['access_token']))
        {
         header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
         header("Content-type:   application/x-msexcel; charset=utf-8");
         header("Content-Disposition: attachment; filename=Report_".date("Y-m-d").".csv"); 
        }
            foreach($orders->results as $data)
            {
                foreach($data->order_items as $item)
                {
                     echo $data->date_closed.";".
                          $data->id.";".
                          $item->item->id.";".
                          $item->quantity.";".
                          $data->buyer->first_name." ".
                          $data->buyer->last_name.";".
                          $data->buyer->email.";".
                          $data->buyer->phone->area_code." - ".
                          $data->buyer->phone->number.";".
                          $data->buyer->alternative_phone->area_code." - ".
                          $data->buyer->alternative_phone->number.";".
                          $data->shipping->receiver_address->address_line.";".
                          $data->shipping->receiver_address->city->name.";".
                          $data->shipping->receiver_address->state->name.";".
                          $data->shipping->receiver_address->zip_code.
                          " \n ";             
                }
            }
            
        }else
        {
            $this->meli_access->get_auth();
        }
        
        
    }

}
