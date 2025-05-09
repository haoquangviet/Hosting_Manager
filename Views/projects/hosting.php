<input type="hidden" id="project_id" value="<?=$project_id?>">

<ul class="nav nav-tabs bg-white title" role="tablist">
    <li class="title-tab"><h4 class="pl15 pt10 pr15"><?php echo app_lang('hosting_manager'); ?></h4></li>

    <div class="tab-title clearfix no-border">
        <div class="title-button-group">
            <?php
                echo modal_anchor(get_uri("hosting_manager/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('domain_manager_add'), array("class" => "btn btn-default mb0",  "title" => app_lang('domain_manager_add')));

            ?>
        </div>
    </div>
</ul>

<div class="card no-border-top-radius">
    <div class="table-responsive pb50">
        <table id="hosting_manager-table" class="display" cellspacing="0" width="100%">            
        </table>
    </div>
</div>

<script type="text/javascript">
    "use strict";
    $(document).ready(function () {
        var baseUrl = "<?php echo_uri('hosting_manager/list_data') ?>";
        var projectId = $("#project_id").val();
        var finalUrl = baseUrl + (projectId ? "?project_id=" + encodeURIComponent(projectId) : "");
        var showIdColumn = true;
        if(isMobile()) {
            showIdColumn = false;            
        }

        $("#hosting_manager-table").appTable({
            source: finalUrl,
            order: [[1, "desc"]],
            serverSide: true,
            columns: [
                {visible: false, searchable: false},
                {title: "<?php echo app_lang('id') ?>", visible: showIdColumn, order_by: "id"},
                {title: "<?php echo app_lang('hosting_manager_title') ?>", "class": "all", order_by: "title"},
                {title: "<?php echo app_lang('hosting_manager_provider') ?>", "class": "all", order_by: "provider"},
                {title: "<?php echo app_lang('hosting_manager_client') ?>", "class": "all", order_by: "client_id"},
                {title: "<?php echo app_lang('hosting_manager_start_date') ?>", "class": "all", order_by: "start_date"},
                {title: "<?php echo app_lang('hosting_manager_expiry_date') ?>", "class": "all", order_by: "expiry_date"},
                {title: "<?php echo app_lang('hosting_manager_status') ?>", "class": "all", order_by: "status"},
                {title: "<i data-feather='menu' class='icon-16'></i>", "class": "text-center option w150"}
            ],
        });
    });
</script>
