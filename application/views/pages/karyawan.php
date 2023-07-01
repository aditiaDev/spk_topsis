<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Karyawan
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-12">
            <div class="box">
              <div class="p-5">
                <button id="BTN_ADD" class="btn btn-sm bg-success" style="margin-bottom: 10px;">Tambah Data</button>
                <table id="tb_data" class="cell-border compact stripe hover">
                    <thead class="bg-gray-50">
                      <tr>
                        <th class="p-8 text-xs text-gray-500">
                          ID Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Unit
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nama Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Alamat
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          No Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Jekel
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Tanggal Masuk
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Tanggal Kontrak
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

        <!-- END: Users Layout -->
    </div>

    <!-- START: Modal Content -->
    <div id="modal_add" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"> 
                <div class="modal-header">
                  <h4 class="modal-title">Data</h4>
                </div>
                <a data-tw-dismiss="modal" href="javascript:;" onclick="modalHide('modal_add')"> <i data-feather="x" class="w-8 h-8 text-slate-400"></i> </a>
                <form id="FRM_DATA" method="post">
                  <div class="modal-body p-0">
                    <div class="p-5">
                      
                        <div>
                          <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-6">
                              <label for="regular-form-1" class="inline-block mb-2">
                                  Unit
                              </label>
                              <select name="id_unit" class="form-control select2" style="height: 40px;padding-left: 10px;">
                              
                              </select>
                            </div>
                            <div class="intro-y col-span-6">
                              <label for="regular-form-1" class="inline-block mb-2">
                                  Nama Karaywan
                              </label>
                              <input type="text" name="nm_karyawan" class="form-control" />
                            </div>
                          </div>
                        </div>

                        <div class="mt-3">
                          <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-6">
                              <label for="regular-form-1" class="inline-block mb-2">
                                  Jenis Kelamin
                              </label>
                              <select name="jenis_kelamin" class="form-control" style="height: 40px;padding-left: 10px;">
                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                              </select>
                            </div>
                            <div class="intro-y col-span-6">
                              <label for="regular-form-1" class="inline-block mb-2">
                                No Telphone
                              </label>
                              <input type="text" name="no_karyawan" class="form-control" />
                            </div>
                          </div>
                        </div>

                        <div class="mt-3">
                          <label for="regular-form-1" class="inline-block mb-2">
                            Alamat
                          </label>
                          <textarea name="alamat_karyawan" class="form-control" style="padding: 5px 10px 5px 10px;"></textarea>
                        </div>

                        <div class="mt-3">
                          <div class="grid grid-cols-12 gap-2">
                            <div class="intro-y col-span-6">
                              <label for="regular-form-1" class="inline-block mb-2">
                                  Tanggal Masuk
                              </label>
                              <input type="date" name="tgl_masuk" class="form-control rounded-full" />
                            </div>
                            <div class="intro-y col-span-6">
                              <label for="regular-form-1" class="inline-block mb-2">
                                Tanggal Kontrak
                              </label>
                              <input type="date" name="tgl_kontrak" class="form-control rounded-full" />
                            </div>
                          </div>
                        </div>
                      
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn bg-secondary rounded-full" onclick="modalHide('modal_add')">Close</button>
                    <button class="btn btn-primary rounded-full" id="BTN_SAVE">Save changes</button>
                  </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- END: Modal Content -->
    
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
              urlPost = "<?php echo site_url('karyawan/saveData') ?>";
          }else{
              urlPost = "<?php echo site_url('karyawan/updateData') ?>";
              formData+="&id_karyawan="+id_data
          }

          ACTION(urlPost, formData)
          modalHide('modal_add')
        })

        $("#BTN_ADD").click(function(){
          event.preventDefault();
          $("#FRM_DATA")[0].reset()
          $("[name='id_unit']").val('').trigger('change')
          $("#modal_add .modal-title").text('Tambah Data')
          save_method = "save"
          modalShow('modal_add')
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
              "url": "<?php echo site_url('karyawan/getAllData') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "id_karyawan", className: "text-center" },
              { "data": "id_unit", className: "text-center" },
              { "data": "nm_karyawan"},
              { "data": "alamat_karyawan"},
              { "data": "no_karyawan"},
              { "data": "jenis_kelamin"},
              { "data": "tgl_masuk"},
              { "data": "tgl_kontrak"},
              { "data": null, 
                "render" : function(data){
                  return "<button class='btn btn-sm btn-warning' title='Edit Data' onclick='editData("+JSON.stringify(data)+");'>Edit </button> "+
                    "<button class='btn btn-sm btn-danger' title='Hapus Data' onclick='deleteData(\""+data.id_karyawan+"\");'>Hapus </button>"
                },
                className: "text-center"
              },
          ]
        }
      )
    }

    function ISI_SELECT(){
      $.ajax({
        url: "<?php echo site_url('karyawan/getUnit') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          var row = "<option value=''></option>"
          $.map( data['data'], function( val, i ) {
            row += "<option value='"+val.id_unit+"' dtl='"+val.nm_unit+"'>"+val.id_unit+" - "+val.nm_unit+"</option>"
            
          });
          $("[name='id_unit']").html(row)
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

            }else{
              toastr.error(data.message)
            }
          }
      })
    }

    function editData(data, index){
      console.log(data)
      save_method = "edit"
      $("#FRM_DATA")[0].reset()
      $("#modal_add .modal-title").text('Edit Data')
      
      id_data = data.id_karyawan;
      $("[name='id_unit']").val(data.id_unit).trigger('change')
      $("[name='nm_karyawan']").val(data.nm_karyawan)
      $("[name='jenis_kelamin']").val(data.jenis_kelamin)
      $("[name='no_karyawan']").val(data.no_karyawan)
      $("[name='alamat_karyawan']").val(data.alamat_karyawan)
      $("[name='tgl_masuk']").val(data.tgl_masuk)
      $("[name='tgl_kontrak']").val(data.tgl_kontrak)

      modalShow('modal_add')
    }

    function deleteData(id){
      if(!confirm('Delete this data?')) return

      urlPost = "<?php echo site_url('karyawan/deleteData') ?>";
      formData = "id_karyawan="+id
      ACTION(urlPost, formData)
    }

    function modalShow(id){
        document.getElementById(id).className = "modal overflow-y-auto show";
        document.getElementById(id).style.marginTop = "0px";
        document.getElementById(id).style.marginLeft = "0px";
        document.getElementById(id).style.paddingLeft = "0px";
        document.getElementById(id).style.zIndex  = "100";
    }

    function modalHide(id){
        document.getElementById(id).className = "modal";
        $("#"+id).removeAttr("style");
    }

</script>