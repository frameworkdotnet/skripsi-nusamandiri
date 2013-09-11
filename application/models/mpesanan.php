<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpesanan extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function simpan_pesanan()
	{		
		$checkout = $this->session->userdata('checkout');
		$checkout_total = $this->session->userdata('checkout_total');
		$data = array(
				'pelanggan_id' => $checkout['pelanggan_id'],
				'alamat' => $checkout['alamat'],
				'status' => 'Baru',
				'kota_id' => $checkout['kota_id'],
				'provinsi_id' => $checkout['provinsi_id'],
				'kode_pos' => $checkout['kode_pos'],
				'total' => $checkout_total['total_tagihan']
		);
        $this->db->set('tgl', 'CURRENT_DATE()', FALSE);
        $this->db->set('jam', 'NOW()', FALSE);
		if($this->db->insert('pesanan',$data))
		{
			$id = $this->db->insert_id();
			foreach ($this->cart->contents() as $items)
			{
				$data = array(
						'produk_id' => $items['id'],
						'jumlah' => $items['qty'],
						'pesanan_id' => $id
				);
				if(!$this->db->insert('pesanan_detail',$data))
					return FALSE;
			}
			$this->load->helper('security');
			$this->load->library('Mailer');
			$mail             = new PHPMailer();
			$mail->IsHTML(true);
			$mail->Body = '<h2>Terimakasih telah bertransaksi di StarKonveksi.com!</h2><br><br>
			<p>Berikut adalah detail pemesanan Anda.</p><br>'.$checkout_total['message'].'<br>Silahkan konfirmasi pembayaran <a href="'.base_url().'pelanggan/pesanan">konfirmasi</a> Anda.</br><em>Jika Anda tidak merasa melakukan pendaftaran, abaikan saja email ini.</em>';
			$mail->IsSMTP();
			$mail->SMTPDebug  = 0;
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure  = "tls"; //Secure conection
			$mail->Port        = 587;
			//$mail->SMTPSecure = "ssl";
			$mail->Host       = "smtp.gmail.com";
			//$mail->Port       = 465;
			$mail->Username   = "setoelkahfi@gmail.com";
			$mail->Password   = "112VisiblE789^_^";
			$mail->SetFrom('admin@starkonveksi.com', 'StarKonveksi.com');
			$mail->Subject    = 'Invoice Pemesanan Online StarKonveksi.com';
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
			$mail->AddAddress($checkout['email'], $checkout['nama']);
			$this->cart->destroy();
			$this->session->unset_userdata('checkout');
			$this->session->unset_userdata('checkout_total');
			if( ! $mail->Send()) 
			{
				redirect('checkout/terimakasih');
			}
			else
			{
				$response['success'] = TRUE;
				echo json_encode($response);			
			}
			
		}
		else
		{
			return FALSE;
		}
	}
	public function get_daftar_pesanan()
	{
		$this->db->select('pelanggan.nama, pesanan.*');
		$this->db->join('pelanggan','pesanan.pelanggan_id = pelanggan.pelanggan_id');
		$this->db->order_by('tgl', 'DESC');
		$Q = $this->db->get('pesanan');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		else
		{
			return false;
		}
		$Q->free_result();
		return $data;
	}
	public function get_pesanan_pelanggan($pelanggan_id)
	{
		$where = array(
					'pesanan.pelanggan_id' => $pelanggan_id
		);
		$this->db->select('pelanggan.nama, pesanan.*');
		$this->db->join('pelanggan','pesanan.pelanggan_id = pelanggan.pelanggan_id');
		$this->db->order_by('tgl', 'DESC');
		$Q = $this->db->get_where('pesanan',$where);
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		else
		{
			return false;
		}
		$Q->free_result();
		return $data;
	}
	public function get_detail_pesanan($id)
	{
		$where = array(
				'pesanan_id' => $id
		);
		$this->db->select('pesanan.pesanan_id, pesanan.alamat, pesanan.kode_pos, pesanan.status, pesanan.tgl, pesanan.jam, pesanan.total, pelanggan.nama AS pelanggan, provinsi.nama AS provinsi, kota.nama AS kota, kota.ongkos_kirim');
		$this->db->join('pelanggan','pesanan.pelanggan_id=pelanggan.pelanggan_id');
		$this->db->join('kota','pesanan.kota_id=kota.kota_id');
		$this->db->join('provinsi','pesanan.provinsi_id=provinsi.provinsi_id');
		$Q = $this->db->get_where('pesanan',$where);
		if ($Q->num_rows() > 0)
		{
			$data= $Q->row_array();
			$where = array(
				'pesanan_id' => $id
			);
			$this->db->select('pesanan_detail.*, produk.nama, produk.gambar, produk.harga, produk.berat');
			$this->db->join('produk','pesanan_detail.produk_id = produk.produk_id');
			$Q = $this->db->get_where('pesanan_detail',$where);
			if ($Q->num_rows() > 0)
			{
				$data['harga_total'] = 0;
				$data['berat_total'] = 0;
				foreach ($Q->result_array() as $row)
				{
					$row['total_harga'] = $row['harga']*$row['jumlah'];
					$row['total_berat'] = $row['berat']*$row['jumlah'];
					$data['produk'][] = $row;
					$data['harga_total'] +=$row['total_harga'];
					$data['berat_total'] +=$row['total_berat'];
				}
				$data['ongkir_total'] = $data['berat_total'] * $data['ongkos_kirim'];
				$data['total'] = $data['ongkir_total'] + $data['harga_total'];
			}
		}
		else
		{
			return false;
		}
		$Q->free_result();
		return $data;
	}
	public function konfirmasi_pesanan()
	{
		
		$this->form_validation->set_rules('metode_pembayaran','Metode Pembayaran','required');		
		$this->form_validation->set_rules('pesanan_id', 'Id Pesanan','required|numeric|is_unique[konfirmasi.pesanan_id]');		
		$this->form_validation->set_rules('no_rekening','Nomor rekening','required|numeric');		
		$this->form_validation->set_rules('nama','Nama pemilik rekening','required');		
		$this->form_validation->set_rules('jumlah','Jumlah pembayaran','required|numeric');		
		$this->form_validation->set_rules('tanggal','Tanggal pembayaran','required|alpha_dash');
		$this->form_validation->set_message('required', 'Field %s% harus diisi.');
		$this->form_validation->set_message('alpha_dash', 'Field %s% harus berupa angka atau dash(-).');
		$this->form_validation->set_message('numeric', 'Field %s% harus berupa angka.');
		$this->form_validation->set_message('is_unique', 'Nomor pesanan sudah dikonfirmasi');
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'pesanan_id' => $this->input->post('pesanan_id'), 
					'metode_pembayaran' => $this->input->post('metode_pembayaran'), 
					'no_rekening' => $this->input->post('no_rekening'), 
					'nama' => $this->input->post('nama'), 
					'tanggal' => $this->input->post('tanggal'), 
					'jumlah_bayar' => $this->input->post('jumlah')
			);
			if ($this->db->insert('konfirmasi',$data))
			{
				$this->session->set_flashdata('msg','<div id="success" style="display: block;"><div class="success" style="">Berhasil, konfirmasi pesanan Anda telah tersimpan :).<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				redirect('/pelanggan/pesanan','refresh');
			}
			else
			{
				$this->session->set_flashdata('msg','<div id="warning" style="display: block;"><div class="warning" style="">Kesalahan sistem. Maaf, konfirmasi pesanan Anda gagal tersimpan, silahkan hubungi kami atau coba lagi nanti :)<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				return FALSE;
			}
		}
	}
	public function get_jumlah_omset()
	{
		$this->db->select('SUM(total) as total');
		$this->db->where('status','Lunas');
		$Q = $this->db->get('pesanan'); 
		if ($Q->num_rows() > 0)
		{
			$data=$Q->row_array();
		}
		return $data['total'];
	}
	public function get_jumlah_pesanan()
	{
		$Q = $this->db->get('pesanan'); 
		if ($Q->num_rows() > 0)
		{
			$data=$Q->num_rows();
		}
		return $data;
	}
	public function get_konfirmasi_pembayaran($pesanan_id)
	{
		$where = array(
					'konfirmasi.pesanan_id' => $pesanan_id
		);
		$Q = $this->db->get_where('konfirmasi',$where);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
			$this->db->set('cek',1);
			$this->db->where($where);
			$this->db->update('konfirmasi');
		}
		else
		{
			return false;
		}
		$Q->free_result();
		return $data;
	}
	public function get_data_pembayaran()
	{
		$this->db->order_by('tanggal', 'DESC');
		$Q = $this->db->get('konfirmasi');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		else
		{
			return false;
		}
		$Q->free_result();
		return $data;
	}
	public function update($pesanan_id, $status)
	{
		switch($status)
		{
			case 0 :
				$data['status'] = 'Baru';
				break;
			case 1 :
				$data['status'] = 'Lunas';
				break;
			case 2 :
				$data['status'] = 'Dikirim';
				break;	
			case 3 :
				$data['status'] = 'Ditutup';
				break;
		}
		$this->db->where('pesanan_id',$pesanan_id);
		if($this->db->update('pesanan',$data))
		{
			redirect('/admin/pesanan');
		}
	}
	public function penjualan_bulan_ini()
	{
		$data[0] = date('j');
		$start = date("Y-m");
		$end = date("Y-m-d");
		$start .= '-01';
		$this->db->select('total, tgl');
		$this->db->where('tgl BETWEEN \''.$start.'\' AND \''.$end.'\'');
		$Q = $this->db->get('pesanan');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$tgl = explode('-',$row['tgl']);
				$row['tgl'] = intval($tgl[2]);
				$data[$row['tgl']]= $row;
			}
		}
		else
		{
			return false;
		}
		$Q->free_result();
		echo json_encode($data);
	}
	public function penjualan_custom()
	{
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$status = $this->input->post('status');
		$data[0] = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
		$start = $tahun.'-'.$bulan.'-01';
		$end = $tahun.'-'.$bulan.'-31';
		$this->db->select('total, tgl');
		if ($status !== 'All') 
		{
			$this->db->where('status',$status);
		}
		$this->db->where('tgl BETWEEN \''.$start.'\' AND \''.$end.'\'');
		$Q = $this->db->get('pesanan');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$tgl = explode('-',$row['tgl']);
				$row['tgl'] = intval($tgl[2]);
				$data[$row['tgl']]= $row;
			}
		}
		else
		{
			$data = false;
		}
		$Q->free_result();
		echo json_encode($data);
	}
	public function penjualan_pdf($param)
	{
		$start = substr_replace($param,'-',4,1).'-01';
		$end = substr_replace($param,'-',4,1).'-31';
		$this->db->select('pesanan.*,pelanggan.nama AS pelanggan');
		$this->db->join('pelanggan','pesanan.pelanggan_id=pelanggan.pelanggan_id');
		$this->db->where('tgl BETWEEN \''.$start.'\' AND \''.$end.'\'');
		$Q = $this->db->get('pesanan');
		if ($Q->num_rows() > 0)
		{
			$filename = 'Laporan-Penjualan-'.substr_replace($param,'-',4,1);
			$pdfFilePath = FCPATH.'/download/laporan/'.$filename.'.pdf';
			$data['page_title'] = 'Laporan Penjualan : '.substr_replace($param,'-',4,1);
			$data['laporan'] = $Q->result_array();
			ini_set('memory_limit','32M');
			$html = $this->load->view('admin/page-laporan-download', $data, true);
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
			$pdf->WriteHTML($html);
			$pdf->Output($pdfFilePath, 'F');
			redirect('/download/laporan/'.$filename.'.pdf');
		}
		else
		{
			redirect('/admin/laporan/');
		}
	}
	public function cek_konfirmasi()
	{
		$Q = $this->db->get_where('konfirmasi',array('cek' => 0));
		if ($Q->num_rows() > 0)
		{
			echo $Q->num_rows();
		}
		else
		{
			echo 0;
		}
	}
}

/* End of file mpesanan.php */
/* Location: ./application/models/mpesanan.php */