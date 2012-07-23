<?php


class Pages extends CI_Controller {

    var $template = 'template';

    function __construct() {
        parent::__construct();
        $this->load->model('Posts_model');
    }

    function home() {
        $data['posts'] = $this->Posts_model->findActive(5);
        $data['page'] = 'pages/home';
        $this->load->view($this->template, $data);
    }

}

?>
