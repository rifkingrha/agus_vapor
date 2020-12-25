<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	public function __construct(){
		parent::__construct();
        }
    
    public function get_all_produk(){
        $this->db->order_by('id_produk','desc');
        $query = $this->db->get('tabel_produk');
        return $query->result_array();
	}

    public function get_produk($limit,$start){
        $this->db->order_by('id_produk','desc');
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->join('tabel_customer c', 'a.id_penjual=c.id_customer', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_by_kategori($id_kategori,$limit,$start){
        $this->db->order_by('id_produk','desc');
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->join('tabel_customer c', 'a.id_penjual=c.id_customer', 'left');
        $this->db->limit($limit, $start);
        $this->db->where('a.id_kategori', $id_kategori);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_id_penjual($id_penjual){
        $this->db->order_by('a.id_produk','desc');
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->where('id_penjual', $id_penjual);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_id_penjual_perbulan($id_penjual, $bulan, $tahun){
        $this->db->order_by('a.id_produk','desc');
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->where(array('a.id_penjual'=>$id_penjual, 'MONTH(a.created_date)' => $bulan, 'YEAR(a.created_date)' => $tahun));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_by_id_penjual($id_penjual){
        $this->db->order_by('a.id_produk','desc');
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->where('id_penjual', $id_penjual);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_by_id_produk($id_produk){
        $this->db->order_by('a.id_produk','desc');
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->join('tabel_customer c', 'a.id_penjual=c.id_customer', 'left');
        $this->db->where('a.id_produk', $id_produk);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function search_produk($param_search){
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->join('tabel_customer c', 'a.id_penjual=c.id_customer', 'left');
        $this->db->like('a.nama_produk', $param_search);
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function search_produk_pagination($param_search,$limit,$start){
    //     $this->db->like('nama_produk', $param_search);
    //     $query = $this->db->get('tabel_produk', $limit, $start);
    //     return $query->result_array();
    // }

    public function count_all_produk(){
        $query = $this->db->get('tabel_produk');
        return $query->num_rows();
    }

    public function count_all_produk_by_category($id_kategori){
        $query = $this->db->get_where('tabel_produk', array('id_kategori'=>$id_kategori));
        return $query->num_rows();
    }

    // public function count_produk_by_search($param_search){
    //     $this->db->like('nama_produk', $param_search);
    //     $query = $this->db->get('tabel_produk');
    //     return $query->num_rows();
    // }

	public function get_data_home_produk($id_category){
        $this->db->order_by('a.id_produk', 'desc');
        $this->db->limit(3);
        $this->db->select('*');
        $this->db->from('tabel_produk a');
        $this->db->join('tabel_kategori b', 'a.id_kategori=b.id_kategori', 'left');
        $this->db->join('tabel_customer c', 'a.id_penjual=c.id_customer', 'left');
        $this->db->where('a.id_kategori', $id_category);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function insert_data_produk($data){
		$this->db->insert('tabel_produk',$data);
		return $this->db->insert_id();
    }
    
    public function update_data_produk($id_produk, $data){
        $this->db->where('id_produk', $id_produk);
		return $this->db->update('tabel_produk',$data);
    }
    
    public function delete_data_produk($id_produk){
        $this->db->where('id_produk', $id_produk);
		$this->db->delete('tabel_produk');
    }
}