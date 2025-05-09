<?php echo form_open(get_uri("hosting_manager/save"), array("id" => "hosting_manager-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <input type="hidden" name="id" value="<?=$id??''?>" />
            <div class="form-group">
                <div class="row">
                    <label for="Title" class=" col-md-3"><?php echo app_lang('hosting_manager_title'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_title",
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
                    <label for="hosting_manager_provider" class=" col-md-3"><?php echo app_lang('hosting_manager_provider'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_provider",
                            "name" => "provider",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_provider'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_provider_url" class=" col-md-3"><?php echo app_lang('hosting_manager_provider_url'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_provider_url",
                            "name" => "provider_url",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_provider_url'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_provider_username" class=" col-md-3"><?php echo app_lang('hosting_manager_provider_username'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_provider_username",
                            "name" => "provider_username",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_provider_username'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_provider_password" class=" col-md-3"><?php echo app_lang('hosting_manager_provider_password'); ?></label>
                    <div class=" col-md-9">


                    <div class="input-group">
                            <?php
                            echo form_password(array(
                                "id" => "hosting_manager_provider_password",
                                "name" => "provider_password",
                                "class" => "form-control",
                                "placeholder" => app_lang('hosting_manager_provider_password'),
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
                    <label for="hosting_manager_provider_plan" class=" col-md-3"><?php echo app_lang('hosting_manager_provider_plan'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_provider_plan",
                            "name" => "provider_plan",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_provider_plan'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_price" class=" col-md-3"><?php echo app_lang('hosting_manager_price'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_price",
                            "name" => "price",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_price'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_start_date" class=" col-md-3"><?php echo app_lang('hosting_manager_start_date'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_start_date",
                            "name" => "start_date",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_start_date'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <label for="hosting_manager_expiry_date" class=" col-md-3"><?php echo app_lang('hosting_manager_expiry_date'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "hosting_manager_expiry_date",
                            "name" => "expiry_date",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_expiry_date'),
                            "autocomplete" => "off"
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="status" class=" col-md-3"><?php echo app_lang('hosting_manager_status'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_dropdown("status", $status_dropdown, '', "class='select2 validate-hidden' id='status' data-plea='true'");
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="project_id" class=" col-md-3"><?php echo app_lang('hosting_manager_project_id'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_dropdown("project_id", $projects_dropdown, '', "class='select2 validate-hidden' id='project_id' data-plea='true'");
                        ?>
                    </div>
                </div>
            </div>
            <?php if($user->user_type != 'client'){ ?> 
            <div class="form-group">
                <div class="row">
                    <label for="client_id" class=" col-md-3"><?php echo app_lang('hosting_manager_client_id'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_dropdown("client_id", $clients_dropdown, '', "class='select2 validate-hidden' id='client_id' data-plea='true'");
                        ?>
                    </div>
                </div>
            </div>
            <?php }else{ ?>

                <input type="hidden" name="client_id" value="<?=$user->client_id?>">
            <?php } ?>
            <div class="form-group">
                <div class="row">
                    <label for="description" class=" col-md-3"><?php echo app_lang('description') ?></label>
                    <div class=" col-md-9">
                        <textarea name="description" cols="40" rows="10" id="description" class="form-control" placeholder="<?php echo app_lang('description') ?>" data-rich-text-editor=""><?php echo $model_info->description ??  "" ?></textarea>
                    </div>
                </div>
            </div>
            <?php echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => "col-md-3", "field_column" => " col-md-9")); ?>

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

        setDatePicker("#hosting_manager_start_date, #hosting_manager_expiry_date");
       
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
            var $target = $("#hosting_manager_provider_password"),
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
            var password = $("#hosting_manager_provider_password").val().trim(); // Use `.val()` if it's an input field

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