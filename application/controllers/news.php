<?php

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index() { 
        
        $this->load->library('table');
        $this->load->helper('url');
        
        $data['news_data'] = $this->news_model->get_news();
        $data['title'] = 'News archive';

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug) {

        $data['news_item'] = $this->news_model->get_news($slug);
 
        if (empty($data['news_item'])) {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');
        $data['update'] = false;

        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        } else {
            $this->news_model->set_news();
            $this->index();
        }
    }
    public function delete($id = NULL)
    {
        if ($id != null)
        {
            $this->news_model->delete($id);
        }
        
        $this->index();
    }
    
    public function update($slug = NULL)
    {
        if ($slug != NULL) //ToDo: deberia validad si el slug no es null... que exista!
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Update a news item';

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            
            //muestro los datos
            $data['news'] = $this->news_model->get_news($slug);
            $data['update'] = true;
            
            $this->load->view('templates/header', $data);
            $this->load->view('news/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->create();
        }
        
    }

}
