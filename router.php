<?php
    function call($controller, $action) {
        $controllerClassName = ucwords($controller . 'Controller');
        $controller = new $controllerClassName;
        $controller->{ $action }();
    }

    call($controller, $action);
?>