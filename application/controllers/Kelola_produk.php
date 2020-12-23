<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_produk extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Customer_model');
        $this->load->model('Kategori_model');
		$this->load->model('Produk_model');
    }

	public function index()
	{
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));
		$data['produk'] = $this->Produk_model->get_by_id_penjual($this->session->userdata('id_customer'));
		$data['all_kat'] = $this->Kategori_model->get_all_kategori();

		$this->load->view('kelola-produk-view', $data);
	}

	public function getDataProduk(){
		$id_produk = $this->input->post('id_produk');
		if ($id_produk==null||$id_produk==0||$id_produk=="") {
			$i=0;
			$data = $this->Produk_model->get_by_id_penjual($this->session->userdata('id_customer'));
			$array = array();
			foreach ($data as $res ) {
				$i++;
				$nomor =array('nomor'=>$i);
				$merged = array_merge($nomor,$res);
				array_push($array, $merged);
			}
			echo json_encode($array);
		} else {
			$data = $this->Produk_model->get_by_id_produk($id_produk);
			echo json_encode($data);
		}
	}
	
	public function insertDataProduk(){
		$data = array(
			"nama_produk" => $this->input->post('nama_produk'),
			"harga" => $this->input->post('harga'),
			"keterangan" => $this->input->post('keterangan'),
			"id_kategori" => $this->input->post('kategori'),
			"bekas_baru" => $this->input->post('bekas_baru'),
			"id_penjual" => $this->session->userdata('id_customer'),
		);
		$id_produk = $this->Produk_model->insert_data_produk($data);

		$config['file_name'] = 'produk-'.$id_produk;
        $config['upload_path'] = './assets/img/produk/';
		$config['max_size']  = '40000';
		$config['allowed_types'] = '*';
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('image_produk')) {
            $upload=$this->upload->data();
            $data = array(
                'image_produk' => $upload['file_name']
            );
			$this->Produk_model->update_data_produk($id_produk,$data);
        } else {
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			print_r($return);
		}
	}

	public function updateDataProduk(){
		$id_produk = $this->input->post('id_produk');
		$data = array(
			"nama_produk" => $this->input->post('nama_produk'),
			"harga" => $this->input->post('harga'),
			"keterangan" => $this->input->post('keterangan'),
			"id_kategori" => $this->input->post('kategori'),
			"bekas_baru" => $this->input->post('bekas_baru'),
			"id_penjual" => $this->session->userdata('id_customer'),
		);
		$this->Produk_model->update_data_produk($id_produk, $data);

		$config['file_name'] = 'produk-'.$id_produk;
        $config['upload_path'] = './assets/img/produk/';
		$config['max_size']  = '40000';
		$config['allowed_types'] = '*';
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('image_produk')) {
            $upload=$this->upload->data();
            $data = array(
                'image_produk' => $upload['file_name']
            );
			$this->Produk_model->update_data_produk($id_produk,$data);
        } else {
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			print_r($return);
		}
	}

	public function deleteDataProduk(){
		$id_produk = $this->input->post('id_produk');
		$this->Produk_model->delete_data_produk($id_produk);
	}
}
