<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mproduk extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_produk($produk_id)
	{
		$data = array();
		$Q = $this->db->get_where('produk',array('produk_id' => $produk_id),1);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		else
		{
			redirect('/');
		}
		$Q->free_result();
		return $data;
	}
	public function get_review_produk($produk_id)
	{
		$data = array();
		$this->db->select('produk_review.*, pelanggan.nama AS pelanggan');
		$this->db->join('pelanggan','produk_review.pelanggan_id=pelanggan.pelanggan_id');
		$Q = $this->db->get_where('produk_review',array('produk_id' => $produk_id,'produk_review.status'=>1));
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function get_produk_all($limit=null,$start=null)
	{
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/produk/';
		$config['total_rows'] = $this->jumlah_baris();
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3)-1 : 0;
		$this->db->limit($config['per_page'], $page);
		$this->db->select('produk.*, kategori.nama AS kategori');
		$this->db->join('kategori','produk.kategori_id = kategori.kategori_id');
		$Q = $this-> db-> get('produk');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q-> free_result();
		return $data;
	}
	public function produk_feature()
	{
		$data = array();
		$this->db->select('produk_id, nama, deskripsi, gambar, harga');
		$this->db->where('feature', '1');
		$this->db->order_by('rand()');
		$Q = $this->db->get('produk');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = array(
					'produk_id' => $row['produk_id'],
					'nama' => $row['nama'],
					'harga' => $row['harga'],
					'deskripsi' => $row['deskripsi'],
					'gambar' => $row['gambar']
				);
			}
		}
		$Q->free_result();
		return $data;
	}
	public function produk_acak($limit, $skip)
	{
		$data = array();
		$temp = array();
		if ($limit == 0)
		{
			$limit = 3;
		}
		$this->db->select('produk_id, nama, gambar, kategori_id, harga');
		for ($i=0; $i<count($skip); $i++)
		{
			$this->db->where('produk_id !=', $skip[$i]['produk_id']);
		}
		$this->db->order_by('rand()');
		$Q = $this->db->get('produk');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$temp[] = array(
					'produk_id' => $row['produk_id'],
					'nama' => $row['nama'],
					'harga' => $row['harga'],
					'gambar' => $row['gambar']
				);
			}
		}
		shuffle($temp);
		if (count($temp)){
			for ($i=1;$i <= $limit;$i++){
				$data[] = array_shift($temp);
			}
		}
		$Q->free_result();
		return $data;
	}
	public function cek_stok($produk_id)
	{
		$this->db->select('stok');
		$this->db->where('produk_id', $produk_id);
		$Q = $this->db->get('produk');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function produk_kategori($catid)
	{
		$data = array();
		$this->db->select('produk_id, nama, deskripsi, gambar, harga');
		$this->db->where('kategori_id', $catid);
		$this->db->order_by('nama','asc');
		$Q = $this->db->get('produk');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function tambah_produk() 
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama produk', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required|integer');
		$this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
		$this->form_validation->set_rules('stok', 'Stok', 'required|integer');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('integer', '<b>%s</b> harus harus diisi dengan angka bulat!!!');
		$this->form_validation->set_message('numeric', '<b>%s</b> harus harus diisi dengan angka!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			if (!empty($_FILES['gambar']['name']))
			{
				$config['upload_path'] = './assets/produk/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '200';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar'))
				{
					$this->upload->display_errors();
					exit();
				}
				$image = $this->upload->data();
				$data = array(
						'nama' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi'),
						'gambar' => $image['file_name'],
						'status' => $this->input->post('status'),
						'harga' => $this->input->post('harga'),
						'kategori_id' => $this->input->post('kategori_id'),
						'feature' => $this->input->post('feature'),
						'stok' => $this->input->post('stok'),
						'berat' => $this->input->post('berat')
				);
				if ($this->db->insert('produk',$data))
				{
					$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil disimpan!</div>');
				}
				else
				{					
					$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal disimpan!</div>');
				}
				redirect('/admin/produk');
			}
		}
	}
	public function edit_produk()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama produk', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required|integer');
		$this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
		$this->form_validation->set_rules('stok', 'Stok', 'required|integer');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('integer', '<b>%s</b> harus harus diisi dengan angka bulat!!!');
		$this->form_validation->set_message('numeric', '<b>%s</b> harus harus diisi dengan angka!!!');
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'status' => $this->input->post('status'),
					'harga' => $this->input->post('harga'),
					'kategori_id' => $this->input->post('kategori_id'),
					'feature' => $this->input->post('feature'),
					'stok' => $this->input->post('stok'),
					'berat' => $this->input->post('berat')
			);
			if (!empty($_FILES['gambar']['name']))
			{
				$config['upload_path'] = './assets/produk/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '200';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar'))
				{
					$this->upload->display_errors();
					exit();
				}
				$image = $this->upload->data();
				$data['gambar'] = $image['file_name'];
			}			
			$this->db->set($data);
			$this->db->where('produk_id', $this->input->post('produk_id'));
			if ($this->db->update('produk'))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil diupdate!</div>');
			}
			else
			{					
				$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal diupdate!</div>');
			}
			redirect('/admin/produk');
		}
	}
	public function hapus_produk($id)
	{
		$this->db->where('produk_id', $id);
		if ($this->db->delete('produk', $data))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil dihapus!</div>');
		}
		else
		{					
			$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal dihapus!</div>');
		}
		redirect('/admin/produk');
	}	
	public function jumlah_review($produk_id)
	{
		$this->db->select('produk_id');
		$this->db->where(array('produk_id' => $produk_id, 'status'=>1));
		$Q = $this->db->get('produk_review');
		if ($Q->num_rows() > 0)
		{
			return $Q->num_rows();
		}
		return $data = 0;
	}
	public function get_jumlah_produk()
	{
		$Q = $this->db->get('produk');
		if ($Q->num_rows() > 0)
		{
			return $Q->num_rows();
		}
	}
	public function jumlah_baris() 
	{
        return $this->db->count_all('produk');
    }
	public function laporan()
	{
		$this->db->select('produk.*,kategori.nama AS kategori');
		$this->db->join('kategori','produk.kategori_id=kategori.kategori_id');
		$Q = $this->db->get('produk');
		if ($Q->num_rows() > 0)
		{
			$filename = 'Laporan-Produk-'.date('Y-m-d');
			$pdfFilePath = FCPATH.'/download/laporan/'.$filename.'.pdf';
			$data['page_title'] = 'Laporan Produk : '.date(DATE_RFC822);
			$data['produk'] = $Q->result_array();
			ini_set('memory_limit','32M');
			$html = $this->load->view('admin/page-laporan-produk-download', $data, true);
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
	public function get_review_all()
	{
		$this->db->select('produk_review.*, pelanggan.nama AS pelanggan, produk.nama AS produk');
		$this->db->join('produk','produk.produk_id=produk_review.produk_id');
		$this->db->join('pelanggan','pelanggan.pelanggan_id=produk_review.pelanggan_id');
		$Q = $this->db->get('produk_review');
		$data = array();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function get_review($id)
	{
		$Q = $this->db->get_where('produk_review',array('review_id'=>$id));
		if ($Q->num_rows() > 0)
		{
			$data= $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	public function edit_review()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('isi', 'Isi review', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'isi' => $this->input->post('isi'),
					'status' => $this->input->post('status')
			);
			$this->db->set($data);
			$this->db->where('review_id', $this->input->post('review_id'));
			if ($this->db->update('produk_review'))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil diupdate!</div>');
			}
			else
			{					
				$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal diupdate!</div>');
			}
			redirect('/admin/pelanggan/review-produk');
		}
	}
	public function hapus_review($id)
	{
		$this->db->where('review_id', $id);
		if ($this->db->delete('produk_review', $data))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil dihapus!</div>');
		}
		else
		{					
			$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal dihapus!</div>');
		}
		redirect('/admin/pelanggan/review-produk');
	}
}
 
/* End of file mproduk.php */
/* Location: ./application/models/mproduk.php */