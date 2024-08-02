<?php
// startar en session
session_start();
// inkluderar nödvändiga filer för databasanslutning och kontroller
require_once 'config/Database.php';
require_once 'controllers/UserController.php';
require_once 'controllers/FavoriteController.php';
require_once 'controllers/TMDbController.php';
require_once 'controllers/HomeController.php';

// inkluderar nödvändiga filer för modeller 
require_once 'models/User.php';
require_once 'models/Favorite.php';
require_once 'models/TMDbAPI.php';

// skapar en ny instans av Database och hämtar databasanslutningen
$database = new Database();
$db = $database->getConnection();

/* hämtar värdet av 'page' från URL:en, 
om den inte finns sätts den till 'home' */
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// switch-sats för att bestämma vilken sida som ska visas
switch ($page) {
    // om page är home
    case 'home': 
        $controller = new HomeController();
        $controller->index();
        break;
    // om page är register
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
    // om page är login
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    // om page är logout
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    // om page är favorites
    case 'favorites':
        $controller = new FavoriteController();
        $controller->index();
        break;
    // om page är addFavorite
    case 'addFavorite':
        $controller = new FavoriteController();
        $controller->addFavorite();
        break;
    // om page är removeFavorite
    case 'removeFavorite':
        $controller = new FavoriteController();
        $controller->removeFavorite();
        break;
    // om page är search
    case 'search':
        $controller = new TMDbController();
        $controller->search();
        break;
    // om inget av ovanstående stämmer är home standard
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
?>
