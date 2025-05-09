<?php echo form_open(get_uri("hosting_manager/database/save"), array("id" => "hosting_manager-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <input type="hidden" name="id" value="<?=$id??''?>" />
            <input type="hidden" name="hosting_id" value="<?=$host_id??''?>" />
            <div class="form-group">
                <div class="row">
                    <label for="title" class=" col-md-3"><?php echo app_lang('hosting_manager_title'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "title",
                            "name" => "title",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_title'),
                        ));
                        ?>
                </div>
                </div>
            </div>
           
     
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_access_url" class=" col-md-3"><?php echo app_lang('hosting_manager_access_url'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "access_url",
                            "name" => "access_url",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_access_url'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_database_name" class=" col-md-3"><?php echo app_lang('hosting_manager_database_name'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "access_url",
                            "name" => "database_name",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_database_name'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_database_username" class=" col-md-3"><?php echo app_lang('hosting_manager_database_username'); ?></label>
                    <div class=" col-md-9">
                        <div class="input-group">
                            <?php
                                echo form_password(array(
                                    "id" => "database_password",
                                    "name" => "database_password",
                                    "value" =>  "",
                                    "class" => "form-control",
                                    "placeholder" => app_lang('hosting_manager_database_password'),
                                    "style" => "z-index:auto;",
                                    "autocomplete" => "off"
                                ));
                            ?>
                            <a href="#" id="show_hide_password" class="btn btn-default" title="<?php echo app_lang('show_text'); ?>"><span data-feather="eye" class="icon-16"></span></a>
                            <a href="#" id="copy_password" class="btn btn-default" title="<?php echo app_lang('copy'); ?>"><span data-feather="copy" class="icon-16"></span></a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_database_password" class=" col-md-3"><?php echo app_lang('hosting_manager_database_password'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "access_url",
                            "name" => "database_password",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_database_password'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="status" class=" col-md-3"><?php echo app_lang('status'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_dropdown("status", [
                            'enabled'=>app_lang('hosting_manager_enabled'),
                            'disabled'=>app_lang('hosting_manager_disabled')
                        ], '', "class='select2 validate-hidden' id='status' data-plea='true'");
                        ?>
                    </div>
                </div>
            </div>
        
           
            <div class="form-group">
                <div class="row">
                    <label for="description" class=" col-md-3"><?php echo app_lang('description') ?></label>
                    <div class=" col-md-9">
                        <textarea name="description" cols="40" rows="10" id="description" class="form-control" placeholder="<?php echo app_lang('description') ?>" data-rich-text-editor=""><?php echo $model_info->description ??  "" ?></textarea>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
        <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
    </div>
<?php echo form_close(); ?>

<script type="text/javascript">
    "use strict";

    $(document).ready(function () {

       
        $("#hosting_manager-form").appForm({
            onSuccess: function (result) {
                appLoader.hide();
                appAlert.success(result.message, {duration: 10000});

                setTimeout(function () {
                        location.reload();
                    }, 1000);
            },
            onError: function (result) {
                appLoader.hide();
                appAlert.error(result.message);
            }
        });
        $("#hosting_manager-form .select2").select2({
            placeholder: "Select a projects",
            
        });
        $('[data-bs-toggle="tooltip"]').tooltip();
        $("#show_hide_password").click(function () {
            var $target = $("#database_password"),
                    type = $target.attr("type");
            if (type === "password") {
                $(this).attr("title", "<?php echo app_lang("hide_text"); ?>");
                $(this).html("<span data-feather='eye-off' class='icon-16'></span>");
                feather.replace();
                $target.attr("type", "text");
            } else if (type === "text") {
                $(this).attr("title", "<?php echo app_lang("show_text"); ?>");
                $(this).html("<span data-feather='eye' class='icon-16'></span>");
                feather.replace();
                $target.attr("type", "password");
            }
        });

        $("#copy_password").click(function () {
            var password = $("#database_password").val().trim(); // Use `.val()` if it's an input field

            if (!password) {
                appAlert.error('No password found to copy.');
                return;
            }
            navigator.clipboard.writeText(password).then(function () {
                appAlert.success('Copied password successfully.', { duration: 10000 });
            }).catch(function (err) {
                appAlert.error('Failed to copy password.');
                console.error('Clipboard copy failed:', err);
            });
        });
    });
</script>