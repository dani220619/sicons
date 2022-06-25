<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_career extends CI_Model
{
	var $table = 'kuesioner';
	var $column_order = array('id_kuesioner', 'pertanyaan', 'id_aspek', 'id_level');
	var $column_search = array('id_kuesioner', 'pertanyaan', 'id_aspek', 'id_level');
	var $order = array('id_kuesioner' => 'desc'); // default order 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->where('id_aspek', '2');
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

	public function show_kuesioner($id)
	{
		$query = $this->db->query("
		select * from kuesioner where id_kuesioner = '" . $id . "' and
		id_aspek = '2'
		");
		return $query;
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{

		$this->db->from('kuesioner');
		return $this->db->count_all_results();
	}
	function getAll()
	{
		return $this->db->get('kuesioner');
	}

	function view_career($id)
	{
		$this->db->where('id_kuesioner', $id);
		return $this->db->get('kuesioner');
	}
	function insertkuesioner($tabel, $data)
	{
		$insert = $this->db->insert($tabel, $data);
		return $insert;
	}
	function get_career($id)
	{
		$this->db->where('id_kuesioner', $id);
		return $this->db->get('kuesioner')->row();
	}
	function updatekuesioner($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('kuesioner', $data);
	}
	function deletekuesioner($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	function showIsActive($table, $field)
	{
		return $this->db->get_where($table, $field);
	}
	function getAspekByType($table, $field)
	{
		return $this->db->get_where($table, $field);
	}
	function getAspekByTypee($table, $field)
	{
		$this->db->where($field);
		return $this->db->get($table);
	}
	function getAnserById($table, $field)
	{
		return $this->db->get_where($table, $field);
	}
	function inputAnswer($table, $data)
	{
		return $this->db->insert_batch($table, $data);
	}
	function tambahSaran($table, $data)
	{
		return $this->db->insert($table, $data);
	}
	public function tot_career($nis, $id_level)
	{
		$query = $this->db->query('SELECT jawabanHarapan as harapan, jawabanKenyataan as nyata 
		from respon_career
		where nis = "' . $nis . '" AND id_periode = "' . $id_level . '"');
		return $query;
	}
	public function getjawaban($nis)
	{
		$query = $this->db->query("
		select kuesioner.pertanyaan, respon_career.jawabanHarapan
		from respon_career
		left join kuesioner
		on respon_career.id_kuesioner=kuesioner.id_kuesioner
		where nis = " . $nis . "
		");
		return $query->result();
	}
	public function careeradmin($id_sekolah)
	{
		$query = $this->db->query("
		select * 
		from tbl_user 
		where id_level = '3' and id_sekolah = " . $id_sekolah . " 
		");
		return $query->result();
	}
	public function detail_career($nis)
	{
		$query = $this->db->query("
		select kuesioner.pertanyaan, respon_career.jawabanHarapan
		from respon_career
		left join kuesioner
		on respon_career.id_kuesioner=kuesioner.id_kuesioner
		where nis = " . $nis . "
		");
		return $query->result();
	}
}
