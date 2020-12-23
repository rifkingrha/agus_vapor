<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }
    
    public function get_all_kategori(){
        $query = $this->db->get('tabel_kategori');
        return $query->result_array();
    }

	public function get_data_home_kategori()
	{
        $this->db->limit(3);
        $query = $this->db->get('tabel_kategori');
        return $query->result_array();
	}
}