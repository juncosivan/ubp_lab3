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
class meli_orders extends CI_Model{
    

    function get_orders($access_token,$offset)
    {
        if(isset($access_token)&& $access_token!=null ){
        $this->load->library('Meli');
        $user=$this->meli->get("/users/me?access_token=".$access_token);
        $cust_id=$user['body']->id;   
        $orders=$this->meli->get("/orders/search?seller=".$cust_id."&offset=".$offset."&sort=date_desc&access_token=".$access_token);
             return $orders['body'];
        }
                return NULL;
    }
    
    function get_shipping($access_token, $shipping_id, $seller)
    {
        if(isset($access_token)&& $access_token!=null ){
        $this->load->library('Meli');
        $shipping=$this->meli->get("/shipments/".$shipping_id."?access_token=".$access_token."&caller.id=".$seller);
             return $shipping['body'];
        }
            return NULL;
    }
    
    function get_payments($access_token, $collection_id)
    {
        if(isset($access_token)&& $access_token!=null ){
        $this->load->library('Meli');
        $collection=$this->meli->get("/collections/".$collection_id."?access_token=".$access_token);
             return $collection['body'];
        }
             return NULL;
    }
    
}
