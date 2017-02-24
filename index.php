<?php

    session_start();

    ob_start();

    function __autoload($class_name) {
        require_once $class_name . '.php';
    }
   
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action = $_GET['action'];
    } else {
        $controller = 'Home';
        $action = 'index';
    }
    
    if (isset($_GET['layout'])) {
        $layout = $_GET['layout'];
    } else {
        $layout = '';
    }

    require_once('templates/layout' . $layout . '.php');
    