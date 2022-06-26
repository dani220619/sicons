<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_login'));
        $this->load->model(array('Mod_siswa'));
        $this->load->model(array('Mod_sekolah'));
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in == TRUE) {
            redirect('dashboard');
        } else {
            $aplikasi['aplikasi'] = $this->Mod_login->Aplikasi()->row();
            $this->load->view('admin/login_data', $aplikasi);
        }
    } //end function index

    function login()
    {

        $this->_validate();
        //cek username database
        $username = anti_injection($this->input->post('username'));

        if ($this->Mod_login->check_db($username)->num_rows() == 1) {
            $db = $this->Mod_login->check_db($username)->row();
            $apl = $this->Mod_login->Aplikasi()->row();

            if (hash_verified(anti_injection($this->input->post('password')), $db->password)) {
                //cek username dan password yg ada di database
                $userdata = array(
                    'id_user'  => $db->id_user,
                    'username'    => ucfirst($db->username),
                    'full_name'   => ucfirst($db->full_name),
                    'password'    => $db->password,
                    'id_level'    => $db->id_level,
                    'aplikasi'    => $apl->nama_aplikasi,
                    'title'       => $apl->title,
                    'logo'        => $apl->logo,
                    'nama_owner'     => $apl->nama_owner,
                    'image'       => $db->image,
                    'logged_in'    => TRUE
                );

                $this->session->set_userdata($userdata);
                $data['status'] = TRUE;
                echo json_encode($data);
            } else {

                $data['pesan'] = "Username atau Password Salah!";
                $data['error'] = TRUE;
                echo json_encode($data);
            }
        } else {
            $data['pesan'] = "Username atau Password belum terdaftar!";
            $data['error'] = TRUE;
            echo json_encode($data);
        }
    }
    public function register()
    {
        $aplikasi['sekolah']  = $this->Mod_sekolah->getsekolah();
        // dead($data['sekolah']);
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in == TRUE) {
            redirect('dashboard');
        } else {
            $aplikasi['aplikasi'] = $this->Mod_login->Aplikasi()->row();
            $this->load->view('admin/register', $aplikasi);
        }
    } //end function index
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
                    'id_sekolah'   => $this->input->post('id_sekolah'),
                    'no_tlp'   => $this->input->post('no_tlp'),
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'email' => $this->input->post('email'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => "3",
                    'is_active' => "Y",
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_siswa->insertsiswa("tbl_user", $save);
                redirect('login');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'nis' => $this->input->post('nis'),
                    'username' => $this->input->post('username'),
                    'id_sekolah'   => $this->input->post('id_sekolah'),
                    'no_tlp'   => $this->input->post('no_tlp'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'email' => $this->input->post('email'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => "3",
                    'is_active' => "Y",
                );
                // dead($save);
                $this->Mod_siswa->insertsiswa("tbl_user", $save);
                redirect('login');
            }
        }
    }
    function input_siswa()
    {
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/siswa/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save = array(
                    'id_user' => rand(000, 999),
                    'nis' => $this->input->post('nis'),
                    'id_sekolah'   => $this->input->post('id_sekolah'),
                    'username' => $this->input->post('username'),
                    'full_name'   => $this->input->post('full_name'),
                    'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'email'   => $this->input->post('email'),
                    'tempat_lahir'   => $this->input->post('tempat_lahir'),
                    'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
                    'no_tlp'   => $this->input->post('no_tlp'),
                    'tgl_lahir'   => $this->input->post('tgl_lahir'),
                    'alamat'   => $this->input->post('alamat'),
                    'id_level'   => '3',
                    'is_active'   => 'Y',
                );
                // dead($save);
                $this->db->insert($save, 'tbl_user');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Tahun Ajaran berhasil ditambahkan !
      </div>');
                redirect('login');
            }
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $this->load->driver('cache');
        $this->cache->clean();
        ob_clean();
        redirect('login');
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



        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password is required';
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

/* End of file Login.php */
