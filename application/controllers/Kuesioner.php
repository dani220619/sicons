<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('fungsi');
		$this->load->library('user_agent');
		$this->load->model(array("Mod_kuesioner"));
		$this->load->model(array("pengisian_model"));

		// backButtonHandle();
	}

	function index()
	{
		$data['title'] = "Kuesioner";
		$data['aspek'] = $this->Mod_kuesioner->aspek();
		$data['level'] = $this->Mod_kuesioner->level();
		$logged_in = $this->session->userdata('logged_in');
		if ($logged_in != TRUE || empty($logged_in)) {
			redirect('login');
		} else {
			$this->template->load('layoutbackend', 'kuesioner/index', $data);
		}
	}
	public function ajax_kuesioner()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);

		$list = $this->Mod_kuesioner->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $menu) {
			$no++;
			$row = array();
			$row[] = $menu->id_kuesioner;
			$row[] = $menu->pertanyaan;
			$row[] = $menu->id_aspek;
			$row[] = $menu->id_level;
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_kuesioner->count_all(),
			"recordsFiltered" => $this->Mod_kuesioner->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	public function viewkuesioner()
	{
		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data['table'] = $table;
		$data['data_field'] = $this->db->field_data($table);
		$data['data_table'] = $this->Mod_kuesioner->view_kuesioner($id)->result_array();
		// var_dump($data['data_table']);
		// die;
		$this->load->view('kuesioner/view', $data);
	}
	public function insert()
	{
		$this->_validate();
		$save  = array(
			'id_kuesioner'	=> $this->input->post('id_kuesioner'),
			'pertanyaan'  	=> $this->input->post('pertanyaan'),
			'id_aspek'	=> $this->input->post('id_aspek'),
			'id_level'	=> $this->input->post('id_level'),
		);
		// var_dump($save);
		// die;
		$this->Mod_kuesioner->insertkuesioner("kuesioner", $save);
		// $id_level = $this->session->userdata['id_level'];

		echo json_encode(array("status" => TRUE));
	}
	public function editkuesioner($id)
	{
		$data = $this->Mod_kuesioner->get_kuesioner($id);
		echo json_encode($data);
	}

	public function update()
	{
		$this->_validate();
		$id      = $this->input->post('id_kuesioner');
		$save  = array(

			'id_kuesioner'	=> $id,
			'pertanyaan'  	=> $this->input->post('pertanyaan'),
			'id_aspek'	=> $this->input->post('id_aspek'),
			'id_level'	=> $this->input->post('id_level'),

		);
		// var_dump($save);
		// die;
		$this->Mod_kuesioner->updatekuesioner($id, $save);
		echo json_encode(array("status" => TRUE));
	}
	public function delete()
	{
		$id = $this->input->post('id_kuesioner');
		$this->Mod_kuesioner->deletekuesioner($id, 'kuesioner');
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('pertanyaan') == '') {
			$data['inputerror'][] = 'pertanyaan';
			$data['error_string'][] = 'Pertanyaan is required';
			$data['status'] = FALSE;
		}

		// if ($this->input->post('jawaban') == '') {
		// 	$data['inputerror'][] = 'jawaban';
		// 	$data['error_string'][] = 'Jawaban is required';
		// 	$data['status'] = FALSE;
		// }

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	function kuesioner_admin()
	{
		$data['title'] = "kuesioner Admin";
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$data['career_admin'] = $this->Mod_kuesioner->kuesioneradmin($id_sekolah);
		// dead($id_sekolah);
		$this->template->load('layoutbackend', 'kuesioner/kuesioner_admin', $data);
	}
	public function detail_kuesioner($nis)
	{
		$data['a'] = "Layanan Akademik";
		$data['periode'] = $this->pengisian_model->showIsActive('periode', ['isaktif' => true])->row_array();
		$periode = $data['periode'];
		$data['total'] = $this->pengisian_model->tot_kuesioner($nis, $periode['id_periode']);
		// dead($nis);
		$data['detail_kuesioner'] = $this->Mod_kuesioner->detail_kuesioner($nis);
		$this->template->load('layoutbackend', 'kuesioner/detail_kuesioner', $data);
	}
	function cetak()
	{
		$data['title'] = "kuesioner Admin";
		// $id = $this->db->get_where('respon', ['nis' => $this->session->userdata('nis')])->row_array();
		// $nis = $id['nis'];
		// $data['periode'] = $this->pengisian_model->showIsActive('periode', ['isaktif' => true])->row_array();
		// $periode = $data['periode'];
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$data['career_admin'] = $this->Mod_kuesioner->kuesioneradmin($id_sekolah);
		// $data['total'] = $this->pengisian_model->tot_kuesioner_all($nis, $periode['id_periode']);

		// dead($nis);
		$this->template->load('layoutbackend', 'kuesioner/cetak', $data);
	}
}
