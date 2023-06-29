<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Unit
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
                          ID Unit
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          ID User
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nama Unit
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Kepala Unit
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
                      ID User
                  </label>
                  <select name="id_user" class="form-control select2" style="width:100%" data-placeholder="Pilih Kepala Unit">
                  </select>
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Kepala Unit
                  </label>
                  <input type="text" name="kepala_unit" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Nama Unit
                  </label>
                  <input type="text" name="nm_unit" class="form-control rounded-full" />
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
      $('#tb_data').DataTable().destroy();
      var tb_data =  $("#tb_data").DataTable({
          "order": [[ 0, "asc" ]],
          "pageLength": 25,
          "autoWidth": false,
          "responsive": true,
          "ajax": {
              "url": "<?php echo site_url('unit/getAllData') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "id_unit", className: "text-center" },
              { "data": "id_user", className: "text-center" },
              { "data": "nm_unit"},
              { "data": "kepala_unit"},
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'>Edit </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_unit+"\");'>Hapus </button>"
                },
                className: "text-center"
              },
          ]
        }
      )
    }

    function ISI_SELECT(){
      $.ajax({
        url: "<?php echo site_url('unit/getUser') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          var row = "<option value=''></option>"
          $.map( data['data'], function( val, i ) {
            row += "<option value='"+val.id_user+"' dtl='"+val.nm_pengguna+"'>"+val.id_user+" - "+val.nm_pengguna+"</option>"
            
          });
          $("[name='id_user']").html(row)
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