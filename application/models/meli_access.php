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
class meli_access extends CI_Model {
  
    function get_token() {
        session_start('teste');
        $this->load->library('Meli');
        $meli = new Meli('1615244148835759', 'IRfmY4x23QZCS80e0d8rKIlaalhEqT4F',$_SESSION['access_token'], $_SESSION['refresh_token']);
        if(isset($_GET['code'])){
        $user = $meli->authorize($_GET['code'], 'http://localhost/whirlpool/index.php/orders');    
        
        $_SESSION['access_token'] = $user['body']->access_token;
	$_SESSION['expires_in'] = time() + $user['body']->expires_in;
	$_SESSION['refresh_token'] = $user['body']->refresh_token;
        }
        
    }

    function get_auth()
    {
        $this->load->library('Meli');
        $meli = new Meli('1615244148835759', 'IRfmY4x23QZCS80e0d8rKIlaalhEqT4F',$_SESSION['access_token'], $_SESSION['refresh_token']);
        echo '<a href="' . $meli->getAuthUrl('http://localhost/whirlpool/index.php/orders') . '">Ingresar a MercadoLibre</a>';
    }
}

