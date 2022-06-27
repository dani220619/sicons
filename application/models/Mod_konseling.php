<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_konseling extends CI_Model
{

	public function showkonseling($nis)
	{
		$query = $this->db->query("
		select k.*, tu.full_name
		from konseling k
		left join tbl_user tu
		on k.id_user=tu.id_user
		where k.nis = '" . $nis . "' and
		tu.id_level = '2'
		and k.is_active = 'IK'
		");
		return $query->result();
	}
	public function showgroupkonseling($id_sekolah, $nis)
	{
		$query = $this->db->query("
		select k.*, tu.full_name as name_guru, s.nama
				from konseling k
				left join tbl_user tu
				on k.id_user=tu.id_user
				left join sekolah s
        		on k.id_sekolah=s.id
				where k.is_active = 'GK' and k.id_sekolah = '" . $id_sekolah . "' and k.nis = " . $nis . "
		");
		return $query->result();
	}
	function getguru($id_sekolah)
	{
		$query = $this->db->query("
		select * from tbl_user where id_level =  2 and id_sekolah = " . $id_sekolah . "  ");
		return $query->result();
	}
	function getnis($id)
	{
		$query = $this->db->query("
		select * from tbl_user where id_user =   $id   ");
		return $query->row_array();
	}
	function update_konseling($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function jawb_konseling($id)
	{
		$query = $this->db->query("
		select tu.nis, tu.full_name, k.subject, k.*
			from konseling k
			left join tbl_user tu
			on k.nis=tu.nis
			where k.id_user = " . $id . "
			");
		return $query->result();
	}
	public function jawb_konseling_all($id_sekolah)
	{
		$query = $this->db->query("
		select tu.nis, tu.full_name, k.subject, k.*
			from konseling k
			left join tbl_user tu
			on k.nis=tu.nis 
			where k.is_active = 'GK' and tu.id_sekolah = '" . $id_sekolah . "'
			");
		return $query->result();
	}
	public function jawaban($nis)
	{
		$query = $this->db->query("
		select tu.nis, tu.full_name, k.subject, k.*
			from konseling k
			left join tbl_user tu
			on k.nis=tu.nis
			where k.nis = " . $nis . " and k.is_active = 'IK'");
		return $query->result();
	}
	public function jawaban_all($id_sekolah, $nis)
	{
		$query = $this->db->query("
		select tu.nis, tu.full_name, k.subject, k.*
			from konseling k
			left join tbl_user tu
			on k.nis=tu.nis
			where k.is_active = 'GK'
			and k.id_sekolah = " . $id_sekolah . " and tu.nis= " . $nis . "
			");
		return $query->result();
	}
	function updatekonseling($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('konseling', $data);
	}
}
