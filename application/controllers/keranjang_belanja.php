<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_belanja extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('Mproduk');
	}
	public function index()
	{
		if ($this->input->post())
		{		
			$this->cart->update($this->input->post());
		}		
		$this->load->model('Mkategori');
		$data['meta_title'] = 'Keranjang Belanja | StarKonveksi.com';
		$data['meta_description'] = 'Keranjang belanja StarKonveksi.com';
		$data['page'] = 'page_keranjang_belanja';
		$data['kategori'] = $this->Mkategori->kategori_menu();
		$this->load->view('template',$data);
	}
	public function tambah()
	{
		$update = FALSE;
		$jumlah = $this->input->post('jumlah');
		$produk_id = $this->input->post('produk_id');
		$produk = $this->Mproduk->get_produk($produk_id);
		if ($jumlah < $produk['stok'])
		{
			if($this->cart->total_items() > 1)
			{
				foreach ($this->cart->contents() as $items) :
					if ($items['id'] == $produk_id)
					{
						$data = array(
							'rowid' => $items['rowid'],
							'qty'   => $items['qty'] + $jumlah
						);
						$update = TRUE;
						$this->cart->update($data);
						break;
					}
				endforeach;
			} 
			if($update == FALSE)
			{
				$data = array(
				   'id'      => $produk_id,
				   'qty'     => $jumlah,
				   'price'   => $produk['harga'],
				   'name'    => $produk['nama'],
				   'picture' => $produk['gambar'],
				   'stok' 	 => $produk['stok'],
				   'berat' 	 => $produk['berat']
				);
				$this->cart->insert($data);
			}
			$response['data'] = $data;
			$response['success'] = 'Berhasil! Item telah dimasukkan ke keranjang belanja :)';
			$response['total'] = $this->cart->total_items().' item - Rp '.$this->cart->total();
		}
		else
		{
			$response['error'] = 'Stok tidak mencukupi, silahkan input jumlah beli yang lebih kecil :)';
		}
		echo json_encode($response);
	}
	public function tampil_ajax()
	{
		$html = '<b class="close-cart">&times;</b>
							<b class="cart-arrow"></b>
							<div class="mini-cart-info">
								<table>';
		$i = 1;
		foreach ($this->cart->contents() as $items) :
			$html .= '<tr>
										<td class="image">
											<a href="'.base_url().'produk/'.$items['id'].'-'.url_title($items['name']).'"><img src="'.base_url().'assets/produk/'.$items['picture'].'" alt="'.$items['name'].'" title="'.$items['name'].'" /></a>
										</td>
										<td class="name">
											<a href="'.base_url().'produk/'.$items['id'].'-'.url_title($items['name']).'">'. $items['name'].'</a>
										</td>
										<td class="total">
											<strong>'.$items['qty'].' x Rp '.$items['price'].',-'.'</strong>
											<a href="'.base_url().'keranjang-belanja/hapus/'.$items['rowid'].'" class="remove-link" title="Hapus">Hapus</a>
										</td>
									</tr>';
		endforeach;
		$html .= '</table>
							</div>
							<div class="mini-cart-total">
								<div class="checkout">
									<a href="'.base_url().'keranjang-belanja" class="sml-button">Keranjang Belanja</a><br />
									<a href="'.base_url().'checkout/?ref=cart" class="sml-button dark-bt">Checkout</a>
								</div>
								<table>
									<tr>
										<td align="right"><b>Total:</b></td>
										<td align="right">Rp '.$this->cart->total().',-</td>
									</tr>
								</table>
							</div>';
		
		if($this->cart->total_items() < 1) : 
			$html = '<div class="checkout">Keranjang belanja Anda masih kosong!!!.</div>';
		endif;
		echo $html;
	}
	
	public function hapus($rowid)
	{
		$data = array(
				'rowid' => $rowid,
				'qty'	=> 0
		);
		$this->cart->update($data);		
		$this->session->set_flashdata('msg','<div id="success" style="display: block;"><div class="success" style="">Berhasil, item telah dihapus dari kerangjang belanja.<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
		redirect('/keranjang-belanja');
	}
	
	public function get_provinsi()
	{
		$this->db->select('*');
		$Q = $this->db->get('provinsi');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		echo json_encode($data);
	}
	
	public function get_kota_provinsi($provinsi_id)
	{
		$Q = $this->db->get_where('kota',array('provinsi_id' => $provinsi_id));
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		echo json_encode($data);
	}
	
	public function get_kota($kota_id)
	{
		$Q = $this->db->get_where('kota',array('kota_id' => $kota_id));
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		echo json_encode($data);
	}
	function email()
	{
		$this->load->library('Mailer');
			$mail             = new PHPMailer();
			$mail->IsHTML(true);
			$mail->Body = '<h2>Terimakasih telah bertransaksi di StarKonveksi.com!</h2><br><br>
			<p>Berikut adalah detail pemesanan Anda.</p><br>Test aja ini ya<br>Silahkan konfirmasi pembayaran <a href="'.base_url().'pelanggan/pesanan">konfirmasi</a> Anda.</br><em>Jika Anda tidak merasa melakukan pendaftaran, abaikan saja email ini.</em>';
			$mail->IsSMTP();
			$mail->SMTPDebug  = 0;
			$mail->SMTPAuth   = true;
  $mail->SMTPSecure  = "tls"; //Secure conection
  $mail->Port        = 587; // set the SMTP port
			//$mail->SMTPSecure = "ssl";
			$mail->Host       = "smtp.gmail.com";
			//$mail->Port       = 465;
			$mail->Username   = "setoelkahfi@gmail.com";
			$mail->Password   = "112VisiblE789^_^";
			$mail->SetFrom('admin@starkonveksi.com', 'StarKonveksi.com');
			$mail->Subject    = 'Invoice Pemesanan Online StarKonveksi.com';
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
			$mail->AddAddress('setoelkahfi@yahoo.co.id', 'Seto Yahoo');
			$mail->AddAddress('seto.elkahfi@propanraya.com', 'Seto Propan');
			if( ! $mail->Send()) 
			{
				echo 'Ora terkirim';
			}
			else
			{
				echo 'Terkirim nuk';			
			}
	}
 }
  
/* End of file keranjang_belanja.php */
/* Location: ./application/controllers/keranjang_belanja.php */