<?php
    
    // Require Main CLass 
    require_once "./config/config.php";

    // Load All Class In System Libs ...
    spl_autoload_register(function($class) {
        require_once "./system/libs/${class}.php";
    });


    require_once "./middleware/PHPMailer.php";
    require_once "./middleware/Smtp.php";
    require_once "./validation/validation.php";
    require_once "./middleware/middleware.php";

    $main = new Main();

    die("");
    
