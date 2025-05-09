<div class="card border-top-0 rounded-top-0">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('ftp'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("hosting_manager/ftp/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_ftp'), array("class" => "btn btn-default mb0", "data-post-host_id" => $account_info->id, "title" => app_lang('add_ftp'))); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="ftp-table" class="display" width="100%">
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

        $("#ftp-table").appTable({
            source: '<?php echo_uri("hosting_manager/ftp_list_data/" . $account_info->id) ?>',
            order: [[0, "desc"]],
            serverSide: true,
            columns: [
                {visible: false, searchable: false},
                {title: "<?php echo app_lang('hosting_manager_ac_name') ?>", "class": "all", order_by: "account_name"},
                {title: "<?php echo app_lang('hosting_manager_hostname') ?>", "class": "all", order_by: "hostname"},
                {title: "<?php echo app_lang('hosting_manager_ftp_username') ?>", "class": "all", order_by: "username"},
                {title: "<?php echo app_lang('hosting_manager_ftp_port') ?>", "class": "all", order_by: "port"},
                {title: "<?php echo app_lang('hosting_manager_ftp_protocol') ?>", "class": "all", order_by: "protocol"},
                {title: "<?php echo app_lang('hosting_manager_ftp_root_directory') ?>", "class": "all", order_by: "root_directory"},
                {title: "<?php echo app_lang('status') ?>", order_by: "status"},
                {title: '<i data-feather="menu" class="icon-16"></i>', "class": "text-center option w100"}
            ],
            
        });
    });
</script>