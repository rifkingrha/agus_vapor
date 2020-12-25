<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->load->model('Customer_model');
		$this->load->model('Produk_model');
		$this->load->model('Transaksi_model');
    }

	public function index()
	{
		if ($this->session->userdata("logged_in")==false) {
			$this->session->set_flashdata('message', "<div class='text-center alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Anda tidak memiliki hak akses</strong></div>");
			redirect("home");
		}
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));
		date_default_timezone_set('Asia/Jakarta');
		$tahun = date('Y', time());

		$bulan_chart = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$data['chart_produk'] = array();
		$data['chart_pesanan_masuk'] = array();
		$data['chart_pesanan_selesai'] = array();
		for ($i=0; $i < count($bulan_chart); $i++) { 
			$data['chart_produk'][] = $this->Produk_model->get_by_id_penjual_perbulan($this->session->userdata('id_customer'), $bulan_chart[$i], $tahun);
			$data['chart_pesanan_masuk'][] = $this->Transaksi_model->get_pm_by_id_penjual_perbulan($this->session->userdata('id_customer'), $bulan_chart[$i], $tahun);
			$data['chart_pesanan_selesai'][] = $this->Transaksi_model->get_ps_by_id_penjual_perbulan($this->session->userdata('id_customer'), $bulan_chart[$i], $tahun);
		}
		$data['countProduk'] = $this->Produk_model->count_by_id_penjual($this->session->userdata('id_customer'));
		$data['countPesananMasuk'] = $this->Transaksi_model->count_pm_by_id_penjual($this->session->userdata('id_customer'));
		$data['countPesananSelesai'] = $this->Transaksi_model->count_ps_by_id_penjual($this->session->userdata('id_customer'));
		$this->load->view('dasboard-view',$data);
	}
}
