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


    public function index()
    {
      $this->meli_access->get_token();
      if(isset($_GET['code']))
      {
        echo '<a href="http://www.grupoberta.com/whirlpool/index.php/orders/obtener?code='.$_GET['code'].'" >Descargar archivo</a>'; 
      }else
      {
          $this->meli_access->get_auth();
      }
    }

    public function obtener() {
        
        $this->meli_access->get_token();
        $resultados=[];
        $off=0;$end!=false;
        $endDate= date('Y/m/d', strtotime(trim("2014-07-01T00:00:00.000-04:00")));
        while($orders->display!="complete"&&$end!=true)
        {
        $orders=$this->meli_orders->get_orders($_SESSION['access_token'], $off);    
            if(count($orders->results)>0)
            {
              foreach($orders->results as $item){
                $orderDate = date('Y/m/d', strtotime(trim($item->date_closed)));         
                if($orderDate >= $endDate)
                {   
                 array_push($resultados, $item);
                }else{
                  $end=true;
                }
              }
            }else $end=true;
        $off=$off+50;//hardcoding para cantidad de movimientos del offset
        }

        if(count($resultados)>0)
        {
        
        if(isset($_SESSION['access_token']))
        {
         header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
         header("Content-type:   application/x-msexcel; charset=utf-8");
         header("Content-Disposition: attachment; filename=Report_".date("Y-m-d").".xls"); 
        }
            foreach($resultados as $data)
            {
                foreach($data->order_items as $item)
                {
                    $date = date('Y/m/d', strtotime(trim($data->date_closed)));                    
                     echo trim($date).";".
                          $data->id.";".
                          $item->item->title.";".
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
                          " \n";             
                }
            }
        }else
        {
            $this->meli_access->get_auth();
        }
    }
}
