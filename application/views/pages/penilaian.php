<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<style>
  table thead th, table thead td, table tfoot th, table tfoot td, table tbody th, table tbody td {
    padding: 4px!important;
  }

  .chat .chat__tabs a.active {
    --tw-bg-opacity: 1;
    background-color: rgba(28,63,170,var(--tw-bg-opacity));
    --tw-text-opacity: 1;
    color: rgba(255,255,255,var(--tw-text-opacity));
  }

  .nav.nav-tabs .active {
      --tw-border-opacity: 1;
      border-color: rgba(28,63,170,var(--tw-border-opacity));
      border-bottom-width: 2px;
      font-weight: 500;
  }

  .tab-content .tab-pane.active {
      transition: visibility 0s linear 0s,opacity .6s 0s;
      opacity: 1;
      position: static;
      visibility: visible;
  }

  .tab-content .tab-pane {
      top: -9999px;
      left: -9999px;
      transition: visibility 0s linear .6s,opacity .6s 0s;
      opacity: 0;
      position: absolute;
      visibility: hidden;
  }
</style>
<!-- BEGIN: Content -->
<?php
// $jml_kriteria = $this->db->query("SELECT count(*) as jml_kriteria FROM tb_kriteria")->row()->jml_kriteria;
$data = $this->db->query("SELECT id_kriteria, nm_kriteria FROM tb_kriteria")->result_array();
$jml_kriteria = count($data);
?>
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Penilaian
    </h2>
    <div class="intro-y chat grid grid-cols-12 gap-6 mt-5"  
        x-data="{ 
                  activeTab:1,
                  activeClass: 'flex-1 py-2 rounded-md text-center active',
                  inactiveClass : 'flex-1 py-2 rounded-md text-center'
              }"
    >
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-12">
          <div class="box">
            <div class="p-5"
            >
              <div class="intro-y pr-1">
                <div class="box p-2">
                  <div class="chat__tabs nav nav-tabs justify-center" role="tablist">
                    <a id="chats-tab" href="javascript:;" x-on:click="activeTab = 1" :class="activeTab === 1 ? activeClass : inactiveClass">Tabel Matrix (x<sub>ij</sub>)</a>
                    <a id="chats-tab" href="javascript:;" x-on:click="activeTab = 2" :class="activeTab === 2 ? activeClass : inactiveClass">Pembagi</a>
                    <a id="chats-tab" href="javascript:;" x-on:click="activeTab = 3" :class="activeTab === 3 ? activeClass : inactiveClass">Tabel Ternomalisasi</a>
                    <a id="chats-tab" href="javascript:;" x-on:click="activeTab = 4" :class="activeTab === 4 ? activeClass : inactiveClass">Tabel Terbobot</a>
                    <a id="chats-tab" href="javascript:;" x-on:click="activeTab = 5" :class="activeTab === 5 ? activeClass : inactiveClass">Solusi Ideal</a>
                    <a id="chats-tab" href="javascript:;" x-on:click="activeTab = 6" :class="activeTab === 6 ? activeClass : inactiveClass">Nilai Preverensi</a>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="intro-y col-span-12">
            <div class="box">
              <div class="p-5">
                <div class="tab-content">
                  <div x-show="activeTab === 1">
                    <table id="tb_matrix" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                      <thead>
                        <tr>
                            <th rowspan="3">No</th>
                            <th rowspan="3">Alternatif</th>
                            <th rowspan="3">Nama Karyawan</th>
                            <th colspan="<?= $jml_kriteria ?>" style="text-align: center;">Kriteria</th>
                        </tr>
                        <tr>
                          <?php
                            foreach($data as $row){
                              echo "<th>".$row['id_kriteria']."</th>";
                            }
                          ?>
                        </tr>
                        <tr>
                          <?php
                            foreach($data as $row){
                              echo "<th>".$row['nm_kriteria']."</th>";
                            }
                          ?>
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                      </tbody>
                    </table>
                  </div>
                  <div x-show="activeTab === 2">
                    <table id="tb_pembagi" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                      <thead>
                        <tr>
                            <th >No</th>
                            <th >Kriteria</th>
                            <th >Pembagi</th>
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                      </tbody>
                    </table>
                  </div>
                  <div x-show="activeTab === 3">
                    <table id="tb_ternormalisasi" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                        <thead>
                          <tr>
                              <th rowspan="3">No</th>
                              <th rowspan="3">Alternatif</th>
                              <th rowspan="3">Nama Karyawan</th>
                              <th colspan="<?= $jml_kriteria ?>" style="text-align: center;">Kriteria</th>
                          </tr>
                          <tr>
                            <?php
                              foreach($data as $row){
                                echo "<th>".$row['id_kriteria']."</th>";
                              }
                            ?>
                          </tr>
                          <tr>
                            <?php
                              foreach($data as $row){
                                echo "<th>".$row['nm_kriteria']."</th>";
                              }
                            ?>
                          </tr>
                        </thead>
                        <tbody class="bg-white">
                        </tbody>
                      </table>
                  </div>
                  <div x-show="activeTab === 4">
                    <table id="tb_terbobot" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                      <thead>
                        <tr>
                            <th rowspan="3">No</th>
                            <th rowspan="3">Alternatif</th>
                            <th rowspan="3">Nama Karyawan</th>
                            <th colspan="<?= $jml_kriteria ?>" style="text-align: center;">Kriteria</th>
                        </tr>
                        <tr>
                          <?php
                            foreach($data as $row){
                              echo "<th>".$row['id_kriteria']."</th>";
                            }
                          ?>
                        </tr>
                        <tr>
                          <?php
                            foreach($data as $row){
                              echo "<th>".$row['nm_kriteria']."</th>";
                            }
                          ?>
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                      </tbody>
                    </table>
                  </div>
                  <div x-show="activeTab === 5">
                    <div>
                      <table id="tb_solusi" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                        <thead>
                          <tr>
                              <th rowspan="3"></th>
                              <th colspan="<?= $jml_kriteria ?>" style="text-align: center;">Kriteria</th>
                          </tr>
                          <tr>
                            <?php
                              foreach($data as $row){
                                echo "<th>".$row['id_kriteria']."</th>";
                              }
                            ?>
                          </tr>
                          <tr>
                            <?php
                              foreach($data as $row){
                                echo "<th>".$row['nm_kriteria']."</th>";
                              }
                            ?>
                          </tr>
                        </thead>
                        <tbody class="bg-white">
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-5">
                      <table id="tb_jarak" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                        <thead>
                          <tr>
                              <th rowspan="2">No</th>
                              <th rowspan="2">Alternatif</th>
                              <th rowspan="2">Nama Karyawan</th>
                              <th colspan="2" style="text-align: center;">Jarak antara nilai terbobot terhadap solusi ideal</th>
                          </tr>
                          <tr>
                            <th style="text-align:center;">D+</th>
                            <th style="text-align:center;">D-</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white">
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div x-show="activeTab === 6">
                    <table id="tb_preferensi" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                      <thead>
                        <tr>
                            <th >#</th>
                            <th>Alternatif</th>
                            <th>Nama Karyawan</th>
                            <th style="text-align: center;">Nilai Preferensi (V<sub>i</sub>)</th>
                            <th>Rank</th>
                            <!-- <th>Hasil keputusan</th> -->
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <!-- END: Users Layout -->
    </div>
    
</div>
<!-- END: Content -->

<script src="<?php echo base_url('/assets/jquery/jquery.min.js'); ?>"></script>
<script>
  var save_method = 'save';
  var id_data;

    $(document).ready(function () {
        REFRESH_DATA()
        // ISI_SELECT()

        $("#BTN_SAVE").click(function(){
          event.preventDefault();
          var formData = $("#FRM_DATA").serialize();
          if(save_method == 'save') {
              urlPost = "<?php echo site_url('unit/saveData') ?>";
          }else{
              urlPost = "<?php echo site_url('unit/updateData') ?>";
              formData+="&id_unit="+id_data
          }

          ACTION(urlPost, formData)
          $("#judul_entry").text('Tambah Data')
          save_method = 'save'
        })

        $("#BTN_BATAL").click(function(){
          event.preventDefault();
          $("#FRM_DATA")[0].reset()
          $("[name='id_user']").val('').trigger('change')
          $("#judul_entry").text('Tambah Data')
          save_method = 'save'
        })

        $("[name='id_user']").change(function(){
          let kepala_unit = $("[name='id_user']").find(':selected').attr('dtl')
          $("[name='kepala_unit']").val(kepala_unit)
        })
    });

    function REFRESH_DATA(){
      $.ajax({
        url: "<?php echo site_url('penilaian/getMatrix') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_matrix tbody").html(data)
          $('#tb_matrix').DataTable().destroy();
          $("#tb_matrix").DataTable({
            "order": [[ 0, "asc" ]],
            "pageLength": 25,
            "autoWidth": false,
            "responsive": true,
          })
          
        }
      })

      $.ajax({
        url: "<?php echo site_url('penilaian/getPembagi') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_pembagi tbody").html(data)
        }
      })

      $.ajax({
        url: "<?php echo site_url('penilaian/getTableNormalisasi') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_ternormalisasi tbody").html(data)
        }
      })

      $.ajax({
        url: "<?php echo site_url('penilaian/getTableTerbobot') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_terbobot tbody").html(data)
        }
      })

      $.ajax({
        url: "<?php echo site_url('penilaian/getTableSolusi') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_solusi tbody").html(data)
        }
      })

      $.ajax({
        url: "<?php echo site_url('penilaian/getTableJarak') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_jarak tbody").html(data)
        }
      })

      $.ajax({
        url: "<?php echo site_url('penilaian/getTablePreferensi') ?>",
        type: "POST",
        dataType: "HTML",
        success: function(data){
          // console.log(data)
          $("#tb_preferensi tbody").html(data)
          $('#tb_preferensi').DataTable().destroy();
          $("#tb_preferensi").DataTable({
            "order": [[ 0, "asc" ]],
            "pageLength": 25,
            "autoWidth": false,
            "responsive": true,
          })
        }
      })

    }

    function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          beforeSend: function () {
            $("#LOADER").show();
          },
          complete: function () {
            $("#LOADER").hide();
          },
          success: function(data){
            console.log(data)
            if (data.status == "success") {
              toastr.info(data.message)
              REFRESH_DATA()
              $("#FRM_DATA")[0].reset()
              $("[name='id_user']").val('').trigger('change')

            }else{
              toastr.error(data.message)
            }
          }
      })
    }

    function editData(data, index){
      console.log(data)
      save_method = "edit"
      id_data = data.id_unit;
      $("#judul_entry").text('Edit Data')
      $("[name='id_user']").val(data.id_user).trigger('change')
      $("[name='nm_unit']").val(data.nm_unit)
      $("[name='kepala_unit']").val(data.kepala_unit)
      
      
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('unit/deleteData') ?>";
      formData = "id_unit="+id
      ACTION(urlPost, formData)
    }


</script>