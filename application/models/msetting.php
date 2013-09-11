<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msetting extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function get_provinsi_all()
	{
		$data = array();
		$Q = $this->db->get('provinsi');
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function informasi($slug)
	{
		$this->db->select('*');
		$this->db->where('slug',$slug);
		$Q = $this->db->get('informasi');
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	public function get_informasi_all()
	{
		$data = array();
		$Q = $this->db->get('informasi');
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function tambah_informasi()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		$this->form_validation->set_rules('isi', 'Isi', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'isi' => $this->input->post('isi'),
					'slug' => $this->input->post('slug')
					);
			$msg = ($this->db->insert('informasi',$data)) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil disimpan!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal disimpan!</div>';
			$this->session->set_flashdata('msg',$msg);
			redirect('/admin/setting/informasi');
		}
	}
	public function edit_informasi()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		$this->form_validation->set_rules('isi', 'Isi', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'isi' => $this->input->post('isi'),
					'slug' => $this->input->post('slug')
			);
			$this->db->set($data);
			$this->db->where(array('informasi_id' => $this->input->post('informasi_id')));
			$msg = ($this->db->update('informasi')) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil diupdate!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal diupdate!</div>';
			$this->session->set_flashdata('msg',$msg);
			redirect('/admin/setting/informasi');
		}
	}
	public function get_informasi_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('informasi_id',$id);
		$Q = $this->db->get('informasi');
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	public function hapus_informasi($id)
	{
		$this->db->where(array('informasi_id' => $id));
		$msg = ($this->db->delete('informasi')) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil dihapus!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal dihapus!</div>';
		$this->session->set_flashdata('msg',$msg);
		redirect('/admin/setting/informasi');
	}	
	public function get_kota_all()
	{
		$data = array();
		$this->db->select('kota.*,provinsi.nama AS provinsi');
		$this->db->join('provinsi','kota.provinsi_id = provinsi.provinsi_id');
		$Q = $this->db->get('kota');
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	public function tambah_kota()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('ongkos_kirim', 'Ongkos kirim', 'required|numeric');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('numeric', '<b>%s</b> harus harus diisi dengan angka!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'ongkos_kirim' => $this->input->post('ongkos_kirim'),
					'provinsi_id' => $this->input->post('provinsi_id')
					);
			$msg = ($this->db->insert('kota',$data)) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil disimpan!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal disimpan!</div>';
			$this->session->set_flashdata('msg',$msg);
			redirect('/admin/setting/kota');
		}
	}
	public function edit_kota()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('ongkos_kirim', 'Ongkos kirim', 'required|numeric');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		$this->form_validation->set_message('numeric', '<b>%s</b> harus harus diisi dengan angka!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama'),
					'ongkos_kirim' => $this->input->post('ongkos_kirim'),
					'provinsi_id' => $this->input->post('provinsi_id')
					);
			$this->db->where(array('kota_id'=>$this->input->post('kota_id')));
			$msg = ($this->db->update('kota',$data)) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil diupdate!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal diupdate!</div>';
			$this->session->set_flashdata('msg',$msg);
			redirect('/admin/setting/kota');
		}
	}
	public function get_kota($id) {
		$this->db->where('kota_id',$id);
		$Q = $this->db->get('kota');
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}	
	public function hapus_kota($id)
	{
		$this->db->where(array('kota_id' => $id));
		$msg = ($this->db->delete('kota')) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil dihapus!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal dihapus!</div>';
		$this->session->set_flashdata('msg',$msg);
		redirect('/admin/setting/kota');
	}
	public function tambah_provinsi()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama')
					);
			$msg = ($this->db->insert('provinsi',$data)) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil disimpan!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal disimpan!</div>';
			$this->session->set_flashdata('msg',$msg);
			redirect('/admin/setting/provinsi');
		}
	}
	public function edit_provinsi()
	{
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_message('required', '<b>%s</b> harus harus diisi!!!');
		if ($this->form_validation->run() == TRUE)
		{	
			$data = array(
					'nama' => $this->input->post('nama')
			);
			$this->db->set($data);
			$this->db->where(array('provinsi_id' => $this->input->post('provinsi_id')));
			$msg = ($this->db->update('provinsi')) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil diupdate!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal diupdate!</div>';
			$this->session->set_flashdata('msg',$msg);
			redirect('/admin/setting/provinsi');
		}
	}
	public function get_provinsi($id) {
		$this->db->where('provinsi_id',$id);
		$Q = $this->db->get('provinsi');
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}	
	public function hapus_provinsi($id)
	{
		$this->db->where(array('provinsi_id' => $id));
		$msg = ($this->db->delete('provinsi')) ? '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">x</a>Data berhasil dihapus!</div>' : '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Data gagal dihapus!</div>';
		$this->session->set_flashdata('msg',$msg);
		redirect('/admin/setting/provinsi');
	}
}

/* End of file msetting.php */
/* Location: ./application/models/msetting.php */