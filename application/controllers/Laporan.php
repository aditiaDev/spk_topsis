<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        if(!$this->session->userdata('id_user'))
          redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/hasil');
    $this->load->view('template/footer');
	}

  public function laporan_status(){

    $data['data'] = $this->db->query("
      SELECT A.rank, A.id_hasil, A.id_karyawan, B.nm_karyawan, concat(C.kebutuhan_karyawan, ' Orang') as kebutuhan_karyawan, C.nilai_batas,
      A.tgl_penilaian, A.keterangan, A.nilai 
      FROM tb_hasil_penilaian A
      LEFT JOIN tb_karyawan_kontrak B ON A.id_karyawan = B.id_karyawan
      LEFT JOIN tb_batas_kontrak C ON A.id_batas_kontrak = C.id_batas_kontrak
      WHERE A.keterangan LIKE '%".$this->input->post('keterangan')."%'
      ORDER BY rank
    ")->result_array();

    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan.pdf";
    $this->pdf->load_view('laporan/laporan', $data);


  }

  public function rptHasil(){
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/rpthasil');
    $this->load->view('template/footer');
	}

  public function ctkHasil(){

    $data['data'] = $this->db->query("
      SELECT A.rank, A.id_hasil, A.id_karyawan, B.nm_karyawan, 
      concat(C.kebutuhan_karyawan, ' Orang') as kebutuhan_karyawan, C.nilai_batas,
      A.tgl_penilaian, A.keterangan, A.nilai,
      B.id_unit, D.nm_unit, D.kepala_unit, B.tgl_kontrak  
      FROM tb_hasil_penilaian A
      LEFT JOIN tb_karyawan_kontrak B ON A.id_karyawan = B.id_karyawan
      LEFT JOIN tb_batas_kontrak C ON A.id_batas_kontrak = C.id_batas_kontrak
      LEFT JOIN tb_unit D ON B.id_unit = D.id_unit
      WHERE A.keterangan LIKE '%".$this->input->post('keterangan')."%'
      AND A.tgl_penilaian >= '".$this->input->post('from')."'
      and A.tgl_penilaian <= '".$this->input->post('to')."'
      and B.id_unit LIKE '%".$this->input->post('unit')."%'
      ORDER BY rank
    ")->result_array();

    $data['from'] = $this->input->post('from');
    $data['to'] = $this->input->post('to');

    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'landscape');
    $this->pdf->filename = "ctkHasil.pdf";
    $this->pdf->load_view('laporan/ctkHasil', $data);


  }
}
