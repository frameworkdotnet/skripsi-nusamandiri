<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Kategori extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id'))
		{
			redirect('admin/login');
		}
		$this->load->library('form_validation');
		$this->load->model('Mproduk');
		$this->load->model('Mkategori');
	}
	public function index()
	{
		$data['meta_title'] = 'Daftar Kategori Produk';
		$data['page'] = 'admin/page-data-kategori';
		$data['kategori'] = $this->Mkategori->get_kategori_all();
		$this->load->view('admin/template',$data);
	}
	public function tambah()
	{
		if ($this->input->post())
		{
			$this->Mkategori->tambah_kategori();
		}
		$data['meta_title'] = 'Tambah Kategori Produk';
		$data['page'] = 'admin/page-tambah-kategori';
		$this->load->view('admin/template',$data);
	}
	public function edit($id)
	{
		if ($this->input->post())
		{
			$this->Mkategori->edit_kategori();
		}
		$data['meta_title'] = 'Edit Kategori Produk';
		$data['page'] = 'admin/page-edit-kategori';
		$data['kategori'] = $this->Mkategori->get_kategori($id);
		$this->load->view('admin/template',$data);
	}
	public function hapus($id)
	{
		$this->Mkategori->hapus_kategori($id);
	}
 }

/* End of file kategori.php */
/* Location: ./application/controllers/admin/kategori.php */