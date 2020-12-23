<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
    }

	public function registrasi(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'nama_lengkap' => $this->input->post('nama'),
			'username'	=> $username,
			'password'	=> $password,
			'email'	=> $this->input->post('email')
		);
        $this->Customer_model->add_data_customer($data);
        $this->session->set_flashdata('message', "<div class='text-center alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Berhasil melakukan registrasi, silahkan login!</strong></div>");
        redirect("Home");
    }
    
    public function login()
    {
        $login_data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );

        $cek = $this->Customer_model->autentikasi($login_data)->num_rows();
        $res = $this->Customer_model->get_by_username($login_data['username']);

        if ($cek > 0) {
            $this->session->set_userdata(array(
                'username' => $login_data['username'],
                'password' => $login_data['password'],
                'nama' => $res['nama_lengkap'],
                'id_customer' => $res['id_customer'],
                'logged_in' => true,
            ));
            $this->session->set_flashdata('message', "<div class='text-center alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Selamat datang ".$res["nama_lengkap"].", Happy Shopping!</strong></div>");
            redirect("Home");
        } else {
            $this->session->set_flashdata('message', "<div class='text-center alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Username atau password tidak sesuai, silahkan cek kembali</strong></div>");
            redirect("Home");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Home');
    }
}
