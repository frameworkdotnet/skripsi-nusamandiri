<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Checkout extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mkategori');
		$this->load->model('Mproduk');
		$this->load->model('Mpelanggan');
		if ($this->session->userdata('pelanggan_id') == '')
		{
			parse_str($_SERVER['QUERY_STRING'],$_GET); 
			switch ($_GET['ref'])
			{
				case 'cart' :
					$redirect	= '?redirect=checkout';
					break;
				default :					
					$redirect	= '';
			}
			$this->session->set_flashdata('msg','<div id="warning" style="display: block;"><div class="warning" style="">Untuk proses checkout, silahkan login atau daftar melalui Facebook atau Twitter :)<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
			redirect('/pelanggan/login/'.$redirect);
		}
	}	
	public function index()
	{
		$this->_cek_keranjang();
		$data['meta_title'] = 'StarKonveksi.com | Checkout Pelanggan';
		$data['meta_description'] = 'Checkout pelanggan StarKonveksi.com';
		$data['page'] = 'page_checkout';
		$data['pelanggan'] = $this->Mpelanggan->get_pelanggan($this->session->userdata('pelanggan_id'));
		$data['provinsi'] = $this->Mpelanggan->get_daftar_provinsi();
		$data['kota'] = $this->Mpelanggan->get_daftar_kota($data['pelanggan']['provinsi_id']);
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}	
	public function alamat_pengiriman()
	{
		$this->_cek_keranjang();
		if ($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('provinsi_id', 'Provinsi', 'required');
			$this->form_validation->set_rules('kota_id', 'Kota', 'required');
			$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric');
			$this->form_validation->set_rules('pelanggan_id', 'Kota', 'required');
			$this->form_validation->set_rules('ongkos_kirim', 'Kota', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(						
						'checkout' => array (	
							'alamat' => $this->input->post('alamat'),
							'email' => $this->input->post('email'),
							'kota_id' => $this->input->post('kota_id'),
							'nama' => $this->input->post('nama'),
							'ongkos_kirim' => $this->input->post('ongkos_kirim'),
							'pelanggan_id' => $this->input->post('pelanggan_id'),
							'provinsi_id' => $this->input->post('provinsi_id'),
							'kode_pos' => $this->input->post('kode_pos')
						)
				);
				$this->session->set_userdata($data);
				$response['success'] = 'OK';
			}
			else
			{
				$response['error'] = 'Semua data harus diisi secara lengkap!';
			}
			echo json_encode($response);
		}
	}
	public function konfirmasi_pesanan()
	{
		$this->_cek_keranjang();
		$checkout = $this->session->userdata('checkout');
		$html = '<div class="checkout-product">
					<table class="list">
						<thead>
							<tr>
								<td class="name">Nama Produk</td>
								<td class="model">Gambar Produk</td>
								<td class="quantity">Jumlah</td>
								<td class="price">Harga</td>
								<td class="total">Total</td>
								<td class="weight">Berat</td>
								<td class="total">Berat Total</td>
							</tr>
						</thead>
						<tbody>';
		$berat_total = 0;
		foreach ($this->cart->contents() as $items):
			$html .= '<tr>
						<td class="name">
							<span class="resp-title">Product Name</span>
							<a href="'.base_url().'produk/'.$items['id'].'-'.url_title($items['name']).'">'.$items['name'].'</a>
							<span class="stock">***</span>
						</td>
						<td class="image">
							<span class="resp-title">Product Picture</span>
							<a href="'.base_url().'produk/'.$items['id'].'-'.url_title($items['name']).'"><img src="'.base_url().'assets/produk/'.$items['picture'].'" alt="'.$items['name'].'" title="'.$items['name'].'" width="120" height="100"/></a>
						</td>
						<td class="quantity">
							<span class="resp-title">Product Quantity</span>
							'.$items['qty'].'
						</td>
						<td class="price">Rp '.$items['price'].',-</td>
						<td class="total">RP '.$items['price'] * $items['qty'].',-</td>
						<td class="total">'.$items['berat'].' kg</td>
						<td class="total">'.$items['berat'] * $items['qty'].' kg</td>
					</tr>';
			$berat_total += $items['berat'] * $items['qty'];
		endforeach;
		$total = $checkout['ongkos_kirim'] * $berat_total + $this->cart->total();
		$ongkos_kirim = $checkout['ongkos_kirim'] * $berat_total;
		$html .= '</tbody>
						<tfoot>
							<tr>
								<td colspan="4" class="price">
								<b>Sub-Total:</b>
								</td>
								<td class="total">Rp '.$this->cart->total().',- </td>
								<td class="price">
								<b>Berat Total:</b>
								</td>
								<td class="total">'.$berat_total.' Kg</td>
							</tr>
							<tr>
								<td colspan="4" class="price">
								<b>Ongkos Kirim:</b>
								</td>
								<td class="total">Rp '.$ongkos_kirim.',- </td>
							</tr>
							<tr>
								<td colspan="4" class="price">
								<b>Total:</b>
								</td>
								<td class="total">Rp '.$total.',-</td>
							</tr>
						</tfoot>
					</table>
				</div>';		
		$data = array(						
			'checkout_total' => array (
					'berat_total' => $berat_total,
					'ongkos_kirim_total' => $ongkos_kirim,
					'total_tagihan' => $total,
					'message' => $html
			)
		);
		$this->session->set_userdata($data);
		$html .= '<div class="payment">
					<div class="buttons">
						<div class="right">
							<input type="button" value="Konfirmasi Pesanan" id="button-confirm" class="button"/>
						</div>
					</div>
				</div>';
		echo $html;
	}
	public function simpan_pesanan()
	{		
		$this->_cek_keranjang();
		$this->load->model('Mpesanan');
		$this->Mpesanan->simpan_pesanan();
	}
	public function terimakasih()
	{
		$data['meta_title'] = 'StarKonveksi.com | Terimakasih telah bertransaksi dengan kami';
		$data['meta_description'] = 'Terimakasih telah melakukan transaksi online bersama StarKonveksi.com';
		$data['page'] = 'page_checkout_terimakasih';
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
	private function _cek_keranjang()
	{		
		if ($this->cart->total_items() < 1)
		{
			redirect('/keranjang-belanja');
		}
	}
 }
  
/* End of file checkout.php */
/* Location: ./application/controllers/checkout.php */