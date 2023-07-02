        <!-- BEGIN: Dark Mode Switcher-->
        <div data-url="javascript:;" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-slate-600 dark:text-slate-200" >Dark Mode</div>
            <div class="dark-mode-switcher__toggle border" onclick="test()"></div>
        </div>
        <!-- END: Dark Mode Switcher-->
        
        <!-- BEGIN: JS Assets-->
        <script src="<?php echo base_url('/assets/dist/js/app.js'); ?>"></script>
        <!-- END: JS Assets-->

        <script src="<?php echo base_url('/assets/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/toastr/toastr.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/select2/select2.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/tabs/alpine.min.js'); ?>" ></script>

        <script>
            function test(){
                if($('html').attr('class') == 'light'){
                    $('html').attr('class', 'dark');
                }else{
                    $('html').attr('class', 'light');
                }
                
            }
        </script>
    </body>
</html>