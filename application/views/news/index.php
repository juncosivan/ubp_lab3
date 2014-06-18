<?php 
        echo anchor('news/create/', 'Crear un articulo nuevo');
        
        $this->table->set_heading('id', 'titulo', 'slug', 'Opciones');
        
        foreach ($news_data as $item)
        {
            $btn_ver = anchor('news/view/'.$item["slug"], 'Ver');
            $btn_actualizar = anchor('news/update/'.$item["slug"], 'Actualizar');
            $btn_borrar = anchor('news/delete/'.$item["id"], 'Eliminar', 'onclick="return confirm(\'Seguro?\');"');
            
            $this->table->add_row($item["id"], $item["title"], $item["slug"], $btn_ver." | ".$btn_actualizar." | ". $btn_borrar); 
        }
       
        //imprimo html
        echo $this->table->generate(); 
        
?>