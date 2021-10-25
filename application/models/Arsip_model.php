<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_model extends CI_model
{
	public function getSuratId($id_surat)
	{
		$query = "SELECT * FROM tb_surat
                  WHERE tb_surat.id_surat = $id_surat";
		return $this->db->query($query)->row_array();
	}

	public function tambahData($data)
	{
		$this->db->insert('tb_surat', $data);
	}
	public function unduh($id_surat)
	{
		$query = $this->db->get_where('tb_surat', array('id_surat' => $id_surat));
		return $query->row_array();
	}
	public function Update()
	{
		$this->db->where('id_surat', $this->input->post('id_surat'));
		$this->db->update('tb_surat');
	}
}
