<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Pesanan extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if (!$this->session->userdata('user_id'))
		{
			redirect('admin/login');
		}
		$this->load->model('Mpesanan');
	}
	public function index($id = null)
	{
		if ($id == null)
		{
			$data['meta_title'] = 'Dashboard | Profil Admin';
			$data['pesanan'] = $this->Mpesanan->get_daftar_pesanan();
			$data['page'] = 'admin/page-data-pesanan';
			$this->load->view('admin/template', $data);
		}
		else
		{
			$data['meta_title'] = 'Dashboard | Detail Pesanan';
			$data['page'] = 'admin/page-detail-pesanan';
			$data['pesanan'] = $this->Mpesanan->get_detail_pesanan($id);
			$this->load->view('admin/template',$data);
		}
	}
	public function konfirmasi($pesanan_id=null)
	{
		if ($pesanan_id == null)
		{
			$data['meta_title'] = 'Dashboard | Konfirmasi Pembayaran';
			$data['page'] = 'admin/page-data-pembayaran';
			$data['konfirmasi'] = $this->Mpesanan->get_data_pembayaran();
			$this->load->view('admin/template',$data);
		}
		else
		{
			$data['meta_title'] = 'Dashboard | Konfirmasi Pembayaran';
			$data['page'] = 'admin/page-detail-pembayaran';
			$data['konfirmasi'] = $this->Mpesanan->get_konfirmasi_pembayaran($pesanan_id);
			$data['pesanan'] = $this->Mpesanan->get_detail_pesanan($pesanan_id);
			$this->load->view('admin/template',$data);
		}
	}
	public function update($pesanan_id, $status)
	{
		if (is_null($pesanan_id) || is_null($status))
		{
			redirect('/admin/pesanan');
		}
		$this->Mpesanan->update($pesanan_id, $status);
	}
	public function cek_konfirmasi()
	{
		$this->Mpesanan->cek_konfirmasi();		
	}
}

/* End of file pesanan.php */
/* Location: ./application/controllers/admin/pesanan.php */