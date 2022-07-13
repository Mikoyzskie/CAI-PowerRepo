<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('',['filter'=>'AuthCheck'], function($routes){
    //Add all routes protected by the filter;
    
    $routes->get('/dashboard', 'dashboard::index');
    $routes->get('/dashboard/lessons', 'dashboard::lessons');
    $routes->get('/dashboard/mates', 'dashboard::mates');
    $routes->get('/dashboard/post', 'dashboard::post');
    $routes->get('/dashboard/profile', 'dashboard::profile');
    $routes->get('/dashboard/settings', 'dashboard::settings');
    $routes->get('/dashboard/quiz', 'dashboard::quiz');
   
    
});

$routes->group('',['filter'=>'AlreadyLoggedFilter'], function($routes){
    $routes->get('/auth/frequently_asked_questions', 'Auth::frequently_asked_questions');
    $routes->get('/auth', 'Auth::index');
    $routes->get('/auth/register', 'Auth::register');

});

$routes->group('',['filter'=>'AdminLoggedFilter'], function($routes){
    $routes->get('/admin/login', 'admin::login');
    

});

$routes->group('',['filter'=>'AdminCheck'], function($routes){
    //Add all routes protected by the filter;
    
    $routes->get('/admin', 'admin::index');
    $routes->get('/admin/check', 'admin::check');
    $routes->get('/admin/admins', 'admin::admins');
    $routes->get('/admin/user', 'admin::user');
    $routes->get('/admin/unlock', 'admin::unlock');
    $routes->get('/admin/lessons', 'admin::lessons');
    $routes->get('/admin/lessons', 'admin::lessons');
    $routes->get('/admin/searchlesson', 'admin::searchlesson');
    $routes->get('/admin/searchuser', 'admin::searchuser');
    $routes->get('/admin/searchevent', 'admin::searchevent');
    $routes->get('/admin/lesson', 'admin::lesson');
    $routes->get('/admin/events', 'admin::events');
    $routes->get('/admin/questions', 'admin::questions');
    $routes->get('/admin/tests', 'admin::tests');
    $routes->get('/admin/check_lesson', 'admin::check_lesson');
    $routes->get('/admin/publish_lesson', 'admin::publish_lesson');
    $routes->get('/admin/delete_users', 'admin::delete_users');
    $routes->get('/admin/restore_users', 'admin::restore_users');
    $routes->get('/admin/delete_lesson', 'admin::delete_lesson');
    $routes->get('/admin/restore_lesson', 'admin::restore_lesson');
    $routes->get('/admin/edit_lesson', 'admin::edit_lesson');
    $routes->get('/admin/edit_user', 'admin::edit_user');
    $routes->get('/admin/settings', 'admin::settings');
    $routes->get('/admin/update_user', 'admin::update_user');
    $routes->get('/admin/update_lessson', 'admin::update_lessson');
    $routes->get('/admin/insertUser', 'admin::insertUser');
    $routes->get('/admin/verify', 'admin::verify');
    $routes->get('/admin/user_archive', 'admin::user_archive');
    $routes->get('/admin/administrator', 'admin::administrator');
    $routes->get('/admin/user_archive_search', 'admin::user_archive_search');
    $routes->get('/admin/lesson_archive', 'admin::lesson_archive');
    
    
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
