<?php

    class HomeController {
        
        public function index() {
            $model = array();
            $model['news'] = News::all();
            
            require_once('templates/Home/index.php');
        }
        
    }