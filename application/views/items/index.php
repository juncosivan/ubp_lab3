
<?php 

echo form_open('items/index'); 
echo form_input('search_string');
echo form_submit("buscar_btn", "Buscar!");
echo form_close();
?>


<h1>Items</h1>

<?php 

if (!empty($meli_items["body"]->results))
{
     $this->table->set_heading('imagen', 'titulo', 'Precio');

     foreach ($meli_items["body"]->results as $item)
     {
         
        $title = anchor($item->permalink, $item->title) ;
        $img = img($item->thumbnail);
     
        $this->table->add_row($img, $title, $item->price); 
     }
     echo $this->table->generate(); 
}
?>