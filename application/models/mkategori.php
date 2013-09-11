<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkategori extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mproduk');
	}
	public function get_kategori($id)
	{
		$data = array();
		$options = array('kategori_id' => $id);
		$Q = $this->db->get_where('kategori', $options, 1);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	public function get_kategori_all()
	{
		$data = array();
		$Q = $this->db->get('kategori');
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function kategori_menu()
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('status', '1');
		$this->db->order_by('nama', 'asc');
		$Q = $this->db->get('kategori');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $kategori)
			{
					$data[] = array(
						'name'     => $kategori['nama'],
						'href'     => 'kategori/'.$kategori['kategori_id'].'-'.url_title($kategori['nama'])
					);
			}
		}
		$Q->free_result();
		return $data;		
	}
	public function tambah_kategori()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama kategori', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi kategori', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'status' => $this->input->post('status')
					);
			if ($this->db->insert('kategori',$data))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil disimpan!</div>');
			}
			else
			{					
				$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal disimpan!</div>');
			}
			redirect('/admin/kategori');
		}
	}			
	public function edit_kategori()
	{	
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama kategori', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi kategori', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'status' => $this->input->post('status')
					);
			$this->db->set($data);
			$this->db->where(array('kategori_id'=>$this->input->post('kategori_id')));
			if ($this->db->update('kategori'))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil diupdate!</div>');
			}
			else
			{					
				$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal diupdate!</div>');
			}
			redirect('/admin/kategori');
		}
	}
	public function hapus_kategori($id)
	{
		$this->db->where('kategori_id',$id);
		if ($this->db->delete('kategori'))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil dihapus!</div>');
		}
		else
		{					
			$this->session->set_flashdata('msg','<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal dihapus!</div>');
		}
		redirect('/admin/kategori');
	}
}

/* End of file mkategori.php */
/* Location: ./application/controllers/mkategori.php */