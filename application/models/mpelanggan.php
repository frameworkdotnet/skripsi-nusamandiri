<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpelanggan extends CI_Model {
	public function __construct() 
	{
		parent::__construct();
	}	
	public function cek_login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_message('required', 'Field <b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('valid_email', 'Masukkan format email yang benar!!!');
		if ($this->form_validation->run() == TRUE)
		{			
			$user = $this->input->post('email');
			$password = $this->input->post('password');
			$this->db->select('*');
			$this->db->where('email',$user);
			$this->db->where('password', md5($password));
			$this->db->where('status',1);
			$this->db->limit(1);
			$Q = $this->db->get('pelanggan');
			if ($Q->num_rows() > 0)
			{
				$row= $Q->row_array();
				$data = array(
					   'pelanggan_id'	=> $row['pelanggan_id'],
					   'email'     		=> $row['email'],
					   'nama' 			=> $row['nama']
				);
				$this->session->set_userdata($data);		
				$msg = 'Selamat datang pelanggan, selamat berbelanja :))';
				$redirect = '/pelanggan/'. $row['pelanggan_id'].'-'.url_title($row['nama']);
				if (isset($_GET['redirect']) && $_GET['redirect'] == 'checkout')
				{
					$msg = 'Selamat datang pelanggan, silahkan lanjutkan proses checkout Anda :)';
					$redirect = '/checkout/?ref=login';
				}			
				$this->session->set_flashdata('msg','<div id="success" style="display: block;"><div class="success" style="">'.$msg.'<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				redirect($redirect);
			}
			else 
			{
				$this->session->set_flashdata('msg','<div id="warning" style="display: block;"><div class="warning" style="">Maaf, email atau password salah, silahkan masukkan lagi.<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				redirect('/pelanggan/login');
			}
		}
	}
	public function daftar()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pelanggan.email]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password2]');
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required');
		$this->form_validation->set_message('required', 'Field <b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('matches', 'Field <b>%s</b> harus sama dengan field <b>%s</b>!!!');
		$this->form_validation->set_message('valid_email', 'Format email tidak benar!');
		$this->form_validation->set_message('is_unique', 'Email %s% sudah terdaftar, silahkan gunakan email yang lain!');
		if ($this->form_validation->run() == TRUE)
		{
			$this->load->helper('security');
			$key = do_hash($this->input->post('email').rand(1,999999));
			$this->load->library('Mailer');
			$mail = new PHPMailer();
			$mail->IsHTML(true);
			$mail->Body = '<p>Selamat datang di StarKonveksi.com!</p><br><br>
			<p>Silahkan klik link berikut ini untuk mengkonfirmasi akun pelanggan Anda.</p><br><p><a href="'.base_url().'pelanggan/konfirmasi/'.$key.'">Konfirmasi</a></p><em>Jika Anda tidak merasa melakukan pendaftaran, abaikan saja email ini.</em>';
			$mail->IsSMTP();
			$mail->SMTPDebug  = 1;
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host       = "smtp.gmail.com";
			$mail->Port       = 465;
			$mail->Username   = "setoelkahfi@gmail.com";
			$mail->Password   = "112VisiblE789^_^";
			$mail->SetFrom('admin@starkonveksi.com', 'StarKonveksi.com');
			$mail->Subject    = 'Pendaftaran Pelanggan StarKonveksi.com';
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
			$mail->AddAddress($this->input->post('email'), $this->input->post('nama'));
			if( ! $mail->Send()) 
			{
				echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			else 
			{
				$data = array(
							'email' => $this->input->post('email'),
							'password' => md5($this->input->post('password')),
							'nama' => $this->input->post('nama'),
							'key' => $key
				);
				if($this->db->insert('pelanggan',$data))
				{
					$this->session->set_flashdata('msg','<div id="success" style="display: block;"><div class="success" style="">Berhasil, Anda telah terdaftar menjadi pelanggan. Silahkan cek email Anda untuk konfirmasi :).<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				}
				else
				{
					$this->session->set_flashdata('msg','<div id="warning" style="display: block;"><div class="warning" style="">Kesalahan sistem. Maaf, pendaftaran Anda gagal, silahkan hubungi kami atau coba lagi nanti :)<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				}
				redirect('/','refresh');
			}
		}
	}
	public function facebook_login()
	{        
		$user = $this->facebook->getUser();
        if($user) 
		{
            try
			{
                $user_info = $this->facebook->api('/me');
				var_dump($user_info);
				$this->db->select('*');
				$this->db->where('email',$user_info['email']);
				$Q = $this->db->get('pelanggan');
				if ($Q->num_rows() > 0)
				{
					$row= $Q->row_array();
					$session_data = array(
						   'pelanggan_id'	=> $row['pelanggan_id'],
						   'email'     		=> $row['email'],
						   'nama' 			=> $row['nama']
					);
					$redirect = '/pelanggan/'. $row['pelanggan_id'].'-'.url_title($row['nama']);
				}
				else
				{	
					$Q->free_result();					
					$data = array(
						   'email'     		=> $user_info['email'],
						   'nama' 			=> $user_info['name']
					);
					$this->db->select('provinsi_id, kota_id');
					$this->db->where('nama',$user_info['location']['name']);
					$Q = $this->db->get('kota');
					if($Q->num_rows() > 0)
					{
						$row= $Q->row_array();
						$data['kota_id'] = $row['kota_id'];
						$data['provinsi_id']= $row['provinsi_id'];
					}
					else
					{					
						$data['kota_id'] = 1;
						$data['provinsi_id']= 1;
					}
					$Q->free_result();
					$Q = $this->db->insert('pelanggan',$data);
					$session_data = array(
						   'pelanggan_id'	=> $this->db->insert_id(),
						   'email'     		=> $user_info['email'],
						   'nama' 			=> $user_info['name']
					);
					$redirect = '/pelanggan/'. $this->db->insert_id().'-'.url_title($user_info['name']);
					$status = array(
						'message'   => 'Halo teman-teman, aku baru saja gabung di '.base_url().' lho!!',
						'link'      => base_url(),
						'caption'   => 'Ayo belanja sprei di '.base_url().'!'
					);
					$post_id = $this->facebook->api('/me/feed', 'post', $status);				
				}
				$this->session->set_userdata($session_data);		
				$msg = 'Selamat datang pelanggan, selamat berbelanja :))';
				$this->session->set_flashdata('msg','<div id="success" style="display: block;"><div class="success" style="">'.$msg.'<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
				redirect($redirect);
            } catch(FacebookApiException $e) {
                echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
                $user = null;
            }
        } 
		else 
		{
			$params = array(
					'scope' => 'email,publish_stream',
					'redirect_uri' => base_url().'pelanggan/login-facebook'
			);
            header('location:'.$this->facebook->getLoginUrl($params));
        }	
	}
	public function check_email($email)
	{
		$Q = $this->db->get_where('pelanggan',array('email' => $email),1);
		if ($Q->num_rows() > 0)
		{
			return FALSE;
		}
		$Q->free_result();
		return TRUE;
	}
	public function konfirmasi($key)
	{
		$Q = $this->db->get_where('pelanggan',array('key' => $key),1);
		if ($Q->num_rows() > 0)
		{
			$data = array(
					'key' => '',
					'status' => '1'
			);
			$this->db->where('key',$key);
			$this->db->update('pelanggan',$data);
			echo '<script>alert("Selamat, akun Anda sudah aktif :)");</script>';			
			redirect('/pelanggan/login','refresh');
		}
		else
		{
			echo '<script>alert("kode konfirmasi sudah tidak berlaku");</script>';
			redirect('/','refresh');
		}
		$Q->free_result();
	}
	public function get_pelanggan($id)
	{
		$data = array();
		$options = array(
					'pelanggan_id' => $id
					);
		$this->db->select('pelanggan.*, kota.provinsi_id, kota.nama as kota, kota.ongkos_kirim, provinsi.nama as provinsi' );
		$this->db->join('kota','pelanggan.kota_id = kota.kota_id');
		$this->db->join('provinsi','pelanggan.provinsi_id = provinsi.provinsi_id');
		$Q = $this->db->get_where('pelanggan',$options,1);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		} 
		else
		{
			redirect('/pelanggan','refresh');
		}
		$Q->free_result();
		return $data;
	}
	public function simpan_profil()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('provinsi_id', 'Provinsi', 'required');
		$this->form_validation->set_rules('kota_id', 'Kota', 'required');
		if($this->input->post('password') != '')
		{	
			$this->form_validation->set_rules('password', 'Password', 'required|matches[password2]');
			$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required');
			$this->form_validation->set_message('matches', 'Field <b>%s</b> harus sama dengan field <b>%s</b>!!!');
		}
		$this->form_validation->set_message('required', 'Field <b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('valid_email', 'Format email tidak benar!');
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'alamat' => $this->input->post('alamat'),
					'kota_id' => $this->input->post('kota_id')
			);
			if($this->input->post('password') != '')
			{
				$data['password'] = md5($this->input->post('password'));
			}
			if($this->input->post('status') != '')
			{
				$data['status'] = $this->input->post('status');
			}
			$this->db->where('pelanggan_id',$this->input->post('pelanggan_id'));
			if ($this->db->update('pelanggan',$data))
			{
				$this->session->set_flashdata('msg','<div id="success" style="display: block;"><div class="success" style="">Berhasil, profil Anda telah tersimpan :).<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div id="warning" style="display: block;"><div class="warning" style="">Kesalahan sistem. Maaf, profil Anda gagal tersimpan, silahkan hubungi kami atau coba lagi nanti :)<img src="'.base_url().'assets/img/close.png" alt="" class="close"/></div></div>');
			}
			redirect('/pelanggan/'.$this->session->userdata('pelanggan_id').'-'.url_title($this->session->userdata('nama')),'refresh');
		}
	}
	public function get_daftar_provinsi()
	{
		$Q = $this->db->get('provinsi');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function get_daftar_kota($provinsi_id)
	{
		$where = array(
				'provinsi_id' => $provinsi_id
		);
		$Q = $this->db->get_where('kota',$where);
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function get_jumlah_pelanggan()
	{
		$Q = $this->db->get('pelanggan'); 
		if ($Q->num_rows() > 0)
		{
			$data=$Q->num_rows();
		}
		return $data;
	}
	public function get_data_pelanggan()
	{
		$Q = $this->db->get('pelanggan');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[]= $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function aktifkan_pelanggan($id)
	{
		$data = array(
				'status' => 1
				);
		$this->db->where('pelanggan_id', $id);
		if($this->db->update('pelanggan',$data))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info">
				<a class="close" data-dismiss="alert" href="#">x</a>Data Berhasil diupdate.</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">x</a>Maaf, kesalahan sistem.</div>');
		}
		redirect('admin/pelanggan');
	}
	public function nonaktifkan_pelanggan($id)
	{
		$data = array(
				'status' => 0
				);
		$this->db->where('pelanggan_id', $id);
		if($this->db->update('pelanggan',$data))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info">
				<a class="close" data-dismiss="alert" href="#">x</a>Data Berhasil diupdate.</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">x</a>Maaf, kesalahan sistem.</div>');
		}
		redirect('admin/pelanggan');
	}
}

/* End of file mpelanggan.php */
/* Location: ./application/models/mpelanggan.php */