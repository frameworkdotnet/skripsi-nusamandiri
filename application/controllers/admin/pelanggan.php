<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id'))
		{
			redirect('admin/login');
		}
		$this->load->library('form_validation');
		$this->load->model('Mpelanggan');
		$this->load->model('Mpesanan');
		$this->load->model('Mproduk');
	}
	public function index($param = null)
	{		
		if ($param == null)
		{
			$data['meta_title'] = 'Dashboard | Data Pelanggan';
			$data['pelanggan'] = $this->Mpelanggan->get_data_pelanggan();
			$data['page'] = 'admin/page-data-pelanggan';
			$this->load->view('admin/template', $data);
		}
		else
		{
			$id = explode('_',$param);
			$data['meta_title'] = 'Dashboard | Data Pelanggan';
			$data['pelanggan'] = $this->Mpelanggan->get_pelanggan($id[0]);
			$data['pesanan'] = $this->Mpesanan->get_pesanan_pelanggan($id[0]);
			$data['page'] = 'admin/page-detail-pelanggan';
			$this->load->view('admin/template', $data);
		}
	}
	public function aktif($pelanggan_id)
	{
		$this->Mpelanggan->aktifkan_pelanggan($pelanggan_id);
	}
	public function nonaktif($pelanggan_id)
	{
		$this->Mpelanggan->nonaktifkan_pelanggan($pelanggan_id);	
	}
	public function review_produk($route=null,$id=null)
	{	
		switch($route)
		{
			default :
				$data['meta_title'] = 'Dashboard | Data Review Produk Pelanggan';
				$data['review'] = $this->Mproduk->get_review_all();
				$data['page'] = 'admin/page-data-review';
				$this->load->view('admin/template', $data);
				break;
			case 'edit' :
				if ($this->input->post())
				{
					$this->Mproduk->edit_review();
				}
				$data['meta_title'] = 'Dashboard | Edit Data Review Produk Pelanggan';
				$data['review'] = $this->Mproduk->get_review($id);
				$data['page'] = 'admin/page-edit-review';
				$this->load->view('admin/template', $data);
				break;
			case 'hapus' :
				$this->Mproduk->hapus_review($id);
				break;
		}
	}
}

/* End of file pelanggan.php */
/* Location: ./application/controllers/admin/pelanggan.php */