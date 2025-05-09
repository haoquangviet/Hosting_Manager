<div id="page-content" class="page-wrapper clearfix">
   <div class="row">
      <div class="col-sm-3 col-lg-2">
         <?php
            $tab_view['active_tab'] = "hosting_manager";
            echo view("settings/tabs", $tab_view);
            ?>
      </div>
      <div class="col-sm-9 col-lg-10">
         <?php echo form_open(get_uri("hosting_manager/save_setting"), array("id" => "autologout-settings-form", "class" => "general-form dashed-row", "role" => "form")); ?>
         <div class="card">
            <div class="card-header">
               <h4><?php echo app_lang("hosting_manager_settings"); ?></h4>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <div class="row">
                     <label for="hosting_manager_client_menu_show" class=" col-md-6"><?php echo app_lang('hosting_manager_client_menu_show'); ?></label>
                     <div class=" col-md-6">
                        <?php
                           $hosting_manager_client_menu_show = array(
                               "0" => "No",
                               "1" => "Yes",
                           );
                           echo form_dropdown(
                                   "hosting_manager_client_menu_show", $hosting_manager_client_menu_show, get_setting('hosting_manager_client_menu_show'), "class='select2 mini' id='hosting_manager_client_menu_show'"
                           );
                           ?>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <label for="hosting_manager_client_permission" class=" col-md-6"><?php echo app_lang('hosting_manager_client_action_permission'); ?></label>
                     <div class=" col-md-6">
                      
                            <input type="text" value="<?=get_setting('client_permission')?>" name="client_permission" id="client_permission" class="w100p validate-hidden"  data-rule-required="false" data-msg-required="<?php echo app_lang('field_required'); ?>" placeholder="<?php echo app_lang('hosting_manager_client_action_permission'); ?>"  />    

                     </div>
                  </div>
               </div>
           
            </div>
            
            <div class="card-footer">
               <button id="save-button" type="submit" class="btn btn-primary"><span data-feather='check-circle' class="icon-16"></span> <?php echo app_lang('save'); ?></button>
            </div>
         </div>
         <?php echo form_close(); ?>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
   
       $("#autologout-settings-form").appForm({
           isModal: false,
           onSubmit: function () {
               appLoader.show();
           },
           onSuccess: function (result) {
               appLoader.hide();
               appAlert.success(result.message, {duration: 10000});
           },
           onError: function (result) {
               appLoader.hide();
               appAlert.error(result.message);
           }
       });
   
       $("#hosting_manager_client_menu_show").select2();
     
       $("#client_permission").select2({
            multiple: true,
            data: [
                { id: 'create', text: 'Create' },
                { id: 'show', text: 'Show' },
                { id: 'edit', text: 'Edit' },
                { id: 'delete', text: 'Delete' }
            ]
        });
    
   });
</script>