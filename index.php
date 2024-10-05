<?php

    session_start();

    spl_autoload_register(function ($className) {
        require_once 'Controller/' . $className . '.php';
    });

    $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($request) { 
        case '/Pixel-Casino/':
            $controller = new HomeController();
            $controller->index();
            break;
        case '/Pixel-Casino/index.php':
            $controller = new HomeController();
            $controller->index();
            break;
        case '/Pixel-Casino/Blackjack.php':
            $controller = new BlackJackController();
            $controller->index();
           break;
        case '/Pixel-Casino/AuthRegister.php':
            $controller = new AuthController();
            $controller->registration();
            break;
        case '/Pixel-Casino/AuthLogin.php':
            $controller = new AuthController();
            $controller->login();
            break;
        default:
            echo "A keresett oldal nem található!";
    }
?>