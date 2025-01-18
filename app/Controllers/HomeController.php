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

        // Pass necessary variables to the view
        include ROOT_DIR . '/pages/home.php';
    }
    public function business($context)
    {
        $title = "TiffinCraft";

        // Extract context data
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $userId = $context['userId'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        // Pass necessary variables to the view
        include ROOT_DIR . '/pages/tiffincraftBusiness.php';
    }

    /**
     * Fetch user data from the database (Example function).
     */
    // private function getUserData($userId)
    // {
    //     // Example database fetch logic (replace with your database connection logic)
    //     $db = new \App\Core\Database(); // Assuming you have a Database class
    //     $query = "SELECT * FROM users WHERE id = ?";
    //     $userData = $db->fetchOne($query, [$userId]);

    //     return $userData;
    // }
}
