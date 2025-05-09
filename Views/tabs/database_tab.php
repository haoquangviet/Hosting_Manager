<div class="card border-top-0 rounded-top-0">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('database'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("hosting_manager/database/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_database'), array("class" => "btn btn-default mb0", "data-post-host_id" => $account_info->id, "title" => app_lang('add_database'))); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="database-table" class="display" width="100%">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var showIdColumn = true;

        if (isMobile()) {
            showIdColumn = false;
        }

        var idColumnClass = "";
        
            idColumnClass = "w10p";

        $("#database-table").appTable({
            source: '<?php echo_uri("hosting_manager/database_list_data/" . $account_info->id) ?>',
            order: [[0, "desc"]],
            serverSide: true,
            columns: [
                {visible: false, searchable: false},
                {title: "<?php echo app_lang('hosting_manager_title') ?>", "class": "all", order_by: "title"},
                {title: "<?php echo app_lang('hosting_manager_database_name') ?>", "class": "all", order_by: "database_name"},
                {title: "<?php echo app_lang('hosting_manager_database_username') ?>", "class": "all", order_by: "database_username"},
                {title: "<?php echo app_lang('status') ?>", order_by: "status"},
                {title: '<i data-feather="menu" class="icon-16"></i>', "class": "text-center option w100"}
            ],
            
        });
    });
</script>