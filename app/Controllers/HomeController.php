<?php

namespace App\Controllers;
use App\Controllers\VendorController;

class HomeController
{
    public function home($context)
    {
        $title = "TiffinCraft";

        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userId = $context['userId'] ?? null;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        $limit = 10;

        $vendorController = new VendorController();
        $vendors = $vendorController->getVendorsPopular($limit);
        if ($vendors === false) {
            error_log("Error listing vendors in getVendorsPopular.");
            $error = "There was an error listing the  popular vendors.";
        } elseif (is_array($vendors) && count($vendors) === 0) {
            $message = "No data found.";
        }
        include ROOT_DIR . '/pages/home.php';
        return;
    }

    public function business($context)
    {
        $title = "TiffinCraft Business";

        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $userId = $context['userId'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        include ROOT_DIR . '/pages/home.php';
        return;
    }

}