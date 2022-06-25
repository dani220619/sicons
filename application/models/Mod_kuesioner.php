<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_kuesioner extends CI_Model
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
		$this->db->where('id_aspek', '1');
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
	public function show_kuesioner()
	{
		$query = $this->db->query("
		select * from kuesioner
		");
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

		$this->db->from('kuesioner');
		return $this->db->count_all_results();
	}
	function getAll()
	{
		return $this->db->get('kuesioner');
	}

	function view_kuesioner($id)
	{
		$this->db->where('id_kuesioner', $id);
		return $this->db->get('kuesioner');
	}
	function insertkuesioner($tabel, $data)
	{
		$insert = $this->db->insert($tabel, $data);
		return $insert;
	}
	function get_kuesioner($id)
	{
		$this->db->where('id_kuesioner', $id);
		return $this->db->get('kuesioner')->row();
	}
	function updatekuesioner($id, $data)
	{
		$this->db->where('id_kuesioner', $id);
		$this->db->update('kuesioner', $data);
	}
	function deletekuesioner($id, $table)
	{
		$this->db->where('id_kuesioner', $id);
		$this->db->delete($table);
	}
	public function aspek()
	{
		$query = $this->db->query("
		select * from aspek 
		where id_aspek = '1'
		");
		return $query->result();
	}
	public function level()
	{
		$query = $this->db->query("
		select * from tbl_user 
		where id_level = '3'
		");
		return $query->result();
	}
	public function kuesioneradmin($id_sekolah)
	{
		$query = $this->db->query("
		select * 
		from tbl_user 
		where id_level = '3' and id_sekolah = " . $id_sekolah . " 
		");
		return $query->result();
	}
	public function detail_kuesioner($nis)
	{
		$query = $this->db->query("
		select kuesioner.pertanyaan, respon.jawabanHarapan
		from respon
		left join kuesioner
		on respon.id_kuesioner=kuesioner.id_kuesioner
		where nis = " . $nis . "
		");
		return $query->result();
	}
	public function cetak()
	{
		$query = $this->db->query("
		select * 
		from tbl_user 
		where id_level = '3' and id_sekolah = " . $id_sekolah . " 
		");
		return $query->result();
	}
}
