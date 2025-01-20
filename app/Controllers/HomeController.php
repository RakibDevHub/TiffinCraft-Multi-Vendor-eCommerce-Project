<?php

namespace App\Controllers;

class HomeController
{
    public function home($context)
    {
        $title = "TiffinCraft";

        // Extract context data
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userId = $context['userId'] ?? null;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        include ROOT_DIR . '/pages/home.php';
    }

    public function business($context)
    {
        $title = "TiffinCraft Business";

        // Extract context data
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $userId = $context['userId'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        include ROOT_DIR . '/pages/home.php';
    }
}
