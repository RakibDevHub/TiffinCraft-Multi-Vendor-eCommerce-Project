<?php

namespace App\Controllers;

class HomeController
{
    public function home($context)
    {
        $title = "TiffinCraft";

        // Extract context data
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $userId = $context['userId'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        // If you want to perform additional logic based on the user's login status
        // if ($isLoggedIn) {
        //     // Fetch user-specific data if needed (example: user profile or preferences)
        //     $userData = $this->getUserData($userId); // Create this method to fetch user data
        // } else {
        //     $userData = null; // No user data for non-logged-in users
        // }

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

        // If you want to perform additional logic based on the user's login status
        // if ($isLoggedIn) {
        //     // Fetch user-specific data if needed (example: user profile or preferences)
        //     $userData = $this->getUserData($userId); // Create this method to fetch user data
        // } else {
        //     $userData = null; // No user data for non-logged-in users
        // }

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
