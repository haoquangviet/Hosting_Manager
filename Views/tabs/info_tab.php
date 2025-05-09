<div class="tab-content">
    <?php echo form_open(get_uri("hosting_manager/save/"), array("id" => "company-form", "class" => "general-form dashed-row white", "role" => "form")); ?>
    <div class="card border-top-0 rounded-top-0">
        <div class="card-header no-border-top-radius">
            <h4> <?php echo app_lang('hosting_info'); ?></h4>
        </div>
        <div class="card-body">
        <input type="hidden" name="id" value="<?=$id??''?>" />

<div class="form-group">
    <div class="row">
        <label for="Title" class=" col-md-3"><?php echo app_lang('hosting_manager_title'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "hosting_manager_title",
                "name" => "title",
                "value" => $model_info->title ??  "",
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
                "value" => $model_info->provider ??  "",
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
                "value" => $model_info->provider_url ??  "",
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
                "value" =>$model_info->provider_user ??  "",
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
            <?php
            echo form_input(array(
                "id" => "hosting_manager_provider_password",
                "name" => "provider_password",
                "value" => $model_info->provider_password ??  "",
                "class" => "form-control",
                "placeholder" => app_lang('hosting_manager_provider_password'),
                "autocomplete" => "off"
            ));
            ?>
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
                "value" => $model_info->plan ??  "",
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
                "value" => $model_info->price ??  "",
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
                "value" => $model_info->start_date ??  "",
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
                "value" => $model_info->expiry_date ??  "",
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
            echo form_dropdown("status", $status_dropdown, $model_info->status ??  "", "class='select2 validate-hidden' id='status' data-plea='true'");
            ?>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="project_id" class=" col-md-3"><?php echo app_lang('hosting_manager_project_id'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_dropdown("project_id", $projects_dropdown, $model_info->project_id ??  "", "class='select2 validate-hidden' id='project_id' data-plea='true'");
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
            echo form_dropdown("client_id", $clients_dropdown, $model_info->client_id ??  "", "class='select2 validate-hidden' id='client_id' data-plea='true'");
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
        </div>
        <div class="card-footer rounded-0">
            <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();





        $("#company-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
            }
        });
    });
</script>