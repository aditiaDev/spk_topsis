<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
        // if(!$this->session->userdata('id_user'))
        //   redirect('login', 'refresh');
    }

	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('template/topmenu');
    $this->load->view('pages/penilaian');
    $this->load->view('template/footer');
	}

  public function getData(){
    $sql = $this->db->query("
      SELECT 
      A.id_karyawan as alternatif,
      B.nm_karyawan as nama,
      A.nilai_kriteria,
      A.id_kriteria as kriteria,
      C.bobot_kriteria
      FROM tb_penilaian_karyawan A
      LEFT JOIN tb_karyawan_kontrak B ON A.id_karyawan = B.id_karyawan	
      LEFT JOIN tb_kriteria C ON A.id_kriteria = C.id_kriteria
    ")->result_array();

    $result = array();

    
    $data=array();
    $kriterias =array();
    $nilai_kuadrat =array();
    $pembagi = array();
    $bobot = array();
    
    foreach($sql as $row){
      if(!isset($data[$row['alternatif']])){
        $data[$row['alternatif']]=array();
      }

      if(!isset($data[$row['alternatif']][$row['kriteria']])){
        $data[$row['alternatif']][$row['kriteria']]=array();
      }

      if(!isset($nilai_kuadrat[$row['kriteria']])){
        $nilai_kuadrat[$row['kriteria']]=0;
      }

      $data[$row['alternatif']][$row['alternatif']]=$row['nama'];
      $data[$row['alternatif']][$row['kriteria']]=$row['nilai_kriteria'];
      
      $nilai_kuadrat[$row['kriteria']]+=pow($row['nilai_kriteria'],2);

      $kriterias[] = $row['kriteria'];
      $kriteria     =array_unique($kriterias);

      $namas[] = $row['alternatif'];
      $nama     =array_unique($namas);
      
    }

    foreach($nilai_kuadrat as $kuadrat=>$val){
      $pembagi[$kuadrat] = sqrt($val);
    }

    $query = $this->db->query("
      SELECT id_kriteria, nm_kriteria, bobot_kriteria, jenis_kriteria FROM tb_kriteria ORDER BY id_kriteria
    ")->result_array();

    foreach($query as $value){
      $bobot[$value['id_kriteria']]['bobot'] = $value['bobot_kriteria'];
      $bobot[$value['id_kriteria']]['jenis_kriteria'] = $value['jenis_kriteria'];
    }

    $result['data'] = $data;
    $result['kriteria'] = $kriteria;
    $result['nama'] = $nama;
    $result['pembagi'] = $pembagi;
    $result['bobot'] = $bobot;


    return $result;
  }

  public function getMatrix(){
    

    $getData = $this->getData();

    $no=0;
    $table="";

    foreach($getData['data'] as $row=>$val){
      $td_kriteria="";
      foreach($getData['kriteria'] as $k){
        $td_kriteria .= "<td align='center'>".$getData['data'][$row][$k]."</td>";
      }

      $td_nama = "<td>".$getData['data'][$row][$getData['nama'][$no]]."</td>";

      $table .= "<tr>
                <td>".++$no."</td>
                <td>".$row."</td>
                ".$td_nama."
                ".$td_kriteria."
              </tr>";
    }

    echo $table;
    // echo "<pre>";
    // print_r($getData);
    // echo "</pre>";
  }

  public function getPembagi(){

    $getData = $this->getData();

    $no=0;
    $table="";

    foreach($getData['pembagi'] as $bagi=>$val){
      $table .= "<tr>
                <td>".++$no."</td>
                <td>".$bagi."</td>
                <td>".$val."</td>
              </tr>";
    }

    echo $table;
  }

  public function getTernomalisasi(){
    $getData = $this->getData();

    foreach($getData['data'] as $row=>$val){

      foreach($getData['kriteria'] as $k){
        $ternomalisasi = $getData['data'][$row][$k] / $getData['pembagi'][$k];
        $getData['data'][$row][$k] = $ternomalisasi;
      }

    }

    return $getData;
  }

  public function getTableNormalisasi(){

    $getData = $this->getTernomalisasi();

    $no=0;
    $table="";

    foreach($getData['data'] as $row=>$val){
      $td_kriteria="";
      foreach($getData['kriteria'] as $k){
        $ternomalisasi = $getData['data'][$row][$k];
        $td_kriteria .= "<td align='center'>".$ternomalisasi."</td>";
      }

      $td_nama = "<td>".$getData['data'][$row][$getData['nama'][$no]]."</td>";

      $table .= "<tr>
                <td>".++$no."</td>
                <td>".$row."</td>
                ".$td_nama."
                ".$td_kriteria."
              </tr>";
    }

    echo $table;
    
  }

  public function getTerbobot(){
    $getData = $this->getTernomalisasi();

    foreach($getData['data'] as $row=>$val){

      foreach($getData['kriteria'] as $k){
        $terbobot = $getData['data'][$row][$k] * $getData['bobot'][$k]['bobot'];
        $getData['data'][$row][$k] = $terbobot;
      }

    }

    return $getData;
    // echo "<pre>";
    // print_r($getData);
    // echo "</pre>";
  }

  public function getTableTerbobot(){
    $getData = $this->getTerbobot();

    $no=0;
    $table="";

    foreach($getData['data'] as $row=>$val){
      $td_kriteria="";
      foreach($getData['kriteria'] as $k){
        $terbobot = $getData['data'][$row][$k];
        $td_kriteria .= "<td align='center'>".$terbobot."</td>";
      }

      $td_nama = "<td>".$getData['data'][$row][$getData['nama'][$no]]."</td>";

      $table .= "<tr>
                <td>".++$no."</td>
                <td>".$row."</td>
                ".$td_nama."
                ".$td_kriteria."
              </tr>";
    }

    echo $table;
  }

  public function getSolusi(){
    $getData = $this->getTerbobot();

    $i=0;
    foreach($getData['data'] as $row=>$val){

      foreach($getData['kriteria'] as $k){
        $getData['terbobot'][$k][$i] = $val[$k];
        $i++;
      }
    
    }

    foreach($getData['bobot'] as $bobot=>$val){
      $getData['solusi']['A+'][$bobot] = ($val['jenis_kriteria'] == "BENEFIT" ? max($getData['terbobot'][$bobot]) : min($getData['terbobot'][$bobot]));
      $getData['solusi']['A-'][$bobot] = ($val['jenis_kriteria'] == "BENEFIT" ? min($getData['terbobot'][$bobot]) : max($getData['terbobot'][$bobot]));
    }

    return $getData;
    // echo "<pre>";
    // print_r($getData);
    // echo "</pre>";
  }

  public function getTableSolusi(){
    $getData = $this->getSolusi();

    $table="";
    foreach($getData['solusi'] as $row=>$val){

      $td_kriteria="";
      foreach($getData['kriteria'] as $k){
        $solusi = $getData['solusi'][$row][$k];
        $td_kriteria .= "<td align='center'>".$solusi."</td>";
      }

      $table .= "<tr>
                <td align='center'>".$row."</td>
                ".$td_kriteria."
              </tr>";
    }

    echo $table;

  }

  public function getJarak(){
    $getData = $this->getSolusi();

    foreach($getData['data'] as $row=>$val){

      $jarak_plus = 0;
      foreach($getData['solusi']['A+'] as $data=>$value){
        $jarak_plus += pow($value - $val[$data], 2);
      }

      $jarak_negatif = 0;
      foreach($getData['solusi']['A-'] as $data=>$value){
        $jarak_negatif += pow($val[$data] - $value, 2);
      }
      

      $getData['jarak']['D+'][$row] = sqrt($jarak_plus);
      $getData['jarak']['D-'][$row] = sqrt($jarak_negatif);
    }

    return $getData;
    // echo "<pre>";
    // print_r($getData);
    // echo "</pre>";
  }

  public function getTableJarak(){
    $getData = $this->getJarak();

    $no=0;
    $table="";

    foreach($getData['data'] as $row=>$val){
      $td_jarak="";
      foreach($getData['jarak'] as $j){
        $jarak = $j[$row];
        $td_jarak .= "<td align='center'>".$jarak."</td>";
      }

      $td_nama = "<td>".$getData['data'][$row][$getData['nama'][$no]]."</td>";

      $table .= "<tr>
                <td>".++$no."</td>
                <td>".$row."</td>
                ".$td_nama."
                ".$td_jarak."
              </tr>";
    }

    echo $table;
  }

  public function getPreferensi(){
    $getData = $this->getJarak();

    $nilai_preferensi = 0;
    foreach($getData['data'] as $row=>$val){

      $nilai_preferensi = $getData['jarak']['D-'][$row] / ($getData['jarak']['D-'][$row] + $getData['jarak']['D+'][$row]);
      $getData['preferensi'][$row] = $nilai_preferensi;
    }

    return $getData;
    // echo "<pre>";
    // print_r($getData);
    // echo "</pre>";
  }

  public function getTablePreferensi(){
    $getData = $this->getPreferensi();
    

    $array = $getData['preferensi'];
    $i=1;
    foreach($getData['preferensi'] as $key=>$values)
    {
        $max = max($array);
        // echo "<br>".$max." rank is ". $i."<br>";
        $keys = array_search($max, $array);    
        $getData['rank'][$keys] = $i;
        unset($array[$keys]);
        if(sizeof($array) >0)
        if(!in_array($max,$array))
        $i++;

    }

    $no=0;
    $table="";

    $nilai_batas = $this->db->query("select nilai_batas from tb_batas_kontrak order by id_batas_kontrak desc limit 1")->row()->nilai_batas;

    foreach($getData['data'] as $row=>$val){

      $preferensi = $getData['preferensi'][$row];
      $td_preferensi = "<td align='center'>".$preferensi."</td>";

      $rank = $getData['rank'][$row];
      $td_rank = "<td align='center'>".$rank."</td>";

      if($rank > $nilai_batas){
        $ket_lulus = 'Dirumahkan';
      }else{
        $ket_lulus = 'Lanjut Kerja';
      }


      $td_nama = "<td>".$getData['data'][$row][$getData['nama'][$no]]."</td>";

      $table .= "<tr>
                <td>".++$no."</td>
                <td>".$row."</td>
                ".$td_nama."
                ".$td_preferensi."
                ".$td_rank."
                <td>".$ket_lulus."</td>
              </tr>";
    }

    echo $table;

    // echo "<pre>";
    // print_r($getData);
    // echo "</pre><br>";
  }

}