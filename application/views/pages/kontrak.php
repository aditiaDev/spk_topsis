<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<style>
  table thead th, table thead td, table tfoot th, table tfoot td, table tbody th, table tbody td {
    padding: 4px!important;
  }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Batas Kontrak
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-4">
            <div class="box">
              <div class="p-5">
                <table id="tb_data" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                    <thead class="bg-gray-50">
                      <tr>
                        <th class="p-8 text-xs text-gray-500">
                          ID
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nilai Batas
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Kebutuhan Karyawan
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
                      Nilai Batas
                  </label>
                  <input type="text" name="nilai_batas" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Kebutuhan Karyawan
                  </label>
                  <input type="text" name="kebutuhan_karyawan" class="form-control rounded-full" />
                </div>
                <div class="mt-5 text-right">
                  <button class="btn bg-secondary rounded-full" id="BTN_BATAL">Batal</button>
                  <button class="btn btn-primary rounded-full" style="display:none" id="BTN_SAVE">Simpan</button>
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
  var tb_data
    $(document).ready(function () {
        REFRESH_DATA()

        

        $("#BTN_SAVE").click(function(){
          event.preventDefault();

          if($("[name='nilai_batas']").val() > 1){
            alert('Maximal Nilai adalah 1')
            $("[name='nilai_batas']").val('')
            $("[name='nilai_batas']").focus()
            return
          }

          if($("[name='kebutuhan_karyawan']").val() < 1){
            alert('Isi data dengan benar')
            $("[name='kebutuhan_karyawan']").focus()
            return
          }

          var formData = $("#FRM_DATA").serialize();
          if(save_method == 'save') {
              urlPost = "<?php echo site_url('kontrak/saveData') ?>";
          }else{
              urlPost = "<?php echo site_url('kontrak/updateData') ?>";
              formData+="&id_batas_kontrak="+id_data
          }

          ACTION(urlPost, formData)
          $("#judul_entry").text('Tambah Data')
          save_method = 'save'
        })

        $("#BTN_BATAL").click(function(){
          event.preventDefault();
          $("#FRM_DATA")[0].reset()
          if( tb_data.rows().count() > 0 ){
            $("#BTN_SAVE").css('display', 'none')
          }else{
            $("#BTN_SAVE").css('display', 'unset')
          }
          $("#judul_entry").text('Tambah Data')
          save_method = 'save'
        })

        
    });
    
    function REFRESH_DATA(){
      
      $('#tb_data').DataTable().destroy();
      tb_data =  $("#tb_data").DataTable({
          "order": [[ 0, "asc" ]],
          "pageLength": 25,
          "autoWidth": false,
          "responsive": true,
          "ajax": {
              "url": "<?php echo site_url('kontrak/getAllData') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "id_batas_kontrak", className: "text-center" },
              { "data": "nilai_batas", className: "text-right" },
              { "data": "kebutuhan_karyawan", className: "text-right" },
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'>Edit </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_batas_kontrak+"\");'>Hapus </button>"
                },
                className: "text-center"
              },
          ]
        })

        setTimeout(() => {
          if( tb_data.rows().count() > 0 ){
            $("#BTN_SAVE").css('display', 'none')
          }else{
            $("#BTN_SAVE").css('display', 'unset')
          }
        }, 1000);
        
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

            }else{
              toastr.error(data.message)
            }
          }
      })
    }

    function editData(data, index){
      console.log(data)
      save_method = "edit"
      $("#BTN_SAVE").css('display', 'unset')
      id_data = data.id_batas_kontrak;
      $("#judul_entry").text('Edit Data')
      $("[name='nilai_batas']").val(data.nilai_batas)
      $("[name='kebutuhan_karyawan']").val(data.kebutuhan_karyawan)
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('kontrak/deleteData') ?>";
      formData = "id_batas_kontrak="+id
      ACTION(urlPost, formData)
    }


</script>