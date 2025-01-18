<?php

require_once dirname(__DIR__) . '/init.php'; // Initialize app
require_once ROOT_DIR . '/app/Core/Router.php'; // Include router

use App\Core\Router;

// Check if the user is logged in and fetch the user role
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['user_role'] ?? null; // Default null

// Get the current path from the request URL
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router();

// Public Routes 
$router->addRoute('/', 'HomeController@home');
$router->addRoute('/vendors', 'HomeController@vendors');
$router->addRoute('/dishes', 'HomeController@dishes');
$router->addRoute('/login', 'AuthController@login');
$router->addRoute('/register', 'AuthController@register');
$router->addRoute('/user/profile', 'UserController@profile');
$router->addRoute('/user/settings', 'UserController@settings');

// Business (Vendor) Routes
$router->addRoute('/business', 'HomeController@business');
$router->addRoute('/business/login', 'AuthController@login');
$router->addRoute('/business/register', 'AuthController@register');
$router->addRoute('/business/dashboard', 'VendorController@dashboard', true, 'vendor');
$router->addRoute('/business/dashboard/menu', 'VendorController@menu', true, 'vendor');
$router->addRoute('/business/dashboard/orders', 'VendorController@orders', true, 'vendor');
$router->addRoute('/business/dashboard/customers', 'VendorController@customers', true, 'vendor');

// Admin Routes - 
$router->addRoute('/admin', 'AdminController@login');
$router->addRoute('/admin/login', 'AuthController@login');
$router->addRoute('/admin/dashboard', 'AdminController@dashboard', true, 'admin');
$router->addRoute('/admin/dashboard/manage-users', 'AdminController@manageUsers', true, 'admin');

// Dispatch the Request to the appropriate controller and action
if (!$router->dispatch($currentPath, $isLoggedIn, $userRole)) {
  // If no route was found, show a 404 error page
  http_response_code(404);
  include ROOT_DIR . '/pages/errors/404.php'; // Custom 404 page
}
