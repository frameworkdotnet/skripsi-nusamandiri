<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mkategori');
		$this->load->model('Mproduk');
		$this->load->helper('text');
	} 
	public function index($params = null)
	{
		if ($params == null)
		{
			$data['meta_title'] = 'Selamat Datang';
			$data['meta_description'] = 'TOko Online ini adalah sebuah toko online yang sangat berkualitas.';
			$data['produk_feature'] = $this->Mproduk->produk_feature();
			$data['produk_acak'] = $this->Mproduk->produk_acak(10, $data['produk_feature']);
			$data['page'] = 'page_home';		
		}
		else
		{
			$title = str_replace('-',' ',substr(strstr($params,'-'), 1));
			$param = explode('-',$params);	
			$product = $this->Mproduk->get_produk($param[0]);
			$product['jumlah_review'] = $this->get_jumlah_review($param[0]);
			$product['review'] = $this->Mproduk->get_review_produk($param[0]);
			$data['produk'] = $product;
			$data['meta_title'] = 'StarKonveksi.com | '.$product['nama'];
			$data['meta_description'] = 'Toko online murah berkualitas';
			$data['page'] = 'page_produk';
		}		
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
	public function simpan_review()
	{
	
	}
	public function get_jumlah_review($id)
	{
		return $this->Mproduk->jumlah_review($id);
	}
 }
 
/* End of file produk.php */
/* Location: ./application/controllers/produk.php */