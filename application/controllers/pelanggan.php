<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mkategori');
		$this->load->model('Mproduk');
		$this->load->model('Mpesanan');
		$this->load->model('Mpelanggan');
		$CI = & get_instance();
		$CI->config->load("facebook",TRUE);
		$config = $CI->config->item('facebook');
		$this->load->library('Facebook', $config);
		$this->load->library('form_validation');
	}
	public function index($param=NULL)
	{
		if (!$this->session->userdata('pelanggan_id'))
		{
			redirect('pelanggan/login');
		}		
		if ($param != NULL)
		{	
			if($this->input->post('pelanggan_id')!='')
			{
				$this->Mpelanggan->simpan_profil();
			}
			
			$id = explode('_',$param);
			$data['meta_title'] = 'StarKonveksi.com | Profil Pelanggan';
			$data['meta_description'] = 'Profil pelanggan StarKonveksi.com';
			$data['page'] = 'page_pelanggan_profil';
			$data['kategori'] = $this->Mkategori->kategori_menu();
			$data['pelanggan'] = $this->Mpelanggan->get_pelanggan($id[0]);
			$data['provinsi'] = $this->Mpelanggan->get_daftar_provinsi();
			$data['kota'] = $this->get_daftar_kota($data['pelanggan']['provinsi_id']);
			$this->load->view('template',$data);
		}
		else
		{
			$data['meta_title'] = 'StarKonveksi.com | Dashboard Pelanggan';
			$data['meta_description'] = 'Dashboard pelanggan StarKonveksi.com';
			$data['page'] = 'page_pelanggan';
			$data['kategori'] = $this->Mkategori->kategori_menu();
			$this->load->view('template',$data);
		}
	}
	public function login()
	{
		if ($this->session->userdata('pelanggan_id'))
		{
			redirect('pelanggan/');
		}		
		parse_str($_SERVER['QUERY_STRING'],$_GET);		
		if($this->input->post())
		{
			$this->Mpelanggan->cek_login();
		}
		$data['redirect'] = isset($_GET['redirect']) && $_GET['redirect'] == 'checkout' ? '?redirect=checkout' : '';
		$data['meta_title'] = 'StarKonveksi.com | Login Pelanggan';
		$data['meta_description'] = 'Login pelanggan StarKonveksi.com untuk mengkonfirmasi pesanan, melihat transaksi sebelumnya.';
		$data['page'] = 'page_login';
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
	public function logout()
	{
		$this->session->unset_userdata('pelanggan_id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('nama');
		$this->session->set_flashdata('msg','<div id="notification" style="display: block;"><div class="success" style="">Berhasil, Anda telah keluar dari sistem. Sampai bertemu lagi :).<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
		try
		{
			$this->facebook->destroySession();
			redirect('/');
		}
		catch (FacebookRestClientException $e)
		{
			//you'll want to catch this
			//it fails all the time
			//658kjbks7tekh
		}
	}
	public function daftar()
	{
		if($this->input->post())
		{
			$this->Mpelanggan->daftar();
		}
		$data['meta_title'] = 'Toko online | Menjadi Pelanggan';
		$data['meta_description'] = 'Toko online murah berkualitas';
		$data['page'] = 'page_daftar';
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
	public function login_facebook()
    {
		$this->Mpelanggan->facebook_login();
    }
	public function konfirmasi($key)
	{
		$this->Mpelanggan->konfirmasi($key);
	}
	public function pesanan($action=null,$id=null)
	{
		switch($action)
		{
			case 'konfirmasi' :
				$this->load->library('form_validation');
				if ($this->input->post('pesanan_id'))
				{
					$this->Mpelanggan->konfirmasi_pesanan();
				}
				$data['meta_title'] = 'StarKonveksi.com | Konfirmasi Pesanan Pelanggan';
				$data['meta_description'] = 'Data pesanan pelanggan StarKonveksi.com';
				$data['page'] = 'page_pelanggan_pesanan_konfirmasi';
				$data['kategori'] = $this->Mkategori->kategori_menu();
				$data['pesanan'] = $this->Mpesanan->get_detail_pesanan($id);
				$this->load->view('template',$data);
				break;
			case 'detail' :				
				$data['meta_title'] = 'StarKonveksi.com | Detail Pesanan Pelanggan';
				$data['meta_description'] = 'Data pesanan pelanggan StarKonveksi.com';
				$data['page'] = 'page_pelanggan_pesanan_detail';
				$data['kategori'] = $this->Mkategori->kategori_menu();
				$data['pesanan'] = $this->Mpesanan->get_detail_pesanan($id);
				$this->load->view('template',$data);
				break;
			default :
				$data['meta_title'] = 'StarKonveksi.com | Pesanan Pelanggan';
				$data['meta_description'] = 'Data pesanan pelanggan StarKonveksi.com';
				$data['page'] = 'page_pelanggan_pesanan';
				$data['kategori'] = $this->Mkategori->kategori_menu();
				$data['pesanan'] = $this->Mpesanan->get_pesanan_pelanggan($this->session->userdata('pelanggan_id'));
				$this->load->view('template',$data);
				break;
		}
	}
	public function review_produk()
	{
		$data['meta_title'] = 'StarKonveksi.com | Review Produk';
		$data['meta_description'] = 'Data review produk pelanggan StarKonveksi.com';
		$data['page'] = 'page_pelanggan_review';
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
	public function get_daftar_kota($provinsi_id)
	{
		$data = $this->Mpelanggan->get_daftar_kota($provinsi_id);
		if($this->input->is_ajax_request())
		{
			echo json_encode($data);
		}
		else
		{
			return $data;
		}
	}
}

/* End of file pelanggan.php */
/* Location: ./application/controllers/pelanggan.php */