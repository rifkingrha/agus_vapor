<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct(){
        parent::__construct();
        setlocale(LC_ALL, 'id_ID');
		$this->load->model('Customer_model');
		$this->load->model('Transaksi_model');
	}
	
	public function index(){
        $data['transaksi_berlangsung'] = $this->Transaksi_model->get_transaksi_berlangsung($this->session->userdata('id_customer'));
        $data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));
	    $this->load->view('transaksi-berlangsung-view', $data);
    }
    
    public function transaksi_selesai(){
        $data['transaksi_selesai'] = $this->Transaksi_model->get_transaksi_selesai($this->session->userdata('id_customer'));
        $data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));
	    $this->load->view('transaksi-selesai-view', $data);
    }
}
