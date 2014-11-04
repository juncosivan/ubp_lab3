<h1>Orders</h1>

<?php 

if (!empty($meli_items["body"]->results))
{
    echo form_open('items/save'); 
     $this->table->set_heading('','imagen', 'titulo', 'Precio');

     foreach ($meli_items["body"]->results as $item)
     {
        $checkbox = form_checkbox("items[]", $item->id) ;
        $title = anchor($item->permalink, $item->title) ;
        $img = img($item->thumbnail);
     
        $this->table->add_row($checkbox,$img, $title, "$".$item->price); 
     }
     echo $this->table->generate(); 
     echo form_submit("guardar_btn", "Guardar!");
     echo form_close();
}
?>