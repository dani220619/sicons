<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Siswa extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_siswa');
		$this->load->model('Mod_sekolah');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['user'] = $this->Mod_siswa->getAll();
		$data['sekolah']  = $this->Mod_sekolah->getsekolah();
		$data['user_level'] = $this->Mod_siswa->userlevel();
		$this->template->load('layoutbackend', 'siswa/index', $data);
	}

	public function ajax_list_siswa()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->Mod_siswa->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $user->image;
			$row[] = $user->username;
			$row[] = $user->full_name;
			$row[] = $user->nama_level;
			$row[] = $user->nama;
			$row[] = $user->id_user;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mod_siswa->count_all(),
			"recordsFiltered" => $this->Mod_siswa->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function insert()
	{
		// var_dump($this->input->post('username'));
		$this->_validate();
		$username = $this->input->post('username');
		$cek = $this->Mod_siswa->cekUsername($username);
		if ($cek->num_rows() > 0) {
			echo json_encode(array("error" => "Username Sudah Ada!!"));
		} else {
			$nama = slug($this->input->post('username'));
			$config['upload_path']   = './assets/foto/user/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
			$config['max_size']      = '9000';
			$config['max_width']     = '9000';
			$config['max_height']    = '9024';
			$config['file_name']     = $nama;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('imagefile')) {
				$gambar = $this->upload->data();

				$save  = array(
					'nis' => $this->input->post('nis'),
					'id_sekolah' => $this->input->post('id_sekolah'),
					'no_tlp' => $this->input->post('no_tlp'),
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'password'  => get_hash($this->input->post('password')),
					'email' => $this->input->post('email'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'alamat' => $this->input->post('alamat'),
					'id_level'  => $this->input->post('level'),
					'is_active' => $this->input->post('is_active'),
					'image' => $gambar['file_name']
				);

				$this->Mod_siswa->insertsiswa("tbl_user", $save);
				echo json_encode(array("status" => TRUE));
			} else { //Apabila tidak ada gambar yang di upload
				$save  = array(
					'nis' => $this->input->post('nis'),
					'id_sekolah' => $this->input->post('id_sekolah'),
					'no_tlp' => $this->input->post('no_tlp'),
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'password'  => get_hash($this->input->post('password')),
					'email' => $this->input->post('email'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'alamat' => $this->input->post('alamat'),
					'id_level'  => $this->input->post('level'),
					'is_active' => $this->input->post('is_active'),
				);

				$this->Mod_siswa->insertsiswa("tbl_user", $save);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	public function viewsiswa()
	{
		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data['table'] = $table;
		$data['data_field'] = $this->db->field_data($table);
		$data['data_table'] = $this->Mod_siswa->view_siswa($id)->result_array();
		$this->load->view('siswa/view', $data);
	}

	public function editsiswa($id)
	{

		$data = $this->Mod_siswa->getsiswa($id);
		echo json_encode($data);
	}


	public function update()
	{
		if (!empty($_FILES['imagefile']['name'])) {
			// $this->_validate();
			$id = $this->input->post('id_user');

			$nama = slug($this->input->post('username'));
			$config['upload_path']   = './assets/foto/user/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
			$config['max_size']      = '9000';
			$config['max_width']     = '9000';
			$config['max_height']    = '9024';
			$config['file_name']     = $nama;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('imagefile')) {
				$gambar = $this->upload->data();
				//Jika Password tidak kosong
				if ($this->input->post('password')) {
					$save  = array(
						'nis' => $this->input->post('nis'),
						'username' => $this->input->post('username'),
						'full_name' => $this->input->post('full_name'),
						'password'  => get_hash($this->input->post('password')),
						'id_sekolah' => $this->input->post('id_sekolah'),
						'email' => $this->input->post('email'),
						'tempat_lahir' => $this->input->post('tempat_lahir'),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'alamat' => $this->input->post('alamat'),
						'id_level'  => $this->input->post('level'),
						'is_active' => $this->input->post('is_active'),
						'image' => $gambar['file_name']
					);
				} else { //Jika password kosong
					$save  = array(
						'nis' => $this->input->post('nis'),
						'username' => $this->input->post('username'),
						'full_name' => $this->input->post('full_name'),
						'email' => $this->input->post('email'),
						'tempat_lahir' => $this->input->post('tempat_lahir'),
						'id_sekolah' => $this->input->post('id_sekolah'),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'alamat' => $this->input->post('alamat'),
						'id_level'  => $this->input->post('level'),
						'is_active' => $this->input->post('is_active'),
						'image' => $gambar['file_name']
					);
				}


				$g = $this->Mod_siswa->getImage($id)->row_array();

				if ($g != true) {
					//hapus gambar yg ada diserver
					unlink('assets/foto/siswa/' . $g['image']);
				}

				$this->Mod_siswa->updatesiswa($id, $save);
				echo json_encode(array("status" => TRUE));
			} else { //Apabila tidak ada gambar yang di upload

				//Jika Password tidak kosong
				if ($this->input->post('password')) {
					$save  = array(
						'nis' => $this->input->post('nis'),
						'username' => $this->input->post('username'),
						'full_name' => $this->input->post('full_name'),
						'password'  => get_hash($this->input->post('password')),
						'id_sekolah' => $this->input->post('id_sekolah'),
						'email' => $this->input->post('email'),
						'tempat_lahir' => $this->input->post('tempat_lahir'),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'alamat' => $this->input->post('alamat'),
						'id_level'  => $this->input->post('level'),
						'is_active' => $this->input->post('is_active'),
					);
				} else { //Jika password kosong
					$save  = array(
						'nis' => $this->input->post('nis'),
						'username' => $this->input->post('username'),
						'full_name' => $this->input->post('full_name'),
						'email' => $this->input->post('email'),
						'tempat_lahir' => $this->input->post('tempat_lahir'),
						'id_sekolah' => $this->input->post('id_sekolah'),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'alamat' => $this->input->post('alamat'),
						'id_level'  => $this->input->post('level'),
						'is_active' => $this->input->post('is_active'),
					);
				}

				$this->Mod_siswa->updatesiswa($id, $save);
				echo json_encode(array("status" => TRUE));
			}
		} else {
			// $this->_validate();
			$id_user = $this->input->post('id_user');
			if ($this->input->post('password')) {
				$save  = array(
					'nis' => $this->input->post('nis'),
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'password'  => get_hash($this->input->post('password')),
					'id_sekolah' => $this->input->post('id_sekolah'),
					'email' => $this->input->post('email'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'alamat' => $this->input->post('alamat'),
					'id_level'  => $this->input->post('level'),
					'is_active' => $this->input->post('is_active'),
				);
			} else {
				$save  = array(
					'nis' => $this->input->post('nis'),
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'email' => $this->input->post('email'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'id_sekolah' => $this->input->post('id_sekolah'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'alamat' => $this->input->post('alamat'),
					'id_level'  => $this->input->post('level'),
					'is_active' => $this->input->post('is_active'),
				);
			}

			$this->Mod_siswa->updatesiswa($id_user, $save);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$g = $this->Mod_siswa->getImage($id)->row_array();
		if ($g != null) {
			//hapus gambar yg ada diserver
			unlink('assets/foto/user/' . $g['image']);
		}
		$this->Mod_siswa->deleteUsers($id, 'tbl_user');
		$data['status'] = TRUE;
		echo json_encode($data);
	}

	public function reset()
	{
		$id = $this->input->post('id');
		$data = array(
			'password'  => get_hash('password')
		);
		$this->Mod_siswa->reset_pass($id, $data);
		$data['status'] = TRUE;
		echo json_encode($data);
	}

	public function download()
	{

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Username');
		$sheet->setCellValue('C1', 'Full name');
		$sheet->setCellValue('D1', 'password');
		$sheet->setCellValue('E1', 'level');
		$sheet->setCellValue('F1', 'Image');
		$sheet->setCellValue('G1', 'Active');

		$user = $this->Mod_siswa->getAll()->result();
		$no = 1;
		$x = 2;
		foreach ($user as $row) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $row->username);
			$sheet->setCellValue('C' . $x, $row->full_name);
			$sheet->setCellValue('D' . $x, $row->password);
			$sheet->setCellValue('E' . $x, $row->nama_level);
			$sheet->setCellValue('F' . $x, $row->image);
			$sheet->setCellValue('F' . $x, $row->is_active);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'laporan-User';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('username') == '') {
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('full_name') == '') {
			$data['inputerror'][] = 'full_name';
			$data['error_string'][] = 'Full Name is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('password') == '') {
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('is_active') == '') {
			$data['inputerror'][] = 'is_active';
			$data['error_string'][] = 'Please select Is Active';
			$data['status'] = FALSE;
		}

		if ($this->input->post('level') == '') {
			$data['inputerror'][] = 'level';
			$data['error_string'][] = 'Please select is level';
			$data['status'] = FALSE;
		}

		/*if($this->input->post('image') == '')
        {
            $data['inputerror'][] = 'image';
            $data['error_string'][] = 'Image is required';
            $data['status'] = FALSE;
        }*/

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
