<div id="page-content" class="page-wrapper clearfix">
   <div class="row">
      <div class="col-sm-3 col-lg-2">
         <?php
            $tab_view['active_tab'] = "client_section";
            echo view("settings/tabs", $tab_view);
            ?>
      </div>
      <div class="col-sm-9 col-lg-10">
         <?php echo form_open(get_uri("client_section/setting/save"), array("id" => "client-settings-form", "class" => "general-form dashed-row", "role" => "form")); ?>
         <div class="card">
            <div class="card-header">
               <h4><?php echo app_lang("client_section_settings"); ?></h4>
            </div>
            <div class="card-body">
            
               <div id="hardware_prefix" class="form-group">
                  <div class="row">
                     <label for="hardware_prefix" class=" col-md-6"><?php echo app_lang('hardware_prefix'); ?></label>
                     <div class=" col-md-6">
                        <?php
                           echo form_input(array(
                               "id" => "hardware_prefix",
                               "name" => "hardware_prefix",
                               "value" => get_setting('hardware_prefix'),
                               "class" => "form-control",
                               "type"=>'text',
                               "data-rule-required" => true,
                               "data-msg-required" => app_lang("field_required"),
                           ));
                           ?>
                     </div>
                  </div>
               </div>
               <div id="software_prefix" class="form-group">
                  <div class="row">
                     <label for="software_prefix" class=" col-md-6"><?php echo app_lang('software_prefix'); ?></label>
                     <div class=" col-md-6">
                        <?php
                           echo form_input(array(
                               "id" => "software_prefix",
                               "name" => "software_prefix",
                               "value" => get_setting('software_prefix'),
                               "class" => "form-control",
                               "type"=>'text',
                               "data-rule-required" => true,
                               "data-msg-required" => app_lang("field_required"),
                           ));
                           ?>
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
   
       $("#client-settings-form").appForm({
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
   
   
    
   });
</script>