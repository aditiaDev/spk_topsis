        <!-- START: Modal Content -->
        <div id="modal_resetPass" class="modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"> 
                    <div class="modal-header">
                      <h4 class="modal-title">Reset Password</h4>
                    </div>
                    <a data-tw-dismiss="modal" href="javascript:;" onclick="modalHide('modal_add')"> <i data-feather="x" class="w-8 h-8 text-slate-400"></i> </a>
                    <form id="FRM_RESET" method="post">
                      <div class="modal-body p-0">
                        <div class="p-5">
                          <div>
                            <label for="regular-form-1" class="inline-block mb-2">
                                Nama Pengguna
                            </label>
                            <input type="text" name="nm_pengguna_reset" class="form-control rounded-full" value="<?= $this->session->userdata('id_user') ?>" />
                          </div>
                          <div class="mt-3">
                            <label for="regular-form-1" class="inline-block mb-2">
                                Password
                            </label>
                            <input type="password" name="password_reset" class="form-control rounded-full" value="<?= $this->session->userdata('id_user') ?>" />
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-secondary rounded-full" onclick="resetPassHide('modal_resetPass')">Close</button>
                        <button class="btn btn-primary rounded-full" id="BTN_SAVE_PASS">Save changes</button>
                      </div>
                    </form>
                </div>
            </div>
        </div> 
        <!-- END: Modal Content -->
        
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
            <?php
              $stt = $this->db->query("SELECT status_password FROM tb_user WHERE id_user = '".$this->session->userdata('id_user')."'")->row()->status_password;
              if($stt == "BELUM RESET" || $stt == ""){
                echo "resetPass('modal_resetPass')";
              }
            ?>

            function test(){
                if($('html').attr('class') == 'light'){
                    $('html').attr('class', 'dark');
                }else{
                    $('html').attr('class', 'light');
                }
                
            }

            function resetPass(id){
              document.getElementById(id).className = "modal overflow-y-auto show";
              document.getElementById(id).style.marginTop = "0px";
              document.getElementById(id).style.marginLeft = "0px";
              document.getElementById(id).style.paddingLeft = "0px";
              document.getElementById(id).style.zIndex  = "100";
            }

            function resetPassHide(id){
                document.getElementById(id).className = "modal";
                $("#"+id).removeAttr("style");
            }

            $("#BTN_SAVE_PASS").click(function(){
              event.preventDefault();
              let id = "<?= $this->session->userdata('id_user') ?>"
              var formData = $("#FRM_RESET").serialize();
              urlPost = "<?php echo site_url('user/resetPassword') ?>";
              formData+="&id_user="+id

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
                      $("#FRM_RESET")[0].reset()
                      resetPassHide('modal_resetPass')
                    }else{
                      toastr.error(data.message)
                    }
                  }
              })
            })
        </script>
    </body>
</html>