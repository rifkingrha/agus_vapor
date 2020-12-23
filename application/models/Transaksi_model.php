<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }
    
    public function insert_transaksi(){
        $this->db->insert('tabel_transaksi',$data);
		return $this->db->insert_id();
    }

    public function insert_detail_transaksi(){
        $this->db->insert('tabel_detail_transaksi',$data);
		return $this->db->insert_id();
    }
}