<?php
require_once 'models/Article.php';

class OptionController
{
    // Display a list of articles
    public function index()
    {
        // Create an instance of the Article class
        $optionInstance = new Option();

        // Call the getAll method
        $options = $optionInstance->getAll();
        // $articles = Article::getAll();
        require 'views/articles/index.php';
    }

    // Display the article creation form
    public function create()
    {
        require 'views/articles/create.php';
    }

    // Store a newly created article in the database
    public function store()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $article = new Option();
        $article->setTitle($title);
        $article->setContent($content);
        $article->save();

        header('Location: index.php?controller=article&action=index');
    }

    // Display the article editing form
    public function edit()
    {
        $id = $_GET['id'];
        $article = Option::getById($id);
        require 'views/articles/edit.php';
    }

    // Update the specified article in the database
    public function update()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $article = Option::getById($id);
        $article->setTitle($title);
        $article->setContent($content);
        $article->save();

        header('Location: index.php?controller=article&action=index');
    }

    // Delete the specified article from the database
    public function delete()
    {
        $id = $_GET['id'];
         // Create an instance of the Article class
         $articleInstance = new Option();

         // Call the getAll method
         $articles = $articleInstance->delete($id);
        header('Location: index.php?controller=article&action=index');
    }
}

?>
