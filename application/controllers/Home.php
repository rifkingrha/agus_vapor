<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('Produk_model');
		$this->load->model('Kategori_model');
    }

	public function index()
	{
		$data['all_kat'] = $this->Kategori_model->get_all_kategori();
		$data['kategori'] = $this->Kategori_model->get_data_home_kategori();
		// $data['produk'] = array();
		$i = 0;
		foreach ($data['kategori'] as $kat) {
			$data['kategori'][$i]['produk'] = $this->Produk_model->get_data_home_produk($kat['id_kategori']);
			$i++;
		}
		// print_r($data);
		$this->load->view('homepage-store', $data);
	}
}
