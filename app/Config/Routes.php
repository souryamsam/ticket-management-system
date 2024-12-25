<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/sign-in', 'User::index');
$routes->get('/sign-out', 'User::sign_out');
$routes->post('login', 'User::is_login');
$routes->match(['get', 'post'], 'dashboard', 'Dashboard::index', ['filter' => 'authGuard', 'as' => 'user_dashboard']);
$routes->match(['get', 'post'], 'user-master', 'User_Master::index', ['filter' => 'authGuard', 'as' => 'user_master']);
$routes->match(['get', 'post'], 'customer-master', 'Coustomer_Master::index', ['filter' => 'authGuard', 'as' => 'customer_master']);
$routes->post('save-customer-data', 'Coustomer_Master::save_customer_master_info', ['filter' => 'authGuard', 'as' => 'save_customer_master']);
$routes->post('save-usermaster-data', 'User_Master::save_user_master', ['filter' => 'authGuard', 'as' => 'save_user_master']);
$routes->match(['get', 'post'], 'project-master-view', 'Project_Master::project_master_view', ['filter' => 'authGuard', 'as' => 'project_master_view']);
$routes->match(['get', 'post'], 'customer-master-view', 'Coustomer_Master::customer_master_view', ['filter' => 'authGuard', 'as' => 'customer_master_view']);
$routes->match(['get', 'post'], 'project-master', 'Project_Master::project_master', ['filter' => 'authGuard', 'as' => 'project_master']);
$routes->match(['get', 'post'], 'user-master-view', 'User_Master::user_master_view', ['filter' => 'authGuard', 'as' => 'user_master_view']);
$routes->post('save-project-master-data', 'Project_Master::save_project_master_data', ['filter' => 'authGuard', 'as' => 'save_project_master']);
$routes->post('project-master-duplicate-check', 'Project_Master::project_master_name_duplicate_check', ['filter' => 'authGuard', 'as' => 'project_master_duplicate_check']);
$routes->match(['get', 'post'], 'role-master', 'User::role_master', ['filter' => 'authGuard', 'as' => 'role_master']);
$routes->post('save-role-master', 'User::role_master_save', ['filter' => 'authGuard', 'as' => 'save_role_master']);
$routes->match(['get', 'post'], 'role-master-view', 'User::role_master_view', ['filter' => 'authGuard', 'as' => 'role_master_view']);
$routes->post('customer-master-update-status', 'User_Master::update_status_user_master', ['filter' => 'authGuard', 'as' => 'update_status_customer_master']);