<?php

class Posts extends CI_Controller {

    var $template = 'template';

    function __construct() {
        parent::__construct();
        $this->load->model('Posts_model');
    }

    function detail($permalink = null) {
        if ($permalink == null) {
            redirect('pages/home');
        }
        $data['post'] = $this->Posts_model->findByPermalink($permalink);
        
        $data['page'] = 'posts/detail';
        $this->load->view($this->template, $data);
    }

}

?>
