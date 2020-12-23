<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pesanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Customer_model');
	}
	
	public function confirm_pesanan(){
		$dataProduk = json_decode($this->input->post('produk'));
		$idPembeli = json_decode($this->input->post('id_pembeli'));
		$subtotal = json_decode($this->input->post("subtotal"));
		// print_r( $res[0]);
		echo json_encode($dataProduk);
	}
    
	public function pesanan_masuk(){
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));

		$this->load->view('pesanan-masuk-view', $data);
    }
    
    public function pesanan_selesai(){
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));

		$this->load->view('pesanan-selesai-view', $data);
	}
}
