<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_sekolah extends CI_Model
{

    public function getsekolah()
    {
        $query = $this->db->query("
		select * from sekolah");
        return $query->result();
    }
    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('sekolah', $data);
    }
}
