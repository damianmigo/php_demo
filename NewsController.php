<?php

    class NewsController {
        
        public function show() {
            if (!isset($_SESSION['user'])) {
                header('Location: /');
            }
            require_once('templates/News/show.php');
        }
        
        public function listAjax() {
            if (!isset($_SESSION['user'])) {
                header('Location: /');
            }
            
            $model = array();
            
            $author = $_SESSION['user'];
            
            if ($author->role == 'ADMIN') {
                $news = News::all($_GET['order_by']);
            } else {
                $news = News::findByAuthorId($author->id);
            }
            
            $model['news'] = $news;
            
            require_once('templates/News/listAjax.php');
        }
        
        public function create() {
            if (!isset($_SESSION['user'])) {
                header('Location: /');
            }
            
            $model = array();
            
            $author = $_SESSION['user'];
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $newsFromRequest = $_POST['news'];
                $errors = $this->validateNews($newsFromRequest);
                $news = new News(null,
                    $author->id,
                    $newsFromRequest['title'],
                    $newsFromRequest['description'],
                    null
                );
                if (empty($errors)) {
                    $news->save();
                    $model['news'] = $news;
                    header('Location: /?controller=news&action=edit&id=' . $news->id);
                } else {
                    $model['errors'] = $errors;
                }
            } else {
                $news = new News(null, // id
                    $author->id,
                    '', // title
                    '', // description
                    null // createdAt
                );
            }
            
            $model['news'] = $news;
            
            require_once('templates/News/create.php');
        }
        
        public function edit() {
            if (!isset($_SESSION['user'])) {
                header('Location: /');
            }
            
            $model = array();
            
            $news = News::findById($_GET['id']);
            
            $author = $_SESSION['user'];
            
            if ($news->author_id != $author->id && $author->role != 'ADMIN') {
                $model['errors'] = array(
                    'global' => "You aren't allowed to edit these news."
                );
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $newsFromRequest = $_POST['news'];
                    $errors = $this->validateNews($newsFromRequest);
                    if (empty($errors)) {
                        $news->title = $newsFromRequest['title'];
                        $news->description = $newsFromRequest['description'];
                        $news->save();
                        header('Location: /?controller=news&action=edit&id=' . $news->id);
                    } else {
                        $model['errors'] = $errors;
                    }
                }
            }
            
            $model['news'] = $news;
            
            require_once('templates/News/edit.php');
        }
        
        private function validateNews($newsForm) {
            $errors = array();
            
            if (empty($newsForm['title'])) {
                $errors['title'] = 'Enter a title.';
            } else if (strlen($newsForm['title']) > 255) {
                $errors['title'] = 'Title cannot be greater than 255 characters.';
            }
            
            if (empty($newsForm['description'])) {
                $errors['description'] = 'Enter a description.';
            } else if (strlen($newsForm['description']) > 65536) {
                $errors['description'] = 'Description cannot be greater than 65536 characters.';
            }
            
            return $errors;
        }
        
        public function deleteAjax() {
            if (!isset($_SESSION['user'])) {
                header('Location: /');
            }
            
            $model = array();
            
            $news = News::findById($_GET['id']);
            
            $author = $_SESSION['user'];
            
            if ($news->author_id != $author->id && $author->role != 'ADMIN') {
                $model['errors'] = array(
                    'global' => "You aren't allowed to delete these news."
                );
            } else {
                $news->delete();
            }
            
            echo json_encode($model);
        }
        
    }