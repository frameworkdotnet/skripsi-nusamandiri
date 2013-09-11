<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Informasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Minformasi');
		$this->load->model('Mkategori');
		$this->load->model('Mproduk');
	}
	public function index($slug)
	{
		$slug = str_replace('_', '-', $slug);
		$data['informasi'] = $this->Minformasi->informasi($slug);
		$data['meta_title'] = 'Toko Online | '.$data['informasi']['nama'];
		$data['meta_description'] = 'Toko online termurah, kategori ini adalah salah satunya';
		$data['page'] = 'page_informasi';
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
 }
 
 /* End of file informasi.php */
/* Location: ./application/controllers/informasi.php */