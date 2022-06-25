<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Materi extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_materi');
		$this->load->helper('url', 'download');
	}

	public function index()
	{
		// $this->load->helper('url');
		$this->template->load('layoutbackend', 'materi/index');
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);

		$list = $this->Mod_materi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $materi) {
			$no++;
			$row = array();

			$row[] = $materi->title;
			$row[] = $materi->tanggal;
			$row[] = $materi->deskripsi;
			$row[] = $materi->link;
			$row[] = $materi->file;
			$row[] = $materi->is_active;
			$row[] = $materi->id;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_materi->count_all(),
			"recordsFiltered" => $this->Mod_materi->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function addmateri()
	{
		$this->load->view('admin/add_materi');
	}

	public function viewmateri()
	{
		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data['table'] = $table;
		$data['data_field'] = $this->db->field_data($table);
		$data['data_table'] = $this->Mod_materi->view_materi($id)->result_array();
		$this->load->view('materi/view', $data);
	}

	public function editmateri($id)
	{
		$data = $this->Mod_materi->get_materi($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->_validate();
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$title = $this->input->post('title');
		$cek = $this->Mod_materi->cektitle($title);
		if ($cek->num_rows() > 0) {
			echo json_encode(array("error" => "title Sudah Ada!!"));
		} else {
			$nama = slug($this->input->post('title'));
			$config['upload_path']   = './assets/file/materi_session/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx'; //mencegah upload backdor
			$config['max_size']      = '9000';
			$config['max_width']     = '9000';
			$config['max_height']    = '9024';
			$config['file_name']     = $nama;

			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {

				$gambar = $this->upload->data();
				$save  = array(
					'id' => rand(000, 999),
					'id_sekolah' => $id_sekolah,
					'title' => $this->input->post('title'),
					'tanggal'  => $this->input->post('tanggal'),
					'deskripsi'  => $this->input->post('deskripsi'),
					'is_active' => $this->input->post('is_active'),
					'file' => $gambar['file_name']
				);
				$this->Mod_materi->insertmateri("materi", $save);
				echo json_encode(array("status" => TRUE));
			} else { //Apabila tidak ada gambar yang di upload
				$save  = array(
					'id' => rand(000, 999),
					'id_sekolah' => $id_sekolah,
					'title' => $this->input->post('title'),
					'tanggal'  => $this->input->post('tanggal'),
					'deskripsi'  => $this->input->post('deskripsi'),
					'link'  => $this->input->post('link'),
					'is_active' => $this->input->post('is_active')

				);
				$this->Mod_materi->insertmateri("materi", $save);
				echo json_encode(array("status" => TRUE));
			}
		}
	}
	public function update()
	{
		if (!empty($_FILES['image']['name'])) {
			// $this->_validate();
			$id = $this->input->post('id');
			$nama = slug($this->input->post('title'));
			$config['upload_path']   = './assets/file/materi_session/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx'; //mencegah upload backdor
			$config['max_size']      = '1000';
			$config['max_width']     = '2000';
			$config['max_height']    = '1024';
			$config['file_name']     = $nama;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$gambar = $this->upload->data();
				//Jika Password tidak kosong
				if ($this->input->post('title')) {
					$save  = array(
						'title' => $this->input->post('title'),
						'id_sekolah' => $this->input->post('id_sekolah'),
						'tanggal' => $this->input->post('tanggal'),
						'is_active' => $this->input->post('is_active'),
						'deskripsi'  => $this->input->post('deskripsi'),
						'file' => $gambar['file_name']
					);
				} else { //Jika password kosong
					$save  = array(
						'title' => $this->input->post('title'),
						'id_sekolah' => $this->input->post('id_sekolah'),
						'tanggal' => $this->input->post('tanggal'),
						'is_active' => $this->input->post('is_active'),
						'deskripsi'  => $this->input->post('deskripsi'),
						'file' => $gambar['file_name']
					);
				}
				$g = $this->Mod_materi->getImage($id)->row_array();
				if ($g != null) {
					//hapus gambar yg ada diserver
					unlink('assets/file/materi_session/' . $g['file']);
				}
				$this->Mod_materi->updatemateri($id, $save);
				echo json_encode(array("status" => TRUE));
			}
		}
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$g = $this->Mod_materi->getImage($id)->row_array();
		if ($g != true) {
			//hapus gambar yg ada diserver
			unlink('assets/file/materi_session/' . $g['file']);
		}
		$this->Mod_materi->deletemateri($id, 'materi');
		$data['status'] = TRUE;
		echo json_encode($data);
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		if ($this->input->post('title') == '') {
			$data['inputerror'][] = 'title';
			$data['error_string'][] = 'Title is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('is_active') == '') {
			$data['inputerror'][] = 'is_active';
			$data['error_string'][] = 'Please select Is Active';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	public function siswa_session()
	{
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$data['posts'] = $this->Mod_materi->post($id_sekolah);
		// dead($data['posts']);
		$this->template->load('layoutbackend', 'materi/siswa_session', $data);
	}
	public function open_file($id)
	{
		$data['materi']  = $this->Mod_materi->getid($id)->row();
		$data['link'] = $this->Mod_materi->getid($id)->result();
		// dead($data['link']);
		$this->template->load('layoutbackend', 'materi/open_file', $data);
	}
	public function aksi_download($id)
	{
		$fileinfo = $this->Mod_materi->download($id);
		$file = 'assets/file/materi_session/' . $fileinfo['file'];
		// var_dump($fileinfo);
		// die;
		force_download($file, null);
		// $this->template->load('layoutbackend', 'materi/download', $data, $file);
	}
}
