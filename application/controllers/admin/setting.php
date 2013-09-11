<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id'))
		{
			redirect('admin/login');
		}
		$this->load->library('form_validation');
		$this->load->model('Msetting');
	}
	public function index()
	{
		redirect('/admin/setting/informasi');
	}
	public function informasi($route=null,$id=null)
	{
		switch($route)
		{
			default :
				$data['meta_title'] = 'Setting Informasi Halaman';
				$data['page'] = 'admin/page-data-informasi';
				$data['informasi'] = $this->Msetting->get_informasi_all();
				$this->load->view('admin/template',$data);
				break;
			case 'tambah' :
				if ($this->input->post())
				{
					$this->Msetting->tambah_informasi();
				}
				$data['meta_title'] = 'Tambah Informasi';
				$data['page'] = 'admin/page-tambah-informasi';
				$this->load->view('admin/template',$data);
				break;
			case 'edit' :
				if ($this->input->post())
				{
					$this->Msetting->edit_informasi();
				}
				$data['meta_title'] = 'Tambah Informasi';
				$data['page'] = 'admin/page-edit-informasi';
				$data['informasi'] = $this->Msetting->get_informasi_by_id($id);
				$this->load->view('admin/template',$data);
				break;
			case 'hapus' :
				$this->Msetting->hapus_informasi($id);
				break;
		}
	}
	public function kota($route=null,$id=null)
	{	
		switch($route)
		{
			default :
				$data['meta_title'] = 'Setting Kota dan Ongkos Kirim';
				$data['page'] = 'admin/page-data-kota';
				$data['kota'] = $this->Msetting->get_kota_all();
				$this->load->view('admin/template',$data);
				break;
			case 'tambah' :
				if ($this->input->post())
				{
					$this->Msetting->tambah_kota();
				}
				$data['meta_title'] = 'Tambah Kota';
				$data['page'] = 'admin/page-tambah-kota';
				$data['provinsi'] = $this->Msetting->get_provinsi_all();
				$this->load->view('admin/template',$data);
				break;
			case 'edit' :
				if ($this->input->post())
				{
					$this->Msetting->edit_kota();
				}
				$data['meta_title'] = 'Edit Kota dan Ongkos Kirim';
				$data['page'] = 'admin/page-edit-kota';
				$data['kota'] = $this->Msetting->get_kota($id);
				$data['provinsi'] = $this->Msetting->get_provinsi_all();
				$this->load->view('admin/template',$data);
				break;
			case 'hapus' :
				$this->Msetting->hapus_kota($id);
				break;
		}
	}
	public function provinsi($route=null,$id=null)
	{	
		switch($route)
		{
			default :
				$data['meta_title'] = 'Data Provinsi';
				$data['page'] = 'admin/page-data-provinsi';
				$data['provinsi'] = $this->Msetting->get_provinsi_all();
				$this->load->view('admin/template',$data);
				break;
			case 'tambah' :
				if ($this->input->post())
				{
					$this->Msetting->tambah_provinsi();
				}
				$data['meta_title'] = 'Tambah Provinsi';
				$data['page'] = 'admin/page-tambah-provinsi';
				$this->load->view('admin/template',$data);
				break;
			case 'edit' :			
				if ($this->input->post())
				{
					$this->Msetting->edit_provinsi();
				}
				$data['meta_title'] = 'Edit Provinsi';
				$data['page'] = 'admin/page-edit-provinsi';
				$data['provinsi'] = $this->Msetting->get_provinsi($id);
				$this->load->view('admin/template',$data);
				break;
			case 'hapus' :
				$this->Msetting->hapus_provinsi($id);
				break;
		}
	}
}

/* End of file setting.php */
/* Location: ./application/controllers/admin/setting.php */