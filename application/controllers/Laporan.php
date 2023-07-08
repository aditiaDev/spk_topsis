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
}
