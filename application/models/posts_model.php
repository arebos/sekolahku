<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Posts_model extends CI_Model {

    var $table = 'posts';
    var $status = array(
        0 => 'draft',
        1 => 'published'
    );

    function __construct() {
        parent::__construct();
    }

    function findAll($limit = null, $offset = null, $q = null) {
        $this->db->select('posts.*,categories.name, users.username');
        $this->db->join('categories', 'categories.id = posts.categories_id');
        $this->db->join('users', 'users.id = posts.users_id');
        if ($q != null) {
            $this->db->like('title', $q);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function findActive($limit = null, $offset = null, $q = null) {
        $this->db->select('posts.*,categories.name, users.username');
        $this->db->join('categories', 'categories.id = posts.categories_id');
        $this->db->join('users', 'users.id = posts.users_id');
        if ($q != null) {
            $this->db->like('posts.title', $q);
            $this->db->or_like('posts.body', $q);
        }
        $this->db->limit($limit, $offset);
        $this->db->where('posts.status', 1);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function findByCategoryId($categories_id, $limit = null, $offset = null) {
        $this->db->select('posts.*,categories.name, users.username');
        $this->db->join('categories', 'categories.id = posts.categories_id');
        $this->db->join('users', 'users.id = posts.users_id');
        $this->db->limit($limit, $offset);
        $this->db->where('posts.status', 1);
        $this->db->where('posts.categories_id', $categories_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    function findOthersInCategory($categories_id, $article_id, $limit = null, $offset = null) {
        $this->db->select('posts.*,categories.name, users.username');
        $this->db->join('categories', 'categories.id = posts.categories_id');
        $this->db->join('users', 'users.id = posts.users_id');
        $this->db->where('posts.categories_id', $categories_id);
        $this->db->where('posts.id !=', $article_id);
        $this->db->limit($limit, $offset);
        $this->db->where('posts.status', 1);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function findById($id) {
        $this->db->select('posts.*');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function findByPermalink($permalink) {
        $this->db->select('posts.*');
        $this->db->where('permalink', $permalink);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function countAll() {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    function create($params = array()) {
        if (empty($params)) {
            $data = array(
                'title' => $this->input->post('title'),
                'permalink' => url_title($this->input->post('title')),
                'body' => $this->input->post('body'),
                'categories_id' => $this->input->post('categories_id'),
                'status' => $this->input->post('status'),
                'users_id' => $this->session->userdata('id'),
                'created' => date("Y-m-d H:i:s")
            );
            $this->db->insert($this->table, $data);
        } else {
            $this->db->insert($this->table, $params);
        }
    }

    function update($id, $params) {
        if (empty($params)) {
            $data = array(
                'title' => $this->input->post('title'),
                'permalink' => url_title($this->input->post('title')),
                'body' => $this->input->post('body'),
                'categories_id' => $this->input->post('categories_id'),
                'status' => $this->input->post('status'),
                'users_id' => $this->session->userdata('id'),
                'modified' => date("Y-m-d H:i:s")
            );

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update($this->table, $params);
        }
    }

    function destroy($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

?>
