<?php

require_once dirname(__DIR__) . '/init.php';
require_once ROOT_DIR . '/app/Core/Router.php';

use App\Core\Router;
use function App\Config\getDatabaseConnection;

$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$conn = getDatabaseConnection();

$isLoggedIn = isset($_SESSION[SESSION_USER_ID]);
$userRole = $_SESSION[SESSION_USER_ROLE] ?? null;
$userId = $_SESSION[SESSION_USER_ID] ?? null;

$context = [
  'conn' => $conn,
  'isLoggedIn' => $isLoggedIn,
  'userId' => $userId,
  'userRole' => $userRole,
  'currentPath' => $currentPath,
];

$router = new Router();
require_once ROOT_DIR . '/routes/web.php';

if (!$router->dispatch($currentPath, $isLoggedIn, $userRole, $context)) {
  http_response_code(404);
  include ROOT_DIR . '/pages/errors/404.php';
}