<?php
 session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\Register;
use App\Controllers\Login;
use App\Controllers\Home;
use App\Controllers\Search;
use App\Controllers\Dashboard;
use App\Controllers\UpdateOffers;
use App\Controllers\Condidat;
use App\Controllers\Logout;




$route = isset($_GET['route']) ? $_GET['route'] : 'Home';

                                                         
switch ($route) {
    case 'Home':
        $controller = new Home();
        $controller->index();
        break;
    case 'Dashboard':
        $controller = new Dashboard();
        $controller->dashboard();
        break;
    
    case 'Login':
        $controller = new Login();
        $controller->login();
        break;
    case 'Register':
        $controller = new Register();
        $controller->Register();
        break;
    case 'Search':
        $controller = new Search();
        $controller->search();
        break;
    case 'UpdateOffers':
        $controller = new UpdateOffers();
        $controller->updateOffers();
        break;
    case 'Condidat':
        $controller = new Condidat();
        $controller->condidat();
        break;
    case 'Logout':
        $controller = new Logout();
        $controller->logout();
            break;

    
   
    default:
        // Handle 404 or redirect to the default route
        header('HTTP/1.0 404 Not Found');
        exit('Page not found');
}


?>
</br>
</br>

