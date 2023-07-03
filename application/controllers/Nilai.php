<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        // if(!$this->session->userdata('id_user'))
        //   redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/nilai');
    $this->load->view('template/footer');
	}

  public function getAllData(){
    $data['data'] = $this->db->query("
      SELECT 
      A. id_penilaian_karyawan, A.id_karyawan, B.nm_karyawan, A.id_kriteria, CONCAT(A.id_kriteria, ' - ', C.nm_kriteria) AS kriteria, A.nilai_kriteria
      FROM tb_penilaian_karyawan A
      LEFT JOIN tb_karyawan_kontrak B ON A.id_karyawan = B.id_karyawan
      LEFT JOIN tb_kriteria C ON A.id_kriteria = C.id_kriteria
      ORDER BY A.id_kriteria, A.id_karyawan
    ")->result();
    echo json_encode($data);
  }

  public function getKaryawan(){
    $data['data'] = $this->db->query("
      SELECT id_karyawan, nm_karyawan FROM tb_karyawan_kontrak
      ORDER BY nm_karyawan
    ")->result(); 

  	echo json_encode($data);
  }

  public function getKriteria(){
    $data['data'] = $this->db->query("
      SELECT id_kriteria, nm_kriteria FROM tb_kriteria
      ORDER BY id_kriteria
    ")->result(); 

  	echo json_encode($data);
  }

  public function generateId(){
    $unik = 'N'.date('ym');
    $kode = $this->db->query("SELECT MAX(id_penilaian_karyawan) LAST_NO FROM tb_penilaian_karyawan WHERE id_penilaian_karyawan LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kode, 5, 6);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $unik;
    $kode = $huruf . sprintf("%06s", $urutan);
    return $kode;
  }

  public function saveData(){
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');

    $this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'required');
    $this->form_validation->set_rules('nilai_kriteria', 'nilai_kriteria', 'required|numeric');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $cek_duplicate = $this->db->query("
      SELECT COUNT(*) AS CEK FROM tb_penilaian_karyawan
      WHERE id_karyawan = '".$this->input->post('id_karyawan')."' AND id_kriteria = '".$this->input->post('id_kriteria')."'
    ")->row()->CEK;

    if($cek_duplicate > 0){
      $output = array("status" => "error", "message" => "Data Sudah Pernah di Input");
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_penilaian_karyawan" => $id,
              "id_karyawan" => $this->input->post('id_karyawan'),
              "id_kriteria" => $this->input->post('id_kriteria'),
              "nilai_kriteria" => $this->input->post('nilai_kriteria'),
            );
    $this->db->insert('tb_penilaian_karyawan', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_penilaian_karyawan', 'id_penilaian_karyawan', 'required');
    $this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');
    $this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'required');
    $this->form_validation->set_rules('nilai_kriteria', 'nilai_kriteria', 'required|numeric');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
      "id_karyawan" => $this->input->post('id_karyawan'),
      "id_kriteria" => $this->input->post('id_kriteria'),
      "nilai_kriteria" => $this->input->post('nilai_kriteria'),
    );
    $this->db->where('id_penilaian_karyawan', $this->input->post('id_penilaian_karyawan'));
    $this->db->update('tb_penilaian_karyawan', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_penilaian_karyawan', $this->input->post('id_penilaian_karyawan'));
    $this->db->delete('tb_penilaian_karyawan');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }
}
