<?php

namespace App\Core;

class Router
{
    private $routes = [];

    // Add a route with an optional role parameter
    public function addRoute($path, $controllerAction, $requiresAuth = false, $requiredRole = null)
    {
        $this->routes[] = [
            'path' => $path,
            'controllerAction' => $controllerAction,
            'requiresAuth' => $requiresAuth,
            'requiredRole' => $requiredRole,
        ];
    }

    // Dispatch the route
    public function dispatch($currentPath, $isLoggedIn, $userRole)
    {
        foreach ($this->routes as $route) {
            // If the current path matches the route path
            if ($currentPath === $route['path']) {

                // Check if the route requires authentication
                if ($route['requiresAuth'] && !$isLoggedIn) {
                    $this->redirectToLogin($currentPath); // Handle login redirection
                }

                // If the route requires a specific role
                if ($route['requiredRole'] && !in_array($userRole, (array) $route['requiredRole'])) {
                    http_response_code(403);
                    echo "Access Denied: You do not have permission to view this page.";
                    exit;
                }

                // Extract controller and action
                list($controllerName, $actionName) = explode('@', $route['controllerAction']);

                // Dynamically call the controller's action
                $controllerClass = "App\\Controllers\\$controllerName";
                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    if (method_exists($controllerInstance, $actionName)) {
                        $context = [
                            'isLoggedIn' => $isLoggedIn,  // True/false, indicates if the user is logged in
                            'userId' => $_SESSION['user_id'] ?? null, // User ID from session
                            'userRole' => $_SESSION['user_role'] ?? null,      // Role of the user (e.g., 'customer', 'vendor', 'admin')
                            'currentPath' => $currentPath // The current route path
                        ];
                        $controllerInstance->$actionName($context);
                        return true;
                    } else {
                        // Handle method not found error
                        http_response_code(404);
                        echo "Method $actionName not found in controller $controllerClass.";
                        exit;
                    }
                } else {
                    // Handle controller not found error
                    http_response_code(404);
                    echo "Controller $controllerClass not found.";
                    exit;
                }
                // }


            }
        }

        // If no route matched, return false
        return false;
    }

    // Redirection to login based on user role
    private function redirectToLogin($currentPath)
    {
        if (strpos($currentPath, '/admin') !== false) {
            header('Location: /admin/login');
        } elseif (strpos($currentPath, '/business') !== false) {
            header('Location: /business/login');
        } else {
            header('Location: /login');
        }
        exit;
    }
}