<?php

class News_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('news'); 
    }

    public function get_news($slug = FALSE) {
        if ($slug === FALSE) {
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }

    public function set_news() {
        $this->load->helper('url');



        if ($this->input->post("update") != true)
        {
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'text' => $this->input->post('text')
            );
            
            return $this->db->insert('news', $data);
        }
        else
        {
           $data = array(
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text')
            );
           
            $this->db->where('slug', $this->input->post('slug'));
            $this->db->update('news', $data); 
        }
    }

}
