<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Customer_model');
		$this->load->model('Produk_model');
        $this->load->model('Kategori_model');
    }

	public function index()
	{
        $data['all_kat'] = $this->Kategori_model->get_all_kategori();
		$this->load->view('checkout-view',$data);
	}
}
