<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }
    
    public function insert_transaksi($data){
        $this->db->insert('tabel_transaksi',$data);
		return $this->db->insert_id();
    }

    public function insert_detail_transaksi($data){
        $this->db->insert('tabel_detail_transaksi',$data);
		return $this->db->insert_id();
    }

    public function update_detail_transaksi($data, $id_detail_transaksi){
        $this->db->where('id_detail_transaksi', $id_detail_transaksi);
        return $this->db->update('tabel_detail_transaksi', $data);
    }

    public function get_pesanan_masuk($id_penjual){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual, c.no_telp as no_telp_pembeli, d.no_telp as no_telp_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where('b.id_penjual', $id_penjual);
        $this->db->where('(b.status_penyelesaian=0 OR b.status_penyelesaian=1)', NULL, FALSE);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_detail_transaksi_by_id($id_detail_transaksi){
        $query = $this->db->get_where('tabel_detail_transaksi', array('id_detail_transaksi'=>$id_detail_transaksi));
        return $query->row_array();
    }

    public function get_pesanan_selesai($id_penjual){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual, c.no_telp as no_telp_pembeli, d.no_telp as no_telp_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where('b.id_penjual', $id_penjual);
        $this->db->where('(b.status_penyelesaian=2 OR b.status_penyelesaian=3)', NULL, FALSE);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_pm_by_id_penjual($id_penjual){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where('b.id_penjual', $id_penjual);
        $this->db->where('(b.status_penyelesaian=0 OR b.status_penyelesaian=1)', NULL, FALSE);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_ps_by_id_penjual($id_penjual){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where('b.id_penjual', $id_penjual);
        $this->db->where('(b.status_penyelesaian=2 OR b.status_penyelesaian=3)', NULL, FALSE);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_pm_by_id_penjual_perbulan($id_penjual, $bulan, $tahun){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where(array('b.id_penjual'=>$id_penjual, 'MONTH(a.tanggal_order)' => $bulan, 'YEAR(a.tanggal_order)' => $tahun));
        $this->db->where('(b.status_penyelesaian=0 OR b.status_penyelesaian=1)', NULL, FALSE);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_ps_by_id_penjual_perbulan($id_penjual, $bulan, $tahun){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where(array('b.id_penjual'=>$id_penjual, 'MONTH(b.tanggal_selesai)' => $bulan, 'YEAR(b.tanggal_selesai)' => $tahun));
        $this->db->where('(b.status_penyelesaian=2 OR b.status_penyelesaian=3)', NULL, FALSE);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_transaksi_berlangsung($id_pembeli){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual, c.no_telp as no_telp_pembeli, d.no_telp as no_telp_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where('b.id_pembeli', $id_pembeli);
        $this->db->where('(b.status_penyelesaian=0 OR b.status_penyelesaian=1)', NULL, FALSE);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transaksi_selesai($id_pembeli){
        $this->db->order_by('a.id_transaksi', 'desc');
        $this->db->select('*, c.nama_lengkap as nama_pembeli, d.nama_lengkap as nama_penjual, c.no_telp as no_telp_pembeli, d.no_telp as no_telp_penjual');
        $this->db->from('tabel_transaksi a');
        $this->db->join('tabel_detail_transaksi b', 'a.id_transaksi = b.id_transaksi', 'left');
        $this->db->join('tabel_customer c', 'b.id_pembeli = c.id_customer', 'left');
        $this->db->join('tabel_customer d', 'b.id_penjual = d.id_customer', 'left');
        $this->db->join('tabel_produk e', 'b.id_produk = e.id_produk', 'left');
        $this->db->where('b.id_pembeli', $id_pembeli);
        $this->db->where('(b.status_penyelesaian=2 OR b.status_penyelesaian=3)', NULL, FALSE);

        $query = $this->db->get();
        return $query->result_array();
    }
}