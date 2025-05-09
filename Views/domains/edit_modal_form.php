<?php echo form_open(get_uri("hosting_manager/domain/save"), array("id" => "hosting_manager-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <input type="hidden" name="id" value="<?=$id??''?>" />
            <input type="hidden" name="hosting_id" value="<?=$host_id??''?>" />
            <div class="form-group">
                <div class="row">
                    <label for="Title" class=" col-md-3"><?php echo app_lang('hosting_manager_domain_name'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "domain_name",
                            "name" => "domain_name",
                            "value" => $modal_info->title??'',
                            "class" => "form-control",
                            "placeholder" => app_lang('hosting_manager_domain_name'),
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
                            "value" => $modal_info->price??'',
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
                    <label for="ssl_status" class=" col-md-3"><?php echo app_lang('ssl_status'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_dropdown("ssl_status", [
                            'enabled'=>app_lang('hosting_manager_enabled'),
                            'disabled'=>app_lang('hosting_manager_disabled')
                        ], $modal_info->ssl_status ??  "", "class='select2 validate-hidden' id='ssl_status' data-plea='true'");
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="status" class=" col-md-3"><?php echo app_lang('domain_status'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_dropdown("status", $status_dropdown, $modal_info->status ??  "", "class='select2 validate-hidden' id='status' data-plea='true'");
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
    });
</script>