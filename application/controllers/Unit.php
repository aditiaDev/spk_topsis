<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        // if(!$this->session->userdata('id_user'))
        //   redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/unit');
    $this->load->view('template/footer');
	}

  public function getAllData(){
    $this->db->from('tb_unit');
    $this->db->order_by('nm_unit', 'asc');
    $data['data'] = $this->db->get()->result();
    echo json_encode($data);
  }

  public function getUser(){
    $data['data'] = $this->db->query("
      SELECT id_user, nm_pengguna FROM tb_user
      WHERE level = 'KEPALA UNIT'
      ORDER BY nm_pengguna
    ")->result(); 

  	echo json_encode($data);
  }

  public function generateId(){
    $unik = 'A';
    $kode = $this->db->query("SELECT MAX(id_unit) LAST_NO FROM tb_unit WHERE id_unit LIKE '".$unik."%'")->row()->LAST_NO;
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
    $this->form_validation->set_rules('nm_unit', 'nm_unit', 'required|is_unique[tb_unit.nm_unit]');

    $this->form_validation->set_rules('id_user', 'id_user', 'required|is_unique[tb_unit.id_user]');
    $this->form_validation->set_rules('kepala_unit', 'kepala_unit', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_unit" => $id,
              "nm_unit" => $this->input->post('nm_unit'),
              "id_user" => $this->input->post('id_user'),
              "kepala_unit" => $this->input->post('kepala_unit'),
            );
    $this->db->insert('tb_unit', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('nm_unit', 'nm_unit', 'required');
    $this->form_validation->set_rules('id_unit', 'id_unit', 'required');
    $this->form_validation->set_rules('id_user', 'id_user', 'required');
    $this->form_validation->set_rules('kepala_unit', 'kepala_unit', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
              "nm_unit" => $this->input->post('nm_unit'),
              "id_user" => $this->input->post('id_user'),
              "kepala_unit" => $this->input->post('kepala_unit'),
    );
    $this->db->where('id_unit', $this->input->post('id_unit'));
    $this->db->update('tb_unit', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_unit', $this->input->post('id_unit'));
    $this->db->delete('tb_unit');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }
}
