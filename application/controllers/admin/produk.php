<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Produk extends CI_Controller {
	
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
		$data['meta_title'] = 'Daftar Produk';
		$data['produk'] = $this->Mproduk->get_produk_all();
		$data['page'] = 'admin/page-data-produk';
		$this->load->vars($data);
		$this->load->view('admin/template',$data);
	}
	public function edit($id)
	{		
		$this->output->enable_profiler(true);
		if ($this->input->post())
		{
			$this->Mproduk->edit_produk();
		}
		$data['meta_title'] = 'Edit Produk';
		$data['page'] = 'admin/page-edit-produk';
		$data['produk'] = $this->Mproduk->get_produk($id);
		$data['kategori'] = $this->Mkategori->get_kategori_all();
		$this->load->view('admin/template', $data);
	}
	public function tambah()
	{
		if ($this->input->post())
		{
			$this->Mproduk->tambah_produk();
			if (empty($_FILES['gambar']['name']))
			{
				$data['error_gambar'] =  '<span class="help-inline">Gambar harus diisi</span>';
			}
		}
		$data['meta_title'] = 'Tambah Produk';
		$data['page'] = 'admin/page-tambah-produk';
		$data['kategori'] = $this->Mkategori->get_kategori_all();
		$this->load->view('admin/template',$data);
	}
	public function hapus($id)
	{
		$this->Mproduk->hapus_produk($id);
	}
 }

/* End of file produk.php */
/* Location: ./application/controllers/admin/produk.php */