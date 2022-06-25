<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_sekolah');
        $this->load->library('form_validation');

        // backButtonHandle();
    }

    function index()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $data['title'] = "Sekolah";
        // $nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        // $nis = $nis['id_user'];
        $data['sekolah']  = $this->Mod_sekolah->getsekolah();
       
        // dead($data['nis']['nis']);
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $this->template->load('layoutbackend', 'admin/sekolah', $data);
        }
    }
    function insert()
    {
        $data = array(
            'id' => rand(0000, 9999),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        // dead($data);
        $this->db->insert('sekolah', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        
        Tambah sekolah Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('sekolah');
    }
    public function update()
    {

        $id      = $this->input->post('id');
        $save  = array(

            'id' => $id,
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        // dead($save);
        $this->Mod_sekolah->update($id, $save);
        redirect('sekolah');
    }
    public function delete()
    {
        $id = $this->input->get('id');
        $this->db->delete('sekolah', array('id' => $id));
        redirect('sekolah');
    }
}
