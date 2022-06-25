<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konseling extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('fungsi');
		$this->load->library('user_agent');
		$this->load->helper('myfunction_helper');
		$this->load->model('Mod_konseling');
		$this->load->library('form_validation');

		// backButtonHandle();
	}

	function index()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$data['title'] = "konseling";
		$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$nis = $nis['id_user'];
		$data['nis']  = $this->Mod_konseling->getnis($nis);
		// dead($data['nis']['nis']);
		$logged_in = $this->session->userdata('logged_in');
		if ($logged_in != TRUE || empty($logged_in)) {
			redirect('login');
		} else {
			$this->template->load('layoutbackend', 'konseling/index', $data);
		}
	}
	function konseling_admin()
	{

		$data['title'] = "konseling Admin";
		$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$nis = $nis['id_user'];

		$data['jawaban_konseling'] = $this->Mod_konseling->jawb_konseling($nis);
		// dead($data['jawaban_konseling']);

		$this->template->load('layoutbackend', 'konseling/konseling_admin', $data);
	}
	public function jawaban($nis)
	{
		$data['title'] = "Jawaban";
		// $data['guru'] = $this->Mod_konseling->getguru();
		// $nis = $this->db->get_where('konseling', ['nis' => $this->session->userdata('nis')])->row_array();
		// $nis = $nis['nis'];
		$data['jawaban'] = $this->Mod_konseling->jawaban($nis);
		// dead($data['jawaban']);
		$this->template->load('layoutbackend', 'konseling/jawaban', $data);
	}
	public function update_jawaban()
	{

		$id      = $this->input->post('id');
		$save  = array(
			'jawaban'	=> $this->input->post('jawaban'),
		);
		// dead($id);
		$where = array('id' => $id);
		$this->Mod_konseling->update_konseling($where, $save, 'konseling');
		$this->session->set_flashdata('message5', '<div class="alert alert-success" role="alert">
        Update Konseling Jawaban Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');

		redirect('konseling/konseling_admin');
	}
	public function delete_jawaban()
	{
		$id = $this->input->get('id');
		$this->db->delete('konseling', array('id' => $id));
		$this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Konseling Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
		redirect('konseling/konseling_admin');
	}
	public function detail_riwayat($nis)
	{
		$data['title'] = "Riwayat konseling";
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$data['guru'] = $this->Mod_konseling->getguru($id_sekolah);
		// $nis = $this->db->get_where('konseling', ['nis' => $this->session->userdata('nis')])->row_array();
		// $nis = $nis['nis'];
		$data['konseling'] = $this->Mod_konseling->showkonseling($nis);
		// dead($data['guru']);
		$this->template->load('layoutbackend', 'konseling/riwayat', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah konseling";

		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$nis = $id['id_user'];
		$id_sekolah = $id['id_sekolah'];

		$data['nis']  = $this->Mod_konseling->getnis($nis);
		$data['guru'] = $this->Mod_konseling->getguru($id_sekolah);
		// dead($id_sekolah);
		$this->template->load('layoutbackend', 'konseling/add', $data);
	}

	function insert()
	{
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$data = array(
			'id' => rand(0000, 9999),
			'nis' => $this->input->post('nis'),
			'subject' => $this->input->post('subject'),
			'pesan' => $this->input->post('pesan'),
			'id_sekolah' => $id_sekolah,
			'id_level' => $this->input->post('id_level'),
			'id_user' => $this->input->post('id_user'),
			'is_active' => 'IK',
			'date_created' => date('Y-m-d h:i:s'),
		);
		// dead($data);
		$this->db->insert('konseling', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        
        Tambah Konseling Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
		redirect('konseling/index');
	}
	public function update()
	{

		$id      = $this->input->post('id');
		$nis      = $this->input->post('nis');
		$save  = array(

			'id' => $id,
			'nis' => $this->input->post('nis'),
			'subject' => $this->input->post('subject'),
			'pesan' => $this->input->post('pesan'),
			'id_level' => '2',
			'id_user' => $this->input->post('id_user'),
			'is_active' => 'IK',
			'date_created' => date('Y-m-d'),

		);
		// dead($save);
		$this->Mod_konseling->updatekonseling($id, $save);
		redirect('konseling/detail_riwayat/' . $nis . '');
	}
	public function delete()
	{
		$id = $this->input->get('id');
		$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$nis = $nis['nis'];
		$this->db->delete('konseling', array('id' => $id));

		redirect('konseling/detail_riwayat/' . $nis . '');
	}
}
