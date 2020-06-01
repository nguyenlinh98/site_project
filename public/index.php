<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';

//require_once '../bootstrap/app.php';


//$app = new App();

use App\Controllers\LoginController;
use Framework\Database\Connection;
use Framework\Components\Request;


    session_start();


    isset($_SESSION['login']) ? index() : login();

    function login()
    {
        $controller = new LoginController();
        $controller->login();
    }

    function index()
    {
        try {
            $request = new Request();
            $controllerName = $request->getController();
            $action = $request->getAction();
            $className = '';
            $file_controller = '';

            if ($controllerName != "") {
                $className = "\\App\\Controllers\\{$controllerName}Controller";
                $file_controller = "../src/Controllers/$controllerName" . "Controller.php";
            }

            if (file_exists($file_controller)) {
                $controler = new $className();
                $controler->$action();
            }

//            include "../src/Views/Home.php";
        } catch (\Exception $e)
        {
            die ( $e->getMessage() );
        }


    }