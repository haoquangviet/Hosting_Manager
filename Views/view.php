<div id="page-content" class="clearfix page-wrapper">
    <div class="clearfix leads-details-view">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title clearfix no-border no-border-top-radius no-bg leads-page-title">
                    <h1 class="pl0">
                        <?php echo app_lang('host_details') . " - " . $account_info->title ?> 
                    </h1>
                   
                </div>

                <ul data-bs-toggle="ajax-tab" class="nav nav-tabs scrollable-tabs" role="tablist">
                
                    <li><a  role="presentation" data-bs-toggle="tab" href="<?php echo_uri("hosting_manager/tab/info/" . $account_info->id); ?>" data-bs-target="#account-info"> <?php echo app_lang('hosting_info'); ?></a></li>
                    <li><a  role="presentation" data-bs-toggle="tab" href="<?php echo_uri("hosting_manager/tab/domains/" . $account_info->id); ?>" data-bs-target="#account-domains"><?php echo app_lang('domains'); ?></a></li>
					<li><a  role="presentation" data-bs-toggle="tab" href="<?php echo_uri("hosting_manager/tab/database/" . $account_info->id); ?>" data-bs-target="#account-database"><?php echo app_lang('database'); ?></a></li>
					<li><a  role="presentation" data-bs-toggle="tab" href="<?php echo_uri("hosting_manager/tab/ftp/" . $account_info->id); ?>" data-bs-target="#account-ftp"><?php echo app_lang('ftp'); ?></a></li>


                  

                    <?php
                    $hook_tabs = array();
                    $hook_tabs = app_hooks()->apply_filters('app_filter_lead_details_ajax_tab', $hook_tabs, $account_info->id);
                    $hook_tabs = is_array($hook_tabs) ? $hook_tabs : array();
                    foreach ($hook_tabs as $hook_tab) {
                        ?>
                        <li><a role="presentation" data-bs-toggle="tab" href="<?php echo get_array_value($hook_tab, 'url') ?>" data-bs-target="#<?php echo get_array_value($hook_tab, 'target') ?>"><?php echo get_array_value($hook_tab, 'title') ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content hosting-tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="account-info"></div>
                    <div role="tabpanel" class="tab-pane fade" id="account-domains"></div>
                    <div role="tabpanel" class="tab-pane fade" id="account-database"></div>
                    <div role="tabpanel" class="tab-pane fade" id="account-ftp"></div>
                    <?php foreach ($hook_tabs as $hook_tab) { ?>
                        <div role="tabpanel" class="tab-pane fade" id="<?php echo get_array_value($hook_tab, 'target') ?>"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        var tab = "<?php echo $tab; ?>";
        if (tab === "info") {
            $("[data-bs-target='#lead-info']").trigger("click");
        }

    });
</script>
