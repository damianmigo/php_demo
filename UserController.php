<?php

    class UserController {
        
        public function login() {
            
            $model = array();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $author = Author::findByEmailAndPassword($_POST['email'], $_POST['password']);
                if ($author !== FALSE) {
                    $_SESSION['user'] = $author;
                    header('Location: /?controller=news&action=show');
                } else {
                    $model['invalid_credentials'] = TRUE;
                }
            }
            
            require_once('templates/User/login.php');
        }
        
        public function logout() {
            unset($_SESSION['user']);
            header('Location: /');
        }
        
    }