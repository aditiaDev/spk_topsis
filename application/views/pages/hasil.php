<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<style>
  table thead th, table thead td, table tfoot th, table tfoot td, table tbody th, table tbody td {
    padding: 4px!important;
  }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Hasil Penilaian Karyawan
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-8">
            <div class="box">
              <div class="p-5">
                <table id="tb_data" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                    <thead class="bg-gray-50">
                      <tr>
                        <th class="p-8 text-xs text-gray-500" style="width: 100px;">
                          Rank
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          ID Hasil
                        </th>
                        <th class="p-8 text-xs text-gray-500" style="width: 100px;">
                          Tanggal Penilaian
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          ID Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nama Karyawan
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Batas Rekrutmen
                        </th>
                        <th class="p-8 text-xs text-gray-500">
                          Nilai
                        </th>
                        
                        <th class="p-8 text-xs text-gray-500" style="width: 100px;">
                          Keterangan
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
    
</div>
<!-- END: Content -->

    
<script src="<?php echo base_url('/assets/jquery/jquery.min.js'); ?>"></script>
<script>


    $(document).ready(function () {
        REFRESH_DATA()

    });

    function REFRESH_DATA(){
      $('#tb_data').DataTable().destroy();
      var tb_data =  $("#tb_data").DataTable({
          "order": [[ 0, "asc" ]],
          "pageLength": 25,
          "autoWidth": false,
          "responsive": true,
          "ajax": {
              "url": "<?php echo site_url('penilaian/getHasil') ?>",
              "type": "POST",
          },
          "columns": [
              { "data": "rank", className: "text-center" },
              { "data": "id_hasil", className: "text-center" },
              { "data": "tgl_penilaian", className: "text-right"},
              { "data": "id_karyawan", className: "text-center" },
              { "data": "nm_karyawan"},
              { "data": "nilai_batas", className: "text-center"},
              { "data": "nilai", className: "text-right"},
              { "data": "keterangan"},
          ]
        }
      )
    }

</script>