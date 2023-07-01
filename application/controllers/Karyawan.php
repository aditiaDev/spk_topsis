<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        // if(!$this->session->userdata('id_user'))
        //   redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/karyawan');
    $this->load->view('template/footer');
	}

  public function getAllData(){
    $this->db->from('tb_karyawan_kontrak');
    $this->db->order_by('nm_karyawan', 'asc');
    $data['data'] = $this->db->get()->result();
    echo json_encode($data);
  }

  public function getUnit(){
    $data['data'] = $this->db->query("
      SELECT id_unit, nm_unit FROM tb_unit
      ORDER BY nm_unit
    ")->result(); 

  	echo json_encode($data);
  }

  public function generateId(){
    $unik = 'T'.date('y');
    $kode = $this->db->query("SELECT MAX(id_karyawan) LAST_NO FROM tb_karyawan_kontrak WHERE id_karyawan LIKE '".$unik."%'")->row()->LAST_NO;
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
    $this->form_validation->set_rules('nm_karyawan', 'nm_karyawan', 'required');
    $this->form_validation->set_rules('alamat_karyawan', 'alamat_karyawan', 'required');
    $this->form_validation->set_rules('id_unit', 'id_unit', 'required');
    $this->form_validation->set_rules('no_karyawan', 'no_karyawan', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');
    $this->form_validation->set_rules('tgl_masuk', 'tgl_masuk', 'required');
    $this->form_validation->set_rules('tgl_kontrak', 'tgl_kontrak', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_karyawan" => $id,
              "id_unit" => $this->input->post('id_unit'),
              "nm_karyawan" => $this->input->post('nm_karyawan'),
              "alamat_karyawan" => $this->input->post('alamat_karyawan'),
              "no_karyawan" => $this->input->post('no_karyawan'),
              "jenis_kelamin" => $this->input->post('jenis_kelamin'),
              "tgl_masuk" => $this->input->post('tgl_masuk'),
              "tgl_kontrak" => $this->input->post('tgl_kontrak'),
            );
    $this->db->insert('tb_karyawan_kontrak', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');
    $this->form_validation->set_rules('nm_karyawan', 'nm_karyawan', 'required');
    $this->form_validation->set_rules('alamat_karyawan', 'alamat_karyawan', 'required');
    $this->form_validation->set_rules('id_unit', 'id_unit', 'required');
    $this->form_validation->set_rules('no_karyawan', 'no_karyawan', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');
    $this->form_validation->set_rules('tgl_masuk', 'tgl_masuk', 'required');
    $this->form_validation->set_rules('tgl_kontrak', 'tgl_kontrak', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
        "id_unit" => $this->input->post('id_unit'),
        "nm_karyawan" => $this->input->post('nm_karyawan'),
        "alamat_karyawan" => $this->input->post('alamat_karyawan'),
        "no_karyawan" => $this->input->post('no_karyawan'),
        "jenis_kelamin" => $this->input->post('jenis_kelamin'),
        "tgl_masuk" => $this->input->post('tgl_masuk'),
        "tgl_kontrak" => $this->input->post('tgl_kontrak'),
    );
    $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
    $this->db->update('tb_karyawan_kontrak', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
    $this->db->delete('tb_karyawan_kontrak');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }
}
