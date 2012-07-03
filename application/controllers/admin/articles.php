<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Articles extends CI_Controller {

    var $template = 'admin/admin_template';
    var $imagePath = './public/media/articles/';
    var $url = 'public/media/articles/';

    function __construct() {
        parent::__construct();
        $this->userlib->cekAdminLogin();
        $this->load->model('Article');
        $this->load->model('Category');
        $this->load->model('Image');
    }

    function index($page = null) {

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Article->countAll();
        $config['per_page'] = $this->Setting->findByKey('pagination_limit');
        $config['base_url'] = base_url() . 'admin/articles/index/';

        if ($this->input->get('q')):
            $q = $this->input->get('q');
            $data['articles'] = $this->Article->findAll($config['per_page'], $this->uri->segment(4), $q);
            if(empty($data['articles'])){
				$this->session->set_flashdata('error', 'Data tidak ditemukan');
				redirect('admin/articles/index');
			}
            $config['total_rows'] = count($data['articles']);
        else:
            $data['articles'] = $this->Article->findAll($config['per_page'], $this->uri->segment(4));
        endif;
        $this->pagination->initialize($config);
        $data['status'] = $this->Article->status;
        $data['pagination'] = $this->pagination->create_links();
        $data['content'] = 'admin/articles/index';
        $this->load->view($this->template, $data);
    }

    function add() {

        $this->form_validation->set_rules('title', 'judul', 'required|xss_clean');
        $this->form_validation->set_rules('body', 'isi', 'required|xss_clean');
        $this->form_validation->set_rules('category_id', 'kategori', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'status', 'required|xss_clean');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Article->create();
            $article_id = $this->db->insert_id();
            if ($_FILES['image']['error'] != 4) {
                if ($this->general->isExistFile($this->url . $_FILES['image']['name'])) {
                    unlink($this->url . $_FILES['image']['name']);
                }
                $config['upload_path'] = $this->imagePath;
                $config['allowed_types'] = $this->Setting->findByKey('image_type');
                $config['max_size'] = $this->Setting->findByKey('image_max_size');


                $this->load->library('upload', $config);


                if ($this->upload->do_upload("image")) {
                    $image = $this->upload->data();
                    $url = $this->url . $image['orig_name'];
                    if (($image['image_width'] > $this->Image->maxWidth) || ($image['image_height'] > $this->Image->maxHeight)) {
                        $this->load->library('SimpleImage');
                        $this->simpleimage->load($url);
                        $this->simpleimage->resizeToWidth($this->Image->maxWidth);
                        $this->simpleimage->resizeToHeight($this->Image->maxHeight);
                        $this->simpleimage->save($url);
                    }
                    $description = $this->input->post('title');
                    $this->Image->saveImage($url, 'articles', $article_id, $description);
                }
            }
            $this->session->set_flashdata('success', 'Artikel berhasil dibuat');
            redirect('admin/articles');
        }
        $data['categories'] = $this->Category->findList();
        $data['status'] = $this->Article->status;
        $data['content'] = 'admin/articles/add';
        $this->load->view($this->template, $data);
    }

    function edit($id = null) {

        if ($id == null) {
            $id = $this->input->post('id');
        }
        $this->form_validation->set_rules('title', 'judul', 'required|xss_clean');
        $this->form_validation->set_rules('body', 'isi', 'required|xss_clean');
        $this->form_validation->set_rules('category_id', 'kategori', 'required|xss_clean');
        $this->form_validation->set_rules('status', 'status', 'required|xss_clean');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Article->update($id);
            $article_id = $id;

            if ($_FILES['image']['error'] != 4) {
                if ($this->general->isExistFile($this->url . $_FILES['image']['name'])) {
                    unlink($this->url . $_FILES['image']['name']);
                }
                $config['upload_path'] = $this->imagePath;
                $config['allowed_types'] = $this->Setting->findByKey('image_type');
                $config['max_size'] = $this->Setting->findByKey('image_max_size');

                $this->load->library('upload', $config);


                if ($this->upload->do_upload("image")) {
                    $image = $this->upload->data();
                    $url = $this->url . $image['orig_name'];
                    $this->load->library('SimpleImage');
                    if (($image['image_width'] > $this->Image->maxWidth) || ($image['image_height'] > $this->Image->maxHeight)) {
                        $this->load->library('SimpleImage');
                        $this->simpleimage->load($url);
                        $this->simpleimage->resizeToWidth($this->Image->maxWidth);
                        $this->simpleimage->resizeToHeight($this->Image->maxHeight);
                        $this->simpleimage->save($url);
                    }
                    $description = $this->input->post('title');
                    if ($this->Image->isExist('articles', $article_id) == TRUE) {
                        $this->Image->updateImage($url, 'articles', $article_id, $description);
                    } else {
                        $this->Image->saveImage($url, 'articles', $article_id, $description);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Artikel berhasil diedit');
            redirect('admin/articles');
        }

        $data['article'] = $this->Article->findById($id);
        $data['image'] = $this->Image->findSingle('articles', $id);
        $data['categories'] = $this->Category->findList();
        $data['status'] = $this->Article->status;
        $data['content'] = 'admin/articles/edit';
        $this->load->view($this->template, $data);
    }

    function delete($id = null) {
        if ($id == null) {
            $this->session->set_flashdata('error', 'Artikel tidak dapat dihapus');
            redirect('admin/articles');
        } else {
            $image = $this->Image->findSingle('articles', $id);
            if ($this->general->isExistFile($image['url'])) {
                unlink($image['url']);
            }
            $this->Article->destroy($id);
            $this->session->set_flashdata('success', 'Artikel berhasil dihapus');
            redirect('admin/articles');
        }
    }

}

?>
