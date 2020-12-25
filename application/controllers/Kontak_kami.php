<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_kami extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Customer_model');
		$this->load->model('Produk_model');
		$this->load->model('Transaksi_model');
    }

	public function index()
	{
        $data = '';
		$this->load->view('kontak-view',$data);
	}
}
