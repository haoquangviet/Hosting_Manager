<?php

ini_set('max_execution_time', 300); // Set max execution time to 300 seconds

$product = "Hosting_Manager";


// Connect to database
$db = db_connect('default');

// Start installation
try {



    // Save purchase code in settings
    $Settings_model = model("App\Models\Settings_model");
    $Settings_model->save_setting("hosting_manager_client_permission", 1);
    $Settings_model->save_setting("hosting_manager_client_menu_show", 'show');


    $dbprefix = get_db_prefix();

    $sql_query = "CREATE TABLE IF NOT EXISTS `" . $dbprefix . "hosting_account` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL,
        `provider` VARCHAR(255) DEFAULT NULL,
        `provider_url` VARCHAR(255) DEFAULT NULL,
        `provider_user` VARCHAR(255) DEFAULT NULL,
        `provider_password` VARCHAR(255) DEFAULT NULL,
        `plan` VARCHAR(255) DEFAULT NULL,
        `price` VARCHAR(255) DEFAULT NULL,
        `start_date` DATE DEFAULT NULL,
        `expiry_date` DATE DEFAULT NULL,
        `status` VARCHAR(255) NOT NULL DEFAULT 'active',
        `client_id` INT(11) DEFAULT NULL,  -- Links to clients table
        `project_id` INT(11) DEFAULT NULL, -- Links to projects table
        `description` TEXT DEFAULT NULL,  -- Additional notes
        `deleted` TINYINT(1) NOT NULL DEFAULT '0',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    );";

    // Execute the query
    $db->query($sql_query);



    $sql_query = "CREATE TABLE IF NOT EXISTS `" . $dbprefix . "hm_domains` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `hosting_id` INT(11) DEFAULT NULL,  -- Links to hosting table
        `title` VARCHAR(255) NOT NULL,
        `ssl_active` VARCHAR(255) NOT NULL DEFAULT 'enable',
        `price` VARCHAR(255) DEFAULT NULL,
        `status` VARCHAR(255) NOT NULL DEFAULT 'active',
        `description` TEXT DEFAULT NULL,  -- Additional notes
        `deleted` TINYINT(1) NOT NULL DEFAULT '0',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    );";

    // Execute the query
    $db->query($sql_query);

    $sql_query = "CREATE TABLE IF NOT EXISTS `" . $dbprefix . "hm_database` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `hosting_id` INT(11) DEFAULT NULL,  -- Links to hosting table
        `title` VARCHAR(255)  DEFAULT NULL,
        `access_url` VARCHAR(255)  DEFAULT NULL,
        `database_name` VARCHAR(255)  DEFAULT NULL,
        `database_username` VARCHAR(255)  DEFAULT NULL,
        `database_password` VARCHAR(255)  DEFAULT NULL,
        `status` VARCHAR(255) NOT NULL DEFAULT 'enable',
        `description` TEXT DEFAULT NULL,  -- Additional notes
        `deleted` TINYINT(1) NOT NULL DEFAULT '0',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    );";

    // Execute the query
    $db->query($sql_query);





    $sql_query = "CREATE TABLE IF NOT EXISTS  `" . $dbprefix . "ftp_accounts` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `hosting_id` INT(11) DEFAULT NULL,  -- Links to hosting table
        `account_name` VARCHAR(255) NOT NULL,
        `hostname` VARCHAR(255) DEFAULT NULL,
        `username` VARCHAR(255) DEFAULT NULL,
        `password` VARCHAR(255) DEFAULT NULL,
        `port` VARCHAR(255) DEFAULT NULL,
        `protocol` VARCHAR(255) NOT NULL DEFAULT 'ftp',
        `root_directory` VARCHAR(255) DEFAULT NULL,
        `status` VARCHAR(255) NOT NULL DEFAULT 'active',
        `description` TEXT DEFAULT NULL,  -- Additional notes
        `deleted` TINYINT(1) NOT NULL DEFAULT '0',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    );";

    // Execute the query
    $db->query($sql_query);


    // Return success response

} catch (Exception $e) {
    echo json_encode(array("success" => false, "message" => "Installation failed: " . $e->getMessage()));
    exit();
}
