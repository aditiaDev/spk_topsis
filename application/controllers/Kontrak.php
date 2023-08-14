<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        // if(!$this->session->userdata('id_user'))
        //   redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
        $this->load->view('template/topmenu');
        $this->load->view('pages/kontrak');
        $this->load->view('template/footer');
	}

  public function getAllData(){
    $this->db->from('tb_batas_kontrak');
    $this->db->order_by('id_batas_kontrak', 'asc');
    $data['data'] = $this->db->get()->result();
    echo json_encode($data);
  }

  public function generateId(){
    $unik = 'B';
    $kode = $this->db->query("SELECT MAX(id_batas_kontrak) LAST_NO FROM tb_batas_kontrak WHERE id_batas_kontrak LIKE '".$unik."%'")->row()->LAST_NO;
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kode, 1, 5);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $unik;
    $kode = $huruf . sprintf("%05s", $urutan);
    return $kode;
  }

  public function saveData(){
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nilai_batas', 'Nilai Batas', 'required|numeric');
    $this->form_validation->set_rules('kebutuhan_karyawan', 'Kebutuhan Karyawan', 'required|numeric');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_batas_kontrak" => $id,
              "nilai_batas" => $this->input->post('nilai_batas'),
              "kebutuhan_karyawan" => $this->input->post('kebutuhan_karyawan'),
            );
    $this->db->insert('tb_batas_kontrak', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('nilai_batas', 'Nilai Batas', 'required|numeric');
    $this->form_validation->set_rules('kebutuhan_karyawan', 'Kebutuhan Karyawan', 'required|numeric');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
        "nilai_batas" => $this->input->post('nilai_batas'),
        "kebutuhan_karyawan" => $this->input->post('kebutuhan_karyawan'),
    );
    $this->db->where('id_batas_kontrak', $this->input->post('id_batas_kontrak'));
    $this->db->update('tb_batas_kontrak', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_batas_kontrak', $this->input->post('id_batas_kontrak'));
    $this->db->delete('tb_batas_kontrak');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }
}
