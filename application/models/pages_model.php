<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pages_model extends CI_Model {

    var $table = 'pages';

    function __construct() {
        parent::__construct();
    }

    function find($limit = null, $offset = null) {
        $this->db->select('pages.*,users.username');
        $this->db->join('users', 'pages.users_id=users.id');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function findById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table, 1);
        return $query->row_array();
    }

    function create() {
        $data = array(
            'title' => $this->input->post('title'),
            'permalink' => url_title($this->input->post('title')),
            'body' => $this->input->post('body'),
            'status' => $this->input->post('status'),
            'users_id' => $this->session->userdata('id')
        );
        $this->db->insert($this->table, $data);
    }

    function update($id) {
        $data = array(
            'title' => $this->input->post('title'),
            'permalink' => url_title($this->input->post('title')),
            'body' => $this->input->post('body'),
            'status' => $this->input->post('status'),
            'users_id' => $this->session->userdata('id')
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

?>
