<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_user');
        // backButtonHandle();
    }

    function index()
    {
        $nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['detail'] = $nis;
        $klayent = '3';
        $konsoler = '2';
        $admin = '1';
        // dead($data['detail']);
        // $data['detail'] = $this->;
        $data['totklayent'] = $this->Mod_user->gettotal($klayent)->row_array();
        $data['totkonsoler'] = $this->Mod_user->gettotal($konsoler)->row_array();
        $data['totadmin'] = $this->Mod_user->gettotal($admin)->row_array();
        // dead($data['total_klayent']);
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $this->template->load('layoutbackend', 'dashboard/dashboard_data', $data);
        }
    }
}
/* End of file Controllername.php */
