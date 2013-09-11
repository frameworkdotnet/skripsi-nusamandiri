<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Madmin extends CI_Model {
	public function __construct() 
	{
		parent::__construct();
	}
	public function login()
	{
		$config = array(
				array(
                    'field'   => 'email', 
                    'label'   => 'Email', 
                    'rules'   => 'required|valid_email'
				),
				array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required'
                )
        );
		$this->form_validation->set_rules($config);
		$this->form_validation->set_message('required', '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Field <b>%s</b> harus harus diisi!!!</div>');
		$this->form_validation->set_message('valid_email', '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Masukkan format email yang benar!!!</div>');
		if ($this->form_validation->run() == TRUE)
		{
			$this->db->select('user_id, nama, email');
			$this->db->where('email',$this->input->post('email'));
			$this->db->where('password', md5($this->input->post('password')));
			$this->db->where('status','1');
			$this->db->limit(1);
			$Q = $this->db->get('administrator');
			if ($Q->num_rows() > 0)
			{
				$row= $Q->row_array();
				$this->session->set_userdata('nama',$row['nama']);
				$this->session->set_userdata('email',$row['email']);
				$this->session->set_userdata('user_id',$row['user_id']);
				redirect('admin/dashboard');
			}
			else 
			{
				$this->session->set_flashdata('msg','<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Perhatian!</strong> Email dan password tidak benar.</div>');
				redirect('admin/login');
			}
		}
	}
	public function get_admin($id)
	{
		$data = array();
		$options = array(
					'user_id' => $id
					);
		$Q = $this->db->get_where('administrator',$options,1);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	public function get_data_admin()
	{
		$data = array();
		$Q = $this->db->get('administrator');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function tambah_admin()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[administrator.email]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password2]');
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
		$this->form_validation->set_message('matches', 'Field <b>%s</b> harus sama dengan field <b>%s</b>!!!');
		$this->form_validation->set_message('required', 'Field <b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('valid_email', 'Masukkan format email yang benar!!!');
		$this->form_validation->set_message('is_unique', 'Email <b>'.$this->input->post('email').'</b> sudah terdaftar, silahkan gunakan email yang lain!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password'))
			);
			if($this->db->insert('administrator',$data))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Berhasil, Profil Anda telah disimpan :).</div>');
				redirect('/admin/data-admin');
			}
			
		}
	}
	public function update_admin()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if($this->input->post('password') != '')
		{	
			$this->form_validation->set_rules('password', 'Password', 'required|matches[password2]');
			$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required');
			$this->form_validation->set_message('matches', '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Field <b>%s</b> harus sama dengan field <b>%s</b>!!!</div>');
		}
		$this->form_validation->set_message('required', '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Field <b>%s</b> harus harus diisi!!!</div>');
		$this->form_validation->set_message('valid_email', '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Masukkan format email yang benar!!!</div>');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email')
					);
			if($this->input->post('password') != '')
			{
				$data['password'] = md5($this->input->post('password'));
			}
			$this->db->where('user_id',$this->input->post('user_id'));
			$this->db->update('administrator',$data);
			$this->session->set_userdata('nama',$this->input->post('nama'));
			$this->session->set_flashdata('msg','<div class="alert alert-info">
				<a class="close" data-dismiss="alert" href="#">x</a>Berhasil, Profil Anda telah disimpan :).</div>');
			redirect('/admin/'.$this->input->post('user_id').'-'.url_title($this->input->post('nama')));
		}
	}
	public function aktif_admin($id)
	{
		$data = array(
				'status' => 1
				);
		$this->db->where('user_id', $id);
		if($this->db->update('administrator',$data))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info">
				<a class="close" data-dismiss="alert" href="#">x</a>Data Berhasil diupdate.</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">x</a>Maaf, kesalahan sistem.</div>');
		}
		redirect('admin/data-admin');
	}
	public function nonaktif_admin($id)
	{
		if($id == 1)
		{	
			$this->session->set_flashdata('msg','<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">x</a>Admin default tidak boleh dinonaktifkan.</div>');
			redirect('admin/data-admin');
		}
		$data = array(
				'status' => 0
				);
		$this->db->where('user_id', $id);
		if($this->db->update('administrator',$data))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info">
				<a class="close" data-dismiss="alert" href="#">x</a>Data Berhasil diupdate.</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">x</a>Maaf, kesalahan sistem.</div>');
		}
		redirect('admin/data-admin');
	}
}

/* End of file madmin.php */
/* Location: ./application/models/madmin.php */