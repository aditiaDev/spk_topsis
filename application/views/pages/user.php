<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css'); ?>">
<!-- BEGIN: Content -->
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data User
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        <div class="intro-y col-span-6">
            <div class="box">
              <table id="dataTable" class="cell-border p-4">
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
                      </tr>
                  </thead>
                  <tbody class="bg-white">
                      <tr class="whitespace-nowrap">
                          <td class="px-6 py-4 text-sm text-center text-gray-500">
                              1
                          </td>
                          <td class="px-6 py-4 text-center">
                              <div class="text-sm text-gray-900">
                                  Aditia
                              </div>
                          </td>
                          <td class="px-6 py-4 text-center">
                              <div class="text-sm text-gray-500">jhondoe@example.com</div>
                          </td>
                          <td class="px-6 py-4 text-sm text-center text-gray-500">
                              2021-1-12
                          </td>
                          <td class="px-6 py-4 text-center">
                              <div class="text-sm text-gray-900">
                                  Aditia
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
            </div>
        </div>
        <!-- END: Users Layout -->
    </div>
</div>
<!-- END: Content -->
<script src="<?php echo base_url('/assets/jquery/jquery.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        // $('#dataTable').DataTable();
        let table = new DataTable('#dataTable');

    });

    
</script>