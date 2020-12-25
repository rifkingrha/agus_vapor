<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pesanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Customer_model');
		$this->load->model('Transaksi_model');
	}
	
	public function confirm_pesanan(){
		$dataProduk = json_decode($this->input->post('produk'));
		$idPembeli = json_decode($this->input->post('id_pembeli'));
		$subtotal = json_decode($this->input->post("subtotal"));
		// print_r( $res[0]);
		$dataTransaksi = array(
			'no_transaksi' => 1,
			'subtotal' => $subtotal
		); 
		$id_transaksi = $this->Transaksi_model->insert_transaksi($dataTransaksi);
		for ($i=0; $i < count($dataProduk) ; $i++) { 
			$dataDetailTransaksi = array(
				'id_transaksi' => $id_transaksi,
				'id_produk' => $dataProduk[$i]->_data->id_produk,
				'harga_produk' => $dataProduk[$i]->_amount,
				'kuantitas_produk' => $dataProduk[$i]->_data->quantity,
				'total_harga' => $dataProduk[$i]->_total,
				'id_penjual' => $dataProduk[$i]->_data->id_penjual,
				'id_pembeli' => $idPembeli
			);
			$id_detail_transaksi = $this->Transaksi_model->insert_detail_transaksi($dataDetailTransaksi);
		}
		
		echo json_encode($dataProduk);
	}
    
	public function pesanan_masuk(){
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));

		$this->load->view('pesanan-masuk-view', $data);
	}
	
	public function getPesananMasuk(){
		$id_detail_transaksi = $this->input->post('id_detail_transaksi');
		if ($id_detail_transaksi==null||$id_detail_transaksi==0||$id_detail_transaksi=="") {
			$i=0;
			$data = $this->Transaksi_model->get_pesanan_masuk($this->session->userdata('id_customer'));
			$array = array();
			foreach ($data as $res ) {
				$i++;
				$nomor =array('nomor'=>$i);
				$merged = array_merge($nomor,$res);
				array_push($array, $merged);
			}
			echo json_encode($array);
		} else {
			$data = $this->Transaksi_model->get_detail_transaksi_by_id($id_detail_transaksi);
			echo json_encode($data);
		}
	}

	public function getPesananSelesai(){
		$id_detail_transaksi = $this->input->post('id_detail_transaksi');
		if ($id_detail_transaksi==null||$id_detail_transaksi==0||$id_detail_transaksi=="") {
			$i=0;
			$data = $this->Transaksi_model->get_pesanan_selesai($this->session->userdata('id_customer'));
			$array = array();
			foreach ($data as $res ) {
				$i++;
				$nomor =array('nomor'=>$i);
				$merged = array_merge($nomor,$res);
				array_push($array, $merged);
			}
			echo json_encode($array);
		} else {
			$data = $this->Transaksi_model->get_detail_transaksi_by_id($id_detail_transaksi);
			echo json_encode($data);
		}
	}
    
    public function pesanan_selesai(){
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));

		$this->load->view('pesanan-selesai-view', $data);
	}

	public function updateStatusPesanan(){
		$id_detail_transaksi = $this->input->post('id_detail_transaksi');
		$data = array(
			"status_penyelesaian" => $this->input->post('status_pesanan')
		);
		$this->Transaksi_model->update_detail_transaksi($data, $id_detail_transaksi);
	}
}
