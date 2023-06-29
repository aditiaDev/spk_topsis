<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Kriteria
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-8">
            <div class="box">
              <div class="p-5">
                <table id="tb_data" class="cell-border compact stripe hover">
                    <thead class="bg-gray-50">
                      <tr>
                        <th class="p-8 text-xs text-gray-500">
                          ID Kriteria
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nama Kriteria
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Bobot
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Jenis Kriteria
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
                      Nama Kriteria
                  </label>
                  <input type="text" name="nm_kriteria" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                    Bobot Kriteria
                  </label>
                  <input type="text" name="bobot_kriteria" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                    Jenis Kriteria
                  </label>
                  <select name="jenis_kriteria" class="form-control rounded-full" style="height: 40px;padding-left: 10px;">
                    <option value="MAX">MAX</option>
                    <option value="MIN">MIN</option>
                  </select>
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

        $("#BTN_SAVE").click(function(){
          event.preventDefault();
          var formData = $("#FRM_DATA").serialize();
          if(save_method == 'save') {
              urlPost = "<?php echo site_url('kriteria/saveData') ?>";
          }else{
              urlPost = "<?php echo site_url('kriteria/updateData') ?>";
              formData+="&id_kriteria="+id_data
          }

          ACTION(urlPost, formData)
          $("#judul_entry").text('Tambah Data')
          save_method = 'save'
        })

        $("#BTN_BATAL").click(function(){
          event.preventDefault();
          $("#FRM_DATA")[0].reset()
          $("#judul_entry").text('Tambah Data')
          save_method = 'save'
        })
    });

    function REFRESH_DATA(){
      $('#tb_data').DataTable().destroy();
      var tb_data =  $("#tb_data").DataTable({
          "order": [[ 0, "asc" ]],
          "pageLength": 25,
          "autoWidth": false,
          "responsive": true,
          "ajax": {
              "url": "<?php echo site_url('kriteria/getAllData') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "id_kriteria", className: "text-center" },
              { "data": "nm_kriteria"},
              { "data": "bobot_kriteria", className: "text-right"},
              { "data": "jenis_kriteria", className: "text-center"},
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'>Edit </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_kriteria+"\");'>Hapus </button>"
                },
                className: "text-center"
              },
          ]
        }
      )
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
      id_data = data.id_kriteria;
      $("#judul_entry").text('Edit Data')
      $("[name='nm_kriteria']").val(data.nm_kriteria)
      $("[name='bobot_kriteria']").val(data.bobot_kriteria)
      $("[name='jenis_kriteria']").val(data.jenis_kriteria)
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('kriteria/deleteData') ?>";
      formData = "id_kriteria="+id
      ACTION(urlPost, formData)
    }

</script>