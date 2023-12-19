<?php
require_once 'models/Article.php';

class QuestionController
{
    // Display a list of articles
    public function index()
    {
        // Create an instance of the Article class
        $questionInstance = new Question();

        // Call the getAll method
        $questions = $questionInstance->getAll();
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

        $article = new Question();
        $article->setTitle($title);
        $article->setContent($content);
        $article->save();

        header('Location: index.php?controller=article&action=index');
    }

    // Display the article editing form
    public function edit()
    {
        $id = $_GET['id'];
        $article = Question::getById($id);
        require 'views/articles/edit.php';
    }

    // Update the specified article in the database
    public function update()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $article = Question::getById($id);
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
         $articleInstance = new Question();

         // Call the getAll method
         $articles = $articleInstance->delete($id);
        header('Location: index.php?controller=article&action=index');
    }
}

?>
