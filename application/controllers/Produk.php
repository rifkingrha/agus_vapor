<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Kategori_model');
        $this->load->model('Produk_model');
    }

	public function index()
	{   
		$config['base_url'] = 'http://localhost/agus-vapor/produk/index';
		$config['total_rows'] = $this->Produk_model->count_all_produk();
		$config['per_page'] = 8;

		$config['full_tag_open'] = '<nav class="text-center"><ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '<nav><ul>';
		
		$config['first_link'] = 'Awal';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Akhir';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = ' <li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['all_kat'] = $this->Kategori_model->get_all_kategori();
		$data['produk'] = $this->Produk_model->get_produk($config['per_page'],$data['start']);
		$this->load->view('produk_view', $data);
    }
    
    public function kategori($id_kategori){
		$config['base_url'] = 'http://localhost/agus-vapor/produk/kategori/'.$id_kategori.'/';
		$config['total_rows'] = $this->Produk_model->count_all_produk_by_category($id_kategori);
		$config['per_page'] = 8;

		$config['full_tag_open'] = '<nav class="text-center"><ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '<nav><ul>';
		
		$config['first_link'] = 'Awal';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Akhir';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = ' <li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['all_kat'] = $this->Kategori_model->get_all_kategori();
		$data['produk'] = $this->Produk_model->get_by_kategori($id_kategori, $config['per_page'], $data['start']);
		$this->load->view('produk_view', $data);
	}
	
	public function search(){
		$param_search=$this->input->post('search');

		$data['all_kat'] = $this->Kategori_model->get_all_kategori();
		$data['produk'] = $this->Produk_model->search_produk($param_search);
		$this->load->view('produk_view', $data);
	}

	public function detail_produk($id_produk){
		$data['produk'] = $this->Produk_model->get_by_id_produk($id_produk);
		$data['all_kat'] = $this->Kategori_model->get_all_kategori();
		$this->load->view('detail_produk',$data);
	}
}
