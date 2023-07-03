<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<style>
  table thead th, table thead td, table tfoot th, table tfoot td, table tbody th, table tbody td {
    padding: 4px!important;
  }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Penilaian
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-8">
            <div class="box">
              <div class="p-5">
                <table id="tb_data" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                    <thead class="bg-gray-50">
                      <tr>
                        <th class="p-8 text-xs text-gray-500">
                          ID Penilaian
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          ID Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nama Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Kriteria
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nilai
                        </th>
                        <th class="p-8 text-xs text-gray-500" style="width: 100px;">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                    </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="intro-y col-span-4">
          <div class="box">
            <div class="flex flex-col items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400 sm:flex-row">
              <h2 class="mr-auto text-base font-medium" id="judul_entry">Tambah Data</h2>
            </div>
            <div class="p-5">
              <form id="FRM_DATA" method="post">
                <div>
                  <label for="regular-form-1" class="inline-block mb-2">
                      ID Karyawan
                  </label>
                  <select name="id_karyawan" class="form-control select2" style="width:100%" data-placeholder="Pilih Karyawan">
                  </select>
                </div>

                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      ID Kriteria
                  </label>
                  <select name="id_kriteria" class="form-control"  style="height: 40px;padding-left: 10px;" data-placeholder="Pilih Kriteria">
                  </select>
                </div>

                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Nilai
                  </label>
                  <input type="text" name="nilai_kriteria" class="form-control rounded-full" />
                </div>
                <div class="mt-5 text-right">
                  <button class="btn bg-secondary rounded-full" id="BTN_BATAL">Batal</button>
                  <button class="btn btn-primary rounded-full" id="BTN_SAVE">Simpan</button>
                </div>
              </form>
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
        ISI_SELECT()
        $(".select2").select2()

        $("#BTN_SAVE").click(function(){
          event.preventDefault();
          var formData = $("#FRM_DATA").serialize();
          if(save_method == 'save') {
              urlPost = "<?php echo site_url('nilai/saveData') ?>";
          }else{
              urlPost = "<?php echo site_url('nilai/updateData') ?>";
              formData+="&id_penilaian_karyawan="+id_data
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

    });

    function REFRESH_DATA(){
      $('#tb_data').DataTable().destroy();
      var tb_data =  $("#tb_data").DataTable({
          "order": [[ 3, "asc" ], [ 1, "asc" ]],
          "pageLength": 25,
          "autoWidth": false,
          "responsive": true,
          "ajax": {
              "url": "<?php echo site_url('nilai/getAllData') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "id_penilaian_karyawan", className: "text-center" },
              { "data": "id_karyawan", className: "text-center" },
              { "data": "nm_karyawan"},
              { "data": "kriteria"},
              { "data": "nilai_kriteria", className: "text-right"},
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'>Edit </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_penilaian_karyawan+"\");'>Hapus </button>"
                },
                className: "text-center"
              },
          ]
        }
      )
    }

    function ISI_SELECT(){
      $.ajax({
        url: "<?php echo site_url('nilai/getKaryawan') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          var row = "<option value=''></option>"
          $.map( data['data'], function( val, i ) {
            row += "<option value='"+val.id_karyawan+"'>"+val.id_karyawan+" - "+val.nm_karyawan+"</option>"
            
          });
          $("[name='id_karyawan']").html(row)
        }
      })

      $.ajax({
        url: "<?php echo site_url('nilai/getKriteria') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          var row = "<option value=''></option>"
          $.map( data['data'], function( val, i ) {
            row += "<option value='"+val.id_kriteria+"'>"+val.id_kriteria+" - "+val.nm_kriteria+"</option>"
            
          });
          $("[name='id_kriteria']").html(row)
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
      id_data = data.id_penilaian_karyawan;
      $("#judul_entry").text('Edit Data')
      $("[name='id_karyawan']").val(data.id_karyawan).trigger('change')
      $("[name='id_kriteria']").val(data.id_kriteria)
      $("[name='nilai_kriteria']").val(data.nilai_kriteria)
      
      
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('nilai/deleteData') ?>";
      formData = "id_penilaian_karyawan="+id
      ACTION(urlPost, formData)
    }


</script>