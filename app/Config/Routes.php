<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('/users', [], function($routes) {
    $routes->get('/', function () {
        return redirect()->to(base_url('users/page/1'));
    });
    $routes->get('page/(:num)', 'User::index/$1');
    $routes->get('create', 'User::create');
    $routes->post('store', 'User::store');
    $routes->get('edit/(:num)', 'User::edit/$1');
    $routes->post('update/(:num)', 'User::update/$1');
    $routes->post('toggleActive/(:num)', 'User::toggleActive/$1');
    $routes->delete('delete/(:num)', 'User::delete/$1');
    // $routes->post('getUsers', 'User::getUsers');
});
// $routes->get('/user', 'User::index');
// $routes->post('/user/getUsers', 'User::getUsers');
// $routes->post('/user/add', 'User::add');
// $routes->get('/user/edit/(:any)', 'User::edit/$1');
// $routes->put('/user/edit', 'User::edit');
// $routes->get('/user/delete/(:any)', 'User::delete/$1');
