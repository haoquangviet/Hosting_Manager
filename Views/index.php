<div id="page-content" class="page-wrapper clearfix grid-button leads-view">
<div class="card rounded-top-0">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('hosting_manager'); ?></h4>
        <div class="title-button-group">
            <?php
            
                $permissions = explode(',', get_setting('client_permission'));
                    
                if($user->user_type == 'client' && !empty($permissions) && in_array('create',$permissions)){
                    echo modal_anchor(get_uri("hosting_manager/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('hosting_manager_add'), array("class" => "btn btn-default mb0",  "title" => app_lang('hosting_manager_add')));
                }else if($user->user_type != 'client'){
                    echo modal_anchor(get_uri("hosting_manager/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('hosting_manager_add'), array("class" => "btn btn-default mb0",  "title" => app_lang('hosting_manager_add')));
                }
            ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="hosting_manager-table" class="display" width="100%">

        </table>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var showIdColumn = true;
        var user_type = '<?=$user->user_type?>';
        var client_id = '<?=$user->client_id?>';
        var list_url =  '<?php echo_uri("hosting_manager/list_data/") ?>';
        if(isMobile()) {
            showIdColumn = false;            
        }


        if(user_type == 'client'){
            list_url = '<?php echo_uri("hosting_manager/list_data/") ?>'+'?client_id='+client_id;
        }

        var RangeButtonSelectedOption = 'monthly';
      
        $("#hosting_manager-table").appTable({
            source: list_url,
            order: [[0, "desc"]],
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
            ]
        });
    });
</script>
