<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

use Dompdf\Dompdf;

class Arsip extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('tglindo');
		$this->load->model('Arsip_model', 'arsip');
	}
	public function index()
	{
		$data['title'] = 'Arsip Surat';
		$this->form_validation->set_rules('nomor_surat', 'Nomor surat', 'required');
		$this->form_validation->set_rules('judul_surat', 'judul', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['surat'] = $this->db->get('tb_surat')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_arsip', $data);
			$this->load->view('arsip/index', $data);
			$this->load->view('templates/footer');
		} else {
			$config['upload_path'] = './assets/file/';
			$config['allowed_types'] = 'pdf';
			$now = date('Y-m-d-H-i-s');
			$config['file_name'] = $now . '.pdf';
			$config['max_size'] = 0;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			$pet = $config['file_name'];
			$data = [
				"nomor_surat" => $this->input->post('nomor_surat', true),
				"kategori_surat" => $this->input->post('kategori_surat', true),
				"judul_surat" => $this->input->post('judul_surat', true),
				"path" => $pet,
				'waktu_pengarsipan' => date('Y-m-d H:i:s')
			];
			$this->arsip->tambahData($data);
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('arsip/index');
		}
	}

	public function tambah()
	{
		$data['title'] = 'Arsip Unggah';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_arsip', $data);
		$this->load->view('arsip/tambah', $data);
		$this->load->view('templates/footer');
	}

	public function edit_jenis()
	{
		$id_jenis = $this->input->post('id_jenis');
		$jenis_rapat = $this->input->post('jenis_rapat');
		$status_jenis = $this->input->post('status_jenis');
		$this->db->set('jenis_rapat', $jenis_rapat);
		$this->db->set('status_jenis', $status_jenis);
		$this->db->where('id_jenis', $id_jenis);
		$this->db->update('mst_jenis');
		$this->session->set_flashdata('message', 'Simpan Perubahan');
		redirect('arsip/index');
	}

	public function hapusSurat($id_surat)
	{
		$this->db->where('id_surat', $id_surat);
		$this->db->delete('tb_surat');
		$this->session->set_flashdata('message', 'Penghapusan Arsip Surat');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function about()
	{
		$data['title'] = 'About';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_arsip', $data);
		$this->load->view('arsip/about', $data);
		$this->load->view('templates/footer');
	}

	public function lihat($id_surat)
	{
		$data['title'] = 'Detail Arsip Surat';
		$data['unduh_satuan'] = $this->db->get_where('tb_surat', ['id_surat' => $id_surat])->result_array();
		$data['list_surat'] = $this->arsip->getSuratId($id_surat);
		$data['surat'] = $this->db->get('tb_surat')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_arsip', $data);
		$this->load->view('arsip/detail', $data);
		$this->load->view('templates/footer');
	}
	public function view($id_surat)
	{
		$data['title'] = 'Tampil Arsip Surat >> Lihat';
		$data['list_surat'] = $this->arsip->getSuratId($id_surat);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_arsip', $data);
		$this->load->view('arsip/view', $data);
		$this->load->view('templates/footer');
	}

	public function ubah()
	{
		$data['title'] = 'Ubah Arsip Surat';
		$data['kategori_surat'] = ['undangan', 'pengumuman', 'nota dinas', 'pemberitahuan'];
		$this->form_validation->set_rules('nomor_surat', 'Nomor surat', 'required');
		$this->form_validation->set_rules('judul_surat', 'judul', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_arsip', $data);
			$this->load->view('arsip/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			if ($_FILES["userfile"]["name"] !== '') {
				$config['upload_path'] = './assets/file/';
				$config['allowed_types'] = 'pdf';
				$now = date('Y-m-d-H-i-s');
				$config['file_name'] =
					$now . '.pdf';
				$config['max_size'] = 0;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('userfile')) {
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
				} else {
					$data = array('upload_data' => $this->upload->data());
				}

				$pet = $config['file_name'];
				$id_surat = $this->input->post('id_surat');
				$nomor_surat = $this->input->post('nomor_surat');
				$kategori_surat = $this->input->post('kategori_surat');
				$judul_surat = $this->input->post('judul_surat');

				$this->db->set('nomor_surat', $nomor_surat);
				$this->db->set('kategori_surat', $kategori_surat);
				$this->db->set('judul_surat', $judul_surat);
				$this->db->set('path', $pet);

				$this->db->where('id_surat', $id_surat);
				$this->db->update('tb_surat');
				$this->session->set_flashdata('message', 'Simpan Data');
				redirect('arsip/index');
			}
		}
	}

	public function unduh($id_surat)
	{
		$this->load->helper('download');
		$fileinfo = $this->arsip->unduh($id_surat);
		$filenama = 'assets/file/' . $fileinfo['path'];
		force_download($filenama, NULL);
	}
}
