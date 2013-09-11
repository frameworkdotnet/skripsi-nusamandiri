<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if (!$this->session->userdata('user_id'))
		{
			redirect('admin/login');
		}
		$this->load->model('Mpesanan');
	}
	public function index()
	{
		$this->penjualan();
	}
	public function penjualan()
	{
		$data['meta_title'] = 'Laporan Penjualan';
		$data['page'] = 'admin/page-laporan';
		$this->load->view('admin/template', $data);
	}
	public function penjualan_bulan_ini()
	{
		$this->Mpesanan->penjualan_bulan_ini();
	}
	public function penjualan_custom()
	{
		$this->Mpesanan->penjualan_custom();
	}
	public function penjualan_pdf($param)
	{
		$this->Mpesanan->penjualan_pdf($param);
	}
	public function produk()
	{
		$this->load->model('Mproduk');
		$this->Mproduk->laporan();
	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/admin/laporan.php */