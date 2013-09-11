<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Msetting');
		$this->load->model('Mkategori');
		$this->load->model('Mproduk');
		$this->load->model('Madmin');
		$this->load->model('Mpelanggan');		
		$this->load->model('Mpesanan');		
		$this->load->library('form_validation');
	}
	
	public function index($param=null)
	{
		$this->_cek_status();
		if($param==null)
		{
			$data['meta_title'] = 'Dashboard';
			$data['page'] = 'admin/page-dashboard';
			$data['jumlah_produk'] = $this->Mproduk->get_jumlah_produk();
			$data['jumlah_omset'] = $this->Mpesanan->get_jumlah_omset();
			$data['jumlah_pesanan'] = $this->Mpesanan->get_jumlah_pesanan();
			$data['jumlah_pelanggan'] = $this->Mpelanggan->get_jumlah_pelanggan();
			$data['pesanan'] = $this->Mpesanan->get_daftar_pesanan();
			$data['page'] = 'admin/page-dashboard';
			$this->load->view('admin/template', $data);
		}
		else
		{		
			if($this->input->post())
			{
				$this->Madmin->update_admin();
			}			
			$id = explode('_',$param);
			$data['meta_title'] = 'Dashboard | Profil Admin';
			$data['admin'] = $this->Madmin->get_admin($id[0]);
			$data['disabled'] = ($id[0] !== $this->session->userdata('user_id')) ? 'readonly' : '';
			$data['page'] = 'admin/page-profile';
			$this->load->view('admin/template', $data);
		}
	}
	
	public function data_admin()
	{
		$this->_cek_status();
		$data['meta_title'] = 'Dashboard | Profil Admin';
		$data['admin'] = $this->Madmin->get_data_admin();
		$data['page'] = 'admin/page-data-admin';
		$this->load->view('admin/template', $data);
	}
	
	public function tambah()
	{	
		$this->_cek_status();
		if($this->input->post())
		{
			$this->Madmin->tambah_admin();
		}
		$data['meta_title'] = 'Dashboard | Tambah Admin';
		$data['page'] = 'admin/page-tambah-admin';
		$this->load->view('admin/template', $data);
	}
	
	public function nonaktif($id)
	{
		$this->Madmin->nonaktif_admin($id);
	}
	
	public function aktif($id)
	{
		$this->Madmin->aktif_admin($id);
	}
	
	public function login()
	{	
		if ($this->session->userdata('user_id'))
		{
			redirect('admin/');
		}	
		if ($this->input->post())
		{
			$this->Madmin->login();
			
		}	
		$data['meta_title'] = 'Login in &middot; Administrator';
		$this->load->view('admin/page-login', $data);
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
	
	public function _cek_status()
	{
		if (!$this->session->userdata('user_id'))
		{
			redirect('admin/login');
		}	
	}
	
	public function help()
	{		
		$data['meta_title'] = 'Dashboard | Help';
		$data['page'] = 'admin/page-help';
		$this->load->view('admin/template', $data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */