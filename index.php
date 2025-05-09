<?php

// Prevent direct access to the plugin
defined('PLUGINPATH') or exit('No direct script access allowed');

/*
  Plugin Name: Hosting Manager
  Description: Manage hosting with expiry tracking and client/project linking.
  Version: 1.0.1
  Requires at least: 3.3
  Author: Hopperstack
  Author URL: https://codecanyon.net/user/hopperstack
 */

// Installation hook to set up the database or other dependencies
register_installation_hook("Hosting_Manager", function () {

    include PLUGINPATH . "Hosting_Manager/install/do_install.php";
});

// Add "Hosting Manager" to the staff's sidebar menu
app_hooks()->add_filter('app_filter_staff_left_menu', function ($sidebar_menu) {
    $sidebar_menu["hosting_manager"] = array(
        "name" => "hosting_manager",  // Capitalized menu name
        "url" => "hosting_manager",
        "class" => "server",
        "position" => 6
    );
    return $sidebar_menu;
});

// Add "Hosting Manager" to the client's sidebar menu
app_hooks()->add_filter('app_filter_client_left_menu', function ($sidebar_menu) {
    if(get_setting('hosting_manager_client_menu_show') == 1){
        $sidebar_menu["hosting_manager"] = array(
            "name" => "hosting_manager",
            "url" => "hosting_manager",
            "class" => "server",
            "position" => 6
        );
    }

    return $sidebar_menu;
});

// Add Hosting Manager tab to the project details for team members
app_hooks()->add_filter('app_filter_team_members_project_details_tab', function ($project_tabs, $project_info_id) {
    $project_tabs["hosting_manager"] = "hosting_manager/projects/" . $project_info_id;
    return $project_tabs;
});

// Add Hosting Manager tab to the client detail
app_hooks()->add_filter('app_filter_client_details_ajax_tab', function ($project_tabs, $client_info_id) {

    $hook_tabs["hosting_manager"]['url'] =  get_uri("hosting_manager/clients/" . $client_info_id);
    $hook_tabs["hosting_manager"]['title'] = app_lang("hosting_manager");
    $hook_tabs["hosting_manager"]['target'] = "hosting_manager";
    return $hook_tabs;
});

app_hooks()->add_filter('app_filter_admin_settings_menu', function ($settings_menu) {
    $settings_menu["plugins"][] = array("name" => "hosting_manager", "url" => "hosting_manager/setting");
    return $settings_menu;
});
