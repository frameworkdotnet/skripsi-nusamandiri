<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mkategori');
		$this->load->helper('text');
	}
	public function index($params = null)
	{
		if ($params == null)
		{
			redirect('/');
		}
		else
		{
			$param = explode('-',$params);
			$data['produk_kategori'] = $this->Mproduk->produk_kategori($param[0]);
			$data['kategori_detail'] = $this->Mkategori->get_kategori($param[0]);
			$data['produk_feature'] = $this->Mproduk->produk_feature();
			$data['meta_title'] = 'Toko Online | '.$data['kategori_detail']['nama'];
			$data['meta_description'] = 'Toko online termurah, kategori ini adalah salah satunya';
			$data['page'] = 'page_kategori';
			$data['kategori'] = $this->Mkategori->kategori_menu();
			$this->load->view('template',$data);
		}
	}
 }
 
/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */