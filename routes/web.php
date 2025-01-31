<?php

// The $router object is now passed in
$router->addRoute('/', 'HomeController@home');
$router->addRoute('/vendors', 'HomeController@vendors');
$router->addRoute('/dishes', 'HomeController@dishes');
$router->addRoute('/login', 'AuthController@login');
$router->addRoute('/logout', 'AuthController@logout');
$router->addRoute('/register', 'AuthController@register');
$router->addRoute('/profile', 'UserController@profile', true, ['customer']);
$router->addRoute('/profile/update', 'UserController@updateProfile', true, ['customer']);
$router->addRoute('/profile/change-password', 'UserController@changePassword', true, ['customer']);
$router->addRoute('/profile/delete', 'UserController@deleteAccount', true, ['customer']);
$router->addRoute('/user/settings', 'UserController@settings', true, ['customer']);

// Define vendor (business) routes
$router->addRoute('/business', 'HomeController@business');
$router->addRoute('/business/login', 'AuthController@login');
$router->addRoute('/business/logout', 'AuthController@logout');
$router->addRoute('/business/register', 'AuthController@register');
$router->addRoute('/business/dashboard', 'VendorController@dashboard', true, ['vendor']);
$router->addRoute('/business/dashboard/menu', 'VendorController@menu', true, ['vendor']);
$router->addRoute('/business/dashboard/orders', 'VendorController@orders', true, ['vendor']);
$router->addRoute('/business/dashboard/customers', 'VendorController@customers', true, ['vendor']);

// Define admin routes
$router->addRoute('/admin', 'AuthController@login');
$router->addRoute('/admin/login', 'AuthController@login');
$router->addRoute('/admin/logout', 'AuthController@logout');
$router->addRoute('/admin/dashboard', 'AdminController@dashboard', true, ['admin']);
$router->addRoute('/admin/dashboard/manage-users', 'AdminController@manageUsers', true, ['admin']);