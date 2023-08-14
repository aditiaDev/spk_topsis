<style>
  table thead th, table thead td, table tfoot th, table tfoot td, table tbody th, table tbody td {
    padding: 4px!important;
  }

  .col-span-9 {
    grid-column: span 9 / span 9;
  }

  .col-span-3 {
    grid-column: span 3 / span 3;
  }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-3">
          <div class="box">
            <div class="flex flex-col items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400 sm:flex-row">
              <h2 class="mr-auto text-base font-medium">Laporan Hasil Penilaian</h2>
            </div>
            <div class="p-5">
              <form action="<?php echo base_url('Laporan/ctkHasil') ?>" method="POST" target="_blank">
                <div class="grid grid-cols-12 gap-2">
                  <div class="col-span-6">
                    <label for="regular-form-1" class="inline-block mb-2">
                        Period Penilaian
                    </label>
                    <input type="date" name="from" class="form-control">
                  </div>

                  <div class="col-span-6">
                    <label for="regular-form-1" class="inline-block mb-2">
                        Sampai
                    </label>
                    <input type="date" name="to" class="form-control">
                  </div>
                </div>

                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Unit
                  </label>
                  <select name="unit" class="form-control rounded-full" style="height: 40px;padding-left: 10px;">
                    <option value="">Semua</option>
                  </select>
                </div>

                <div class="mt-3">
                  <label for="regular-form-1" class="inline-block mb-2">
                      Status
                  </label>
                  <select name="keterangan" class="form-control rounded-full" style="height: 40px;padding-left: 10px;">
                    <option value="">Semua</option>
                    <option value="Lanjut Kerja">Lanjut Kerja</option>
                    <option value="Dirumahkan">Dirumahkan</option>
                  </select>
                </div>
                <div class="mt-5 text-right">
                  <button class="btn btn-success rounded-full" style="width: 100%;" id="BTN_PRINT">Print Laporan</button>
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
  $(document).ready(function () {
    getUnit()
  });
  function getUnit(){
    $.ajax({
      url: "",
      type: "POST",
      success: function(data){
        $.ajax({
        url: "<?php echo site_url('karyawan/getUnit') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data){
          // console.log(data)
          var row = "<option value=''>Semua</option>"
          $.map( data['data'], function( val, i ) {
            row += "<option value='"+val.id_unit+"' dtl='"+val.nm_unit+"'>"+val.id_unit+" - "+val.nm_unit+"</option>"
            
          });
          $("[name='unit']").html(row)
        }
      })
      }
    })
  }
</script>