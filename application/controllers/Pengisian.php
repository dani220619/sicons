<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengisian extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pengisian_model');
		$this->load->model('Mod_konseling');
	}
	function kuesioner()
	{
		$data['title'] = "Pengisian Kuesioner";
		$data['a'] = "Layanan Akademik";
		$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$nis = $nis['nis'];

		$data['periode'] = $this->pengisian_model->showIsActive('periode', ['isaktif' => true])->row_array();
		$periode = $data['periode'];
		$data['aspek'] = $this->pengisian_model->getAspekByType('aspek', ['nama_aspek' => 'Kuesioner'])->result_array();
		$data['answer'] = $this->pengisian_model->getAnserById('respon', ['nis' => $nis, 'id_periode' => $periode['id_periode']])->row_array();
		$data['total'] = $this->pengisian_model->tot_kuesioner($nis, $periode['id_periode']);

		// dead($id_aspek);
		if ($this->form_validation->run() == false) {
			$this->template->load('layoutbackend', 'kuesioner/kuesioner', $data);
		}

		//jika form validasi benar
		if (!empty($this->input->post('submitted'))) {
			$nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
			$id_sekolah = $nis['id_sekolah'];
			$aspek = $this->pengisian_model->getAspekByTypee('aspek', ['nama_aspek' => 'Kuesioner'])->result_array();

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
					if ($harapan[$ask['id_kuesioner']] == 1) {
						$k = 1;
						$c = 0;
						// $b = 0;
						// $sb = 0;
					} elseif ($harapan[$ask['id_kuesioner']] == 2) {
						$k = 0;
						$c = 1;
						// $b = 0;
						// $sb = 0;
					} elseif ($harapan[$ask['id_kuesioner']] == 3) {
						$k = 0;
						$c = 0;
						// $b = 1;
						// $sb = 0;
					} else {
						$k = 1;
						$c = 0;
						// $b = 0;
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
					array_push($dataarray, [
						'id_periode' => $id_periode[$ask['id_kuesioner']],
						'id_kuesioner' => $id_kuesioner[$ask['id_kuesioner']],
						'id_aspek' => $id_aspek[$ask['id_kuesioner']],
						'nama_aspek' => $nama_aspek[$ask['id_kuesioner']],
						'nis' => $nis[$ask['id_kuesioner']],
						'jawabanHarapan' => $harapan[$ask['id_kuesioner']],
						'id_sekolah' => $id_sekolah,
						'harapanK' => $k,
						// 'harapanC' => $c,
						// 'harapanB' => $b,
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
				'typeaspek' => "Kuesioner",
				'id_level' => $this->session->userdata('id_level'),
			];
			// var_dump($data);
			// die;
			$this->pengisian_model->inputAnswer('respon', $dataarray);
			// $this->pengisian_model->tambahSaran('komentar', $data);
			$this->session->set_flashdata('message', ' Di Kirim');
			redirect('pengisian/kuesioner');
		}
	}
}
