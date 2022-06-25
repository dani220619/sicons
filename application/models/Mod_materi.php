<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_materi extends CI_Model
{

	var $table = 'materi';

	var $column_order = array('id', 'title', 'tanggal', 'file', 'is_active');
	var $column_search = array('id', 'title', 'tanggal', 'is_active');
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$id_sekolah = $id['id_sekolah'];
		$this->db->from($this->table);
		$this->db->where('id_sekolah', $id_sekolah);
		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{

		$this->db->from('materi');
		return $this->db->count_all_results();
	}

	function cektitle($username)
	{
		$this->db->where("title", $username);
		return $this->db->get("materi");
	}

	function getAll()
	{
		return $this->db->get('materi');
	}

	function view_materi($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('materi');
	}

	function get_nama_materi($nama_materi)
	{
		$this->db->from($this->table);
		$this->db->where('nama_materi', $nama_materi);
		$query = $this->db->get();

		return $query->row();
	}

	function get_materi($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('materi')->row();
	}

	function edit_materi($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('materi');
	}

	function insertmateri($tabel, $data)
	{
		$insert = $this->db->insert($tabel, $data);
		return $insert;
	}

	//khusus administrator
	function insertaksesmateri($tbl_akses_materi, $data)
	{
		$insert = $this->db->insert($tbl_akses_materi, $data);
		return $insert;
	}

	function updatemateri($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('materi', $data);
	}
	function deletemateri($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	function deleteakses($id, $tbl_akses_materi)
	{
		$this->db->where('id', $id);
		$this->db->delete($tbl_akses_materi);
	}
	function deleteakses_submateri($id, $tbl_akses_submateri)
	{
		$this->db->where('id', $id);
		$this->db->delete($tbl_akses_submateri);
	}
	function getImage($id)
	{
		$this->db->select('file');
		$this->db->from('materi');
		$this->db->where('id', $id);
		return $this->db->get();
	}
	public function post($id_sekolah)
	{
		$query = $this->db->query("
		SELECT * FROM materi where is_active = 'Y' and id_sekolah = '" . $id_sekolah . "' order by tanggal asc");
		return $query->result();
	}
	public function getid($id)
	{
		$query = $this->db->query("
				
		SELECT * 
		FROM materi 
		WHERE id = " . $id . "");
		return $query;
	}
	public function download($id)
	{
		$query = $this->db->query("
				
		SELECT file
		FROM materi 
		WHERE id = " . $id . "");
		return $query->row_array();
	}
}

/* End of file Mod_login.php */
