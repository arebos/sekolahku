<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Categories_model extends CI_Model {

    var $table = 'categories';

    function __construct() {
        parent::__construct();
    }

    function findAll($limit =null, $offset = null) {
        $this->db->select('*');
        $this->db->limit($limit, $offset);
        $this->db->order_by('name','ASC');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function findList() {

        $query = $this->db->get($this->table);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['id']] = $row['name'];
            }
        }
        return $data;
    }

    function findById($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function findByPermalink($permalink) {
        $this->db->select('*');
        $this->db->where('permalink', $permalink);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function create() {
        $data = array(
            'name' => $this->input->post('name'),
            'permalink' => url_title($this->input->post('name')),
            'description' => $this->input->post('description')
        );

        $this->db->insert($this->table, $data);
    }

    function update($id) {

        $data = array(
            'name' => $this->input->post('name'),
            'permalink' => url_title($this->input->post('name')),
            'description' => $this->input->post('description')
        );

        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function destroy($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

?>
