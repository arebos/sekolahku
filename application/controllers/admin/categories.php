<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Categories extends CI_Controller {

    var $template = 'admin/template';

    function __construct() {
        parent::__construct();
        $this->general->checkAdmin(); 
        $this->load->model('Categories_model');
        $this->load->model('Posts_model');
        
    }

    function index() {
        $data['categories'] = $this->Categories_model->findAll();
        $data['content'] = 'admin/categories/index';
        $this->load->view($this->template, $data);
    }

    function add() {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Categories_model->create();
            $this->session->set_flashdata('success', 'Category created');
            redirect('admin/categories');
        }
        $data['content'] = 'admin/categories/add';
        $this->load->view($this->template, $data);
    }

    function edit($id = null) {
        if ($id == null) {
            $id = $this->input->post('id');
        }

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Categories_model->update($id);
            $this->session->set_flashdata('success', 'Category edited');
            redirect('admin/categories');
        }
        $data['category'] = $this->Categories_model->findById($id);
        $data['content'] = 'admin/categories/edit';
        $this->load->view($this->template, $data);
    }

    function delete($id = null) {
        if ($id == null) {
            $this->session->set_flashdata('error', 'Invalid category');
            redirect('admin/categories');
        } else {
            $articles = $this->Posts_model->findByCategoryId($id);
            if (!empty($articles)) {
                $this->session->set_flashdata('error', 'This category could not deleted cause have some articles');
            } else {
                $this->Categories_model->destroy($id);
                $this->session->set_flashdata('success', 'Category deleted');
            }
            redirect('admin/categories');
        }
    }

}

?>
