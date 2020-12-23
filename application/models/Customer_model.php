<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }
    
	public function add_data_customer($data)
	{
        $this->db->insert('tabel_customer', $data);
    }
    
    public function autentikasi($data)
    {
        return $this->db->get_where('tabel_customer', $data);
    }

    public function get_by_username($username)
    {
        $this->db->select('*');
        $this->db->from('tabel_customer');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tabel_customer', array('id_customer' => $id))->row_array();
    }

    public function update_data_customer($id,$data){
		$this->db->where('id_customer', $id);
		return $this->db->update('tabel_customer', $data);
	}
}