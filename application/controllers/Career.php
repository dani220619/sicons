<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Career extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('fungsi');
		$this->load->library('user_agent');
		$this->load->model(array("Mod_career"));

		// backButtonHandle();
	}

	function index()
	{
		$data['title'] = "Career";
		$logged_in = $this->session->userdata('logged_in');
		if ($logged_in != TRUE || empty($logged_in)) {
			redirect('login');
		} else {
			$this->template->load('layoutbackend', 'career/index', $data);
		}
	}
	public function ajax_career()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_career->get_datatables();
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
			"recordsTotal" => $this->Mod_career->count_all(),
			"recordsFiltered" => $this->Mod_career->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	public function view_career()
	{
		$id = $this->input->post('id_kuesioner');
		$table = $this->input->post('table');
		$data['table'] = $table;
		$data['data_field'] = $this->db->field_data($table);
		$data['data_table'] = $this->Mod_career->view_career($id)->result();
		// var_dump($data['data_table']);
		// die;
		$this->load->view('career/view', $data);
	}
	public function insert()
	{
		$this->_validate();
		$save  = array(
			'id'	=> rand(000, 999),
			'pertanyaan'  	=> $this->input->post('pertanyaan'),
			'jawaban'	=> $this->input->post('jawaban'),
			'is_active'	=> $this->input->post('is_active'),
			'date_created'	=> date("y-m-d")
		);
		// var_dump($save);
		// die;
		$this->Mod_career->insertcareer("career", $save);
		// $id_level = $this->session->userdata['id_level'];

		echo json_encode(array("status" => TRUE));
	}
	public function edit_career($id)
	{
		$data = $this->Mod_career->get_career($id);
		echo json_encode($data);
	}

	public function update()
	{
		$this->_validate();
		$id      = $this->input->post('id');
		$save  = array(
			'id'	=> $id,
			'pertanyaan'  	=> $this->input->post('pertanyaan'),
			'jawaban'	=> $this->input->post('jawaban'),
			'is_active'	=> $this->input->post('is_active'),
			'date_created'	=> date("y-m-d")

		);
		// var_dump($save);
		// die;
		$this->Mod_career->updatecareer($id, $save);
		echo json_encode(array("status" => TRUE));
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$this->Mod_career->deletecareer($id, 'career');
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

		if ($this->input->post('jawaban') == '') {
			$data['inputerror'][] = 'jawaban';
			$data['error_string'][] = 'Jawaban is required';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	function siswa_career()
	{
		$data['title'] = "Pengisian Career";
		$data['a'] = "Layanan Career";

		$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$nis = $nis['nis'];
		$data['career'] = $this->Mod_career->getjawaban($nis);
		$data['periode'] = $this->Mod_career->showIsActive('periode', ['isaktif' => true])->row_array();
		$periode = $data['periode'];
		$data['aspek'] = $this->Mod_career->getAspekByType('aspek', ['nama_aspek' => 'Careertest'])->result_array();
		$data['answer'] = $this->Mod_career->getAnserById('respon_career', ['nis' => $nis, 'id_periode' => $periode['id_periode']])->row_array();
		$data['total'] = $this->Mod_career->tot_career($nis, $periode['id_periode']);

		// dead($data['career']);
		if ($this->form_validation->run() == false) {
			$this->template->load('layoutbackend', 'career/siswa_career', $data);
		}

		//jika form validasi benar
		if (!empty($this->input->post('submitted'))) {
			$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
			$id_sekolah = $nis['id_sekolah'];
			$aspek = $this->Mod_career->getAspekByTypee('aspek', ['nama_aspek' => 'Careertest'])->result_array();

			$id_periode = $this->input->post('id_periode');
			$id_kuesioner = $this->input->post('id_kuesioner');
			$id_aspek = $this->input->post('id_aspek');
			$nama_aspek = $this->input->post('nama_aspek');
			$nis = $this->input->post('nis');
			$harapan = $this->input->post('harapan');
			// $nyata = $this->input->post('nyata');

			$dataarray = [];
			foreach ($aspek as $asp) {
				$asked = $this->db->query("SELECT * FROM kuesioner where id_aspek = '" . $asp['id_aspek'] . "' AND id_level = '" . $this->session->userdata('id_level') . "'");
				foreach ($asked->result_array() as $ask) {
					if ($harapan[$ask['id_kuesioner']] == 70) {
						$k = 1;
						$c = 0;
						$b = 0;
						// $sb = 0;
					} elseif ($harapan[$ask['id_kuesioner']] == 71) {
						$k = 0;
						$c = 2;
						$b = 0;
						// $sb = 0;
					} elseif ($harapan[$ask['id_kuesioner']] == 72) {
						$k = 0;
						$c = 0;
						$b = 3;
						// $sb = 0;
					} else {
						$k = 1;
						$c = 2;
						$b = 3;
						// $sb = 1;
					}
					// if ($nyata[$ask['id_kuesioner']] == 1) {
					//     $nk = 1;
					//     $nc = 0;
					// } elseif ($nyata[$ask['id_kuesioner']] == 2) {
					//     $nk = 0;
					//     $nc = 1;
					// } elseif ($nyata[$ask['id_kuesioner']] == 3) {
					//     $nk = 1;
					//     $nc = 0;
					// } else {
					//     $nk = 1;
					//     $nc = 0;
					// }
					// dead($asked);
					array_push($dataarray, [
						'id_periode' => $id_periode[$ask['id_kuesioner']],
						'id_kuesioner' => $id_kuesioner[$ask['id_kuesioner']],
						'id_aspek' => $id_aspek[$ask['id_kuesioner']],
						'nama_aspek' => $nama_aspek[$ask['id_kuesioner']],
						'nis' => $nis[$ask['id_kuesioner']],
						'jawabanHarapan' => $harapan[$ask['id_kuesioner']],
						'id_sekolah' => $id_sekolah,
						'harapanK' => $k,
						'harapanC' => $c,
						'harapanB' => $b,
						// 'harapanSB' => $sb,
						// 'jawabanKenyataan' => $nyata[$ask['id_kuesioner']],
						// 'kenyataanK' => $nk,
						// 'kenyataanC' => $nc,
						// 'kenyataanB' => $nb,
						// 'kenyataanSB' => $nsb,
					]);
				}
			}
			// dead($dataarray);
			$data = [
				'id_periode' => $periode['id_periode'],
				'nama_aspek' => "Careertest",
				'id_level' => $this->session->userdata('id_level'),
			];
			// var_dump($data);
			// die;
			$this->Mod_career->inputAnswer('respon_career', $dataarray);
			// $this->Mod_career->tambahSaran('komentar', $data);
			$this->session->set_flashdata('message', ' Di Kirim');
			redirect('career/siswa_career');
		}
	}
	function career_admin()
	{
		$data['title'] = "Career";
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$data['career_admin'] = $this->Mod_career->careeradmin($id_sekolah);

		$this->template->load('layoutbackend', 'career/career_admin', $data);
	}
	public function detail_career($nis)
	{
		$data['detail_career'] = $this->Mod_career->detail_career($nis);
		$this->template->load('layoutbackend', 'career/detail_career', $data);
	}
}
