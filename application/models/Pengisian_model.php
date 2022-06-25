<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengisian_model extends CI_model
{
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
	public function tot_kuesioner($nis, $id_level)
	{
		$query = $this->db->query('SELECT jawabanHarapan as harapan, jawabanKenyataan as nyata 
		from respon 
		where nis = "' . $nis . '" AND id_periode = "' . $id_level . '"');
		return $query;
	}
	public function tot_kuesioner_all($id_level)
	{
		$query = $this->db->query('SELECT jawabanHarapan as harapan, jawabanKenyataan as nyata 
		from respon 
		where id_periode = "' . $id_level . '"');
		return $query;
	}
}
