<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pages extends CI_Controller {

    var $template = 'admin/template';
    var $status = array(
        0 => 'draft',
        1 => 'published'
    );

    function __construct() {
        parent::__construct();

        $this->general->checkAdmin(); // Pengecekan Hak Akses Admin, jika bukan Admin maka akan diredirect ke form Login

        $this->load->model('Pages_model');
    }

    function index() {
        $data['pages'] = $this->Pages_model->find();
        $data['content'] = 'admin/pages/index';
        $data['status'] = $this->status;
        $this->load->view($this->template, $data);
    }

    function add() {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Pages_model->create();
            $this->session->set_flashdata('success', 'Add success');
            redirect('admin/pages/index');
        }
        $data['status'] = $this->status;
        $data['content'] = 'admin/pages/add';
        $this->load->view($this->template, $data);
    }

    function edit($id = null) {
        if ($id == null) {
            $id = $this->input->post('id');
        }
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Pages_model->update($id);
            $this->session->set_flashdata('success', 'Edit success');
            redirect('admin/pages/index');
        }
        $data['page'] = $this->Pages_model->findById($id);

        $data['status'] = $this->status;
        $data['content'] = 'admin/pages/edit';
        $this->load->view($this->template, $data);
    }

    function delete($id = null) {
        if ($id == null) {
            $this->session->set_flashdata('error', 'Error delete');
        } else {
            $this->Pages_model->delete($id);
            $this->session->set_flashdata('success', 'Delete success');
        }
        redirect('admin/pages/index');
    }

}

?>
