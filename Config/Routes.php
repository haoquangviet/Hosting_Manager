<?php

namespace Config;

$routes = Services::routes();

$Hosting_manager_namespace = ['namespace' => 'Hosting_Manager\Controllers'];


$routes->get('hosting_manager/projects/(:any)', 'Hosting_manager::projects/$1', $Hosting_manager_namespace);
$routes->get('hosting_manager/clients/(:any)', 'Hosting_manager::clients/$1', $Hosting_manager_namespace);

$routes->get('hosting_manager', 'Hosting_manager::index', $Hosting_manager_namespace);
$routes->post('hosting_manager/modal_form', 'Hosting_manager::modal_form', $Hosting_manager_namespace);
$routes->get('hosting_manager/view/(:any)', 'Hosting_manager::view/$1', $Hosting_manager_namespace);

$routes->post('hosting_manager/save', 'Hosting_manager::save', $Hosting_manager_namespace);

$routes->post('hosting_manager/delete', 'Hosting_manager::delete', $Hosting_manager_namespace);
$routes->post('hosting_manager/list_data', 'Hosting_manager::list_data', $Hosting_manager_namespace);


$routes->get('hosting_manager/setting', 'Hosting_manager::setting', $Hosting_manager_namespace);
$routes->post('hosting_manager/save_setting', 'Hosting_manager::save_setting', $Hosting_manager_namespace);

$routes->get('hosting_manager/tab/(:any)/(:any)', 'Hosting_manager::tab/$1/$2', $Hosting_manager_namespace);



// Domains
$routes->post('hosting_manager/domain_list_data/(:any)', 'Domain::list_data/$1', $Hosting_manager_namespace);
$routes->post('hosting_manager/domain/modal_form', 'Domain::modal_form', $Hosting_manager_namespace);
$routes->post('hosting_manager/domain/save', 'Domain::save', $Hosting_manager_namespace);
$routes->post('hosting_manager/domain/delete', 'Domain::delete', $Hosting_manager_namespace);


// Database
$routes->post('hosting_manager/database_list_data/(:any)', 'Database::list_data/$1', $Hosting_manager_namespace);
$routes->post('hosting_manager/database/modal_form', 'Database::modal_form', $Hosting_manager_namespace);
$routes->post('hosting_manager/database/save', 'Database::save', $Hosting_manager_namespace);
$routes->post('hosting_manager/database/delete', 'Database::delete', $Hosting_manager_namespace);


// Ftp
$routes->post('hosting_manager/ftp_list_data/(:any)', 'Ftp::list_data/$1', $Hosting_manager_namespace);
$routes->post('hosting_manager/ftp/modal_form', 'Ftp::modal_form', $Hosting_manager_namespace);
$routes->post('hosting_manager/ftp/save', 'Ftp::save', $Hosting_manager_namespace);
$routes->post('hosting_manager/ftp/delete', 'Ftp::delete', $Hosting_manager_namespace);
