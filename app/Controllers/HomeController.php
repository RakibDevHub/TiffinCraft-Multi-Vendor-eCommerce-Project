<?php

namespace App\Controllers;
use App\Controllers\VendorController;

class HomeController
{
    private $vendorController;

    public function __construct()
    {
        $this->vendorController = new VendorController();
    }

    public function home($context)
    {
        $title = "TiffinCraft";

        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userId = $context['userId'] ?? null;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        $limit = 20;

        $popularVendors = $this->vendorController->getPopularVendors($limit);
        if ($popularVendors === false) {
            error_log("Error listing vendors in getVendorsPopular.");
            $error = "There was an error listing the  popular vendors.";
        } elseif (is_array($popularVendors) && count($popularVendors) === 0) {
            $message = "No data found.";
        }

        $newVendors = $this->vendorController->getNewArrivalVendors($limit, null);
        if ($newVendors === false) {
            error_log("Error listing vendors in getNewArrivalVendors.");
            $error = "There was an error listing the  new arrival vendors.";
        } elseif (is_array($newVendors) && count($newVendors) === 0) {
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