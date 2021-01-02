<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Customer_model');
    }

	public function index()
	{
		$data['profile'] = $this->Customer_model->get_by_id($this->session->userdata('id_customer'));

		$this->load->view('profile-view', $data);
	}

	public function updateProfile(){
		$id_customer = $this->input->post('id_customer');
		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_telp' => $this->input->post('no_telp'),
			'email' => $this->input->post('email'),
			'kota_kecamatan1' => $this->input->post('kota_kecamatan1'),
			'kota_kecamatan2' => $this->input->post('kota_kecamatan2'),
			'kode_pos1' => $this->input->post('kode_pos1'),
			'kode_pos2' => $this->input->post('kode_pos2'),
			'alamat1' => $this->input->post('alamat1'),
			'alamat2' => $this->input->post('alamat2')
		);
		$update = $this->Customer_model->update_data_customer($id_customer, $data);
		if($update){
			$this->session->set_flashdata('message', "<div class='text-center alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Berhasil memperbarui profile</div>");
            redirect("Profile");
		}else{
			$this->session->set_flashdata('message', "<div class='text-center alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Gagal memperbarui profile</div>");
            redirect("Profile");
		}
	}

	public function updateProfilePict(){
		$id_customer = $this->input->post('id_customer');
		$config['file_name'] = 'profile-'.$id_customer;
        $config['upload_path'] = './assets/img/profile/';
		$config['max_size']  = '40000';
		$config['allowed_types'] = '*';
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('profile_image')) {
            $upload=$this->upload->data();
            $data = array(
                'profile_image' => $upload['file_name']
            );
			$this->Customer_model->update_data_customer($id_customer,$data);
			$this->session->set_flashdata('message', "<div class='text-center alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Berhasil memperbarui Foto Profile</div>");
            redirect("Profile");
        } else {
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			print_r($return);
		}
	}
}
