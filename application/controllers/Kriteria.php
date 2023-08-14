<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        // if(!$this->session->userdata('id_user'))
        //   redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/kriteria');
    $this->load->view('template/footer');
	}

  public function getAllData(){
    // $this->db->from('tb_kriteria');
    // $this->db->order_by('id_kriteria', 'asc');

    $data['data'] = $this->db->query("
    SELECT 
      A.id_kriteria,
      A.nm_kriteria,
      A.jenis_kriteria,
      A.bobot_kriteria,
      case when A.bobot_kriteria = '5' then 'Sangat Tinggi' 
      when A.bobot_kriteria = '4' then 'Tinggi'
      when A.bobot_kriteria = '3' then 'Cukup'
      when A.bobot_kriteria = '2' then 'Rendah'
      when A.bobot_kriteria = '1' then 'Sangat Rendah' end
      as keterangan 
    FROM tb_kriteria AS A ")->result();
    echo json_encode($data);
  }

  public function generateId(){
    $unik = 'K';
    $kode = $this->db->query("SELECT MAX(id_kriteria) LAST_NO FROM tb_kriteria WHERE id_kriteria LIKE '".$unik."%'")->row()->LAST_NO;
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
    $this->form_validation->set_rules('nm_kriteria', 'nm_kriteria', 'required|is_unique[tb_kriteria.nm_kriteria]');

    $this->form_validation->set_rules('bobot_kriteria', 'bobot_kriteria', 'required|numeric');
    $this->form_validation->set_rules('jenis_kriteria', 'jenis_kriteria', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $id = $this->generateId();
    
    $data = array(
              "id_kriteria" => $id,
              "nm_kriteria" => $this->input->post('nm_kriteria'),
              "bobot_kriteria" => $this->input->post('bobot_kriteria'),
              "jenis_kriteria" => $this->input->post('jenis_kriteria'),
            );
    $this->db->insert('tb_kriteria', $data);
    $output = array("status" => "success", "message" => "Data Berhasil Disimpan");
    echo json_encode($output);

  }

  public function updateData(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'required');
    $this->form_validation->set_rules('nm_kriteria', 'nm_kriteria', 'required');
    $this->form_validation->set_rules('bobot_kriteria', 'bobot_kriteria', 'required|numeric');
    $this->form_validation->set_rules('jenis_kriteria', 'jenis_kriteria', 'required');

    if($this->form_validation->run() == FALSE){
      // echo validation_errors();
      $output = array("status" => "error", "message" => validation_errors());
      echo json_encode($output);
      return false;
    }

    $data = array(
      "nm_kriteria" => $this->input->post('nm_kriteria'),
      "bobot_kriteria" => $this->input->post('bobot_kriteria'),
      "jenis_kriteria" => $this->input->post('jenis_kriteria'),
    );
    $this->db->where('id_kriteria', $this->input->post('id_kriteria'));
    $this->db->update('tb_kriteria', $data);
    if($this->db->error()['message'] != ""){
      $output = array("status" => "error", "message" => $this->db->error()['message']);
      echo json_encode($output);
      return false;
    }
    $output = array("status" => "success", "message" => "Data Berhasil di Update");
    echo json_encode($output);
  }

  public function deleteData(){
    $this->db->where('id_kriteria', $this->input->post('id_kriteria'));
    $this->db->delete('tb_kriteria');

    $output = array("status" => "success", "message" => "Data Berhasil di Hapus");
    echo json_encode($output);
  }
}
