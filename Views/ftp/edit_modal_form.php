<?php echo form_open(get_uri("hosting_manager/ftp/save"), array("id" => "hosting_manager-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <input type="hidden" name="id" value="<?=$id??''?>" />
            <input type="hidden" name="hosting_id" value="<?=$host_id??''?>" />
            <div class="form-group">
                <div class="row">
                    <label for="name" class=" col-md-3"><?php echo app_lang('hosting_manager_ac_name'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "name",
                            "name" => "name",
                            "value" => $modal_info->account_name ??  "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_ac_name'),
                        ));
                        ?>
                </div>
                </div>
            </div>
           
     
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_hostname" class=" col-md-3"><?php echo app_lang('hosting_manager_hostname'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hostname",
                            "name" => "hostname",
                            "value" => $modal_info->hostname ??  "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_hostname'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
           
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_ftp_username" class=" col-md-3"><?php echo app_lang('hosting_manager_ftp_username'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_ftp_username",
                            "name" => "username",
                            "value" =>  $modal_info->username ??  "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_ftp_username'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_ftp_password" class=" col-md-3"><?php echo app_lang('hosting_manager_ftp_password'); ?></label>
                    <div class=" col-md-9">
                        <div class="input-group">
                            <?php
                                echo form_password(array(
                                    "id" => "hosting_manager_ftp_password",
                                    "name" => "password",
                                    "value" => $modal_info->password ??  "",
                                    "class" => "form-control",
                                    "placeholder" => app_lang('hosting_manager_ftp_password'),
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
                    <label for="hosting_manager_ftp_port" class=" col-md-3"><?php echo app_lang('hosting_manager_ftp_port'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_ftp_port",
                            "name" => "port",
                            "value" => $modal_info->port ??  "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_ftp_port'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_ftp_protocol" class=" col-md-3"><?php echo app_lang('hosting_manager_ftp_protocol'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_ftp_protocol",
                            "name" => "protocol",
                            "value" => $modal_info->protocol ??  "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_ftp_protocol'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_ftp_root_directory" class=" col-md-3"><?php echo app_lang('hosting_manager_ftp_root_directory'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_ftp_root_directory",
                            "name" => "root_directory",
                            "value" => $modal_info->root_directory ??  "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_ftp_root_directory'),
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
                        ], $modal_info->status ??  "", "class='select2 validate-hidden' id='status' data-plea='true'");
                        ?>
                    </div>
                </div>
            </div>
           
            <div class="form-group">
                <div class="row">
                    <label for="description" class=" col-md-3"><?php echo app_lang('description') ?></label>
                    <div class=" col-md-9">
                        <textarea name="description" cols="40" rows="10" id="description" class="form-control" placeholder="<?php echo app_lang('description') ?>" value="<?php echo $modal_info->description ??  "" ?>"><?php echo $modal_info->description ?></textarea>
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
        $("#hosting_manager-form .select2").select2();
        $('[data-bs-toggle="tooltip"]').tooltip();

        $("#show_hide_password").click(function () {
            var $target = $("#hosting_manager_ftp_password"),
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
            var password = $("#hosting_manager_ftp_password").val().trim(); // Use `.val()` if it's an input field

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