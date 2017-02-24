<?php

    class Author {
        
        public $id;
        
        public $nickname;
        
        public $email;
        
        public $password;
        
        public $role;
        
        public function __construct($id, $nickname, $email, $password, $role) {
            $this->id = $id;
            $this->nickname = $nickname;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }
        
        public static function findByEmailAndPassword($email, $password) {
            $conn = Database::getInstance();
            $resource = $conn->prepare('SELECT * FROM authors WHERE email = :email AND password = :password');
            $resource->execute(array('email' => $email, 'password' => md5($password)));
            $author = $resource->fetch();
            if ($author !== FALSE) {
                return new Author($author['id'],
                    $author['nickname'],
                    $author['email'],
                    $author['password'],
                    $author['role']);
            }
            
            return FALSE;
        }
        
        public static function findById($id) {
            $conn = Database::getInstance();
            $resource = $conn->prepare('SELECT * FROM authors WHERE id = :id');
            $resource->execute(array('id' => $id));
            $author = $resource->fetch();
            if ($author !== FALSE) {
                return new Author($author['id'],
                    $author['nickname'],
                    $author['email'],
                    $author['password'],
                    $author['role']);
            }
            return FALSE;
        } 
    
    }