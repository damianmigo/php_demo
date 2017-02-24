<?php

    class News {
        
        public $id;
        
        public $author_id;
        
        public $title;
        
        public $description;
        
        public $createdAt;
        
        public function __construct($id, $author_id, $title, $description, $createdAt) {
            $this->id = $id;
            $this->author_id = $author_id;
            $this->title = $title;
            $this->description = $description;
            $this->createdAt = $createdAt;
        }
        
        public function save() {
            $conn = Database::getInstance();
            if ($this->id == NULL) {
                $resource = $conn->prepare('INSERT INTO news (author_id, title, description, created_at) 
                    VALUES (:author_id, :title, :description, NOW())');
                $resource->execute(array('author_id'   => $this->author_id,
                                         'title'       => $this->title,
                                         'description' => $this->description));
                $this->id = $conn->lastInsertId(); 
            } else {
                $resource = $conn->prepare('UPDATE news SET title = :title, description = :description
                    WHERE id = :id');
                $resource->execute(array('title'       => $this->title,
                                         'description' => $this->description,
                                         'id'          => $this->id));
            }
        }
        
        public function delete() {
            $conn = Database::getInstance();
            $resource = $conn->prepare('DELETE FROM news WHERE id = :id');
            $resource->execute(array('id' => $this->id));
        }
        
        public static function all($orderBy = 'created_at') {
            $list = [];
            $conn = Database::getInstance();
            $resource = $conn->query('SELECT news.* FROM news LEFT JOIN authors ON news.author_id = authors.id ORDER BY ' . $orderBy);
            
            foreach($resource->fetchAll() as $news) {
                $list[] = new News($news['id'],
                    $news['author_id'],
                    $news['title'],
                    $news['description'],
                    $news['created_at']);
            }
            
            return $list;
        }
        
        public static function findById($id) {
            $conn = Database::getInstance();
            $resource = $conn->prepare('SELECT * FROM news WHERE id = :id');
            $resource->execute(array('id' => $id));
            $news = $resource->fetch();
            if ($news !== FALSE) {
                return new News($news['id'],
                    $news['author_id'],
                    $news['title'],
                    $news['description'],
                    $news['created_at']);
            }
            
            return FALSE;
        }
        
        public static function findByAuthorId($author_id, $orderBy = 'created_at') {
            $list = [];
            $conn = Database::getInstance();
            $resource = $conn->prepare('SELECT news.* FROM news LEFT JOIN authors ON news.author_id = authors.id WHERE author_id = :author_id ORDER BY ' . $orderBy);
            $resource->execute(array('author_id' => $author_id));
            
            foreach($resource->fetchAll() as $news) {
                $list[] = new News($news['id'],
                    $news['author_id'],
                    $news['title'],
                    $news['description'],
                    $news['created_at']);
                
            }
            
            return $list;
        }
        
        public function getAuthor() {
            if ($this->author_id != NULL) {
                $author = Author::findById($this->author_id);
                if ($author !== FALSE) {
                    return $author;
                }
            }
            return NULL;
        }
    
    }