<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<style>
  table thead th, table thead td, table tfoot th, table tfoot td, table tbody th, table tbody td {
    padding: 4px!important;
  }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data User
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
                          ID User
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nama Pengguna
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          UserName
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Password
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Level
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
              <h2 class="mr-auto text-base font-medium" id="judul_entry">Tambah Data </h2>
            </div>
            <div class="p-5">
              <form id="FRM_DATA" method="post">
                <div>
                  <label for="regular-form-1" class="inline-block mb-2">
                      Nama Pengguna
                  </label>
                  <input type="text" name="nm_pengguna" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Username
                  </label>
                  <input type="text" name="username" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Password
                  </label>
                  <input type="password" name="password" class="form-control rounded-full" />
                </div>
                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Level
                  </label>
                  <select name="level" class="form-control rounded-full" style="height: 40px;padding-left: 10px;">
                    <!-- <option value="ADMIN">ADMIN</option> -->
                    <option value="KARYAWAN">KARYAWAN</option>
                    <option value="KEPALA UNIT">KEPALA UNIT</option>
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
  var id_user;

    $(document).ready(function () {
        generateId()
        REFRESH_DATA()

        $("#BTN_SAVE").click(function(){
          event.preventDefault();
          var formData = $("#FRM_DATA").serialize();
          if(save_method == 'save') {
              urlPost = "<?php echo site_url('user/saveData') ?>";
          }else{
              urlPost = "<?php echo site_url('user/updateData') ?>";
              formData+="&id_user="+id_user
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

          generateId()
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
              "url": "<?php echo site_url('user/getAllData') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "id_user", className: "text-center" },
              { "data": "nm_pengguna"},
              { "data": "username"},
              { "data": "password"},
              { "data": "level"},
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'>Edit </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_user+"\");'>Hapus </button>"
                },
                className: "text-center"
              },
          ]
        }
      )
    }

    function generateId(){
      $.ajax({
        url: "<?php echo site_url('user/newUser') ?>",
        type: "POST",
        success: function(data){
          console.log(data)
          $("[name='nm_pengguna']").val(data)
          $("[name='username']").val(data)
          $("[name='password']").val(data)
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
            
            if (data.status == "success") {
              toastr.info(data.message)
              REFRESH_DATA()
              $("#FRM_DATA")[0].reset()
              generateId()
            }else{
              toastr.error(data.message)
            }
          }
      })
    }

    function editData(data, index){
      console.log(data)
      save_method = "edit"
      id_user = data.id_user;
      $("#judul_entry").text('Edit Data')
      $("[name='nm_pengguna']").val(data.nm_pengguna)
      $("[name='username']").val(data.username)
      $("[name='password']").val(data.password)
      $("[name='level']").val(data.level)
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('user/deleteData') ?>";
      formData = "id_user="+id
      ACTION(urlPost, formData)
    }

    function modalShow(id){
        document.getElementById(id).className = "modal overflow-y-auto show";
        document.getElementById(id).style.marginTop = "0px";
        document.getElementById(id).style.marginLeft = "0px";
        document.getElementById(id).style.paddingLeft = "0px";
        document.getElementById(id).style.zIndex  = "10000";
    }
</script>