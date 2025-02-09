<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function addRoute($path, $controllerAction, $requiresAuth = false, $requiredRole = null)
    {
        $this->routes[] = [
            'path' => $path,
            'controllerAction' => $controllerAction,
            'requiresAuth' => $requiresAuth,
            'requiredRole' => $requiredRole,
        ];
    }

    public function dispatch($currentPath, $isLoggedIn, $userRole, $context)
    {
        foreach ($this->routes as $route) {
            if ($currentPath === $route['path']) {

                if ($route['requiresAuth'] && !$isLoggedIn) {
                    $this->redirectToLogin($currentPath);
                }

                if ($route['requiredRole'] && !in_array($userRole, (array) $route['requiredRole'])) {
                    http_response_code(403);
                    echo "Access Denied: You do not have permission to view this page.";
                    exit;
                }

                list($controllerName, $actionName) = explode('@', $route['controllerAction']);

                $controllerClass = "App\\Controllers\\$controllerName";
                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    if (method_exists($controllerInstance, $actionName)) {
                        $controllerInstance->$actionName($context);
                        return true;
                    } else {
                        http_response_code(404);
                        echo "Method $actionName not found in controller $controllerClass.";
                        exit;
                    }
                } else {
                    http_response_code(404);
                    echo "Controller $controllerClass not found.";
                    exit;
                }
            }
        }

        return false;
    }

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