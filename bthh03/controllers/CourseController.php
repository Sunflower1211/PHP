<?php
require_once 'models/Article.php';

class CourseController
{
    // Display a list of articles
    public function index()
    {
        // Create an instance of the Article class
        $courseInstance = new Course();

        // Call the getAll method
        $courses = $articleInstance->getAll();
        // $articles = Article::getAll();
        require 'views/courses/index.php';
    }

    // Display the article creation form
    public function create()
    {
        require 'views/courses/create.php';
    }

    // Store a newly created article in the database
    public function store()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $article = new Course();
        $article->setTitle($title);
        $article->setContent($content);
        $article->save();

        header('Location: index.php?controller=course&action=index');
    }

    // Display the article editing form
    public function edit()
    {
        $id = $_GET['id'];
        $article = Course::getById($id);
        require 'views/courses/edit.php';
    }

    // Update the specified article in the database
    public function update()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $article = Course::getById($id);
        $article->setTitle($title);
        $article->setContent($content);
        $article->save();

        header('Location: index.php?controller=course&action=index');
    }

    // Delete the specified article from the database
    public function delete()
    {
        $id = $_GET['id'];
         // Create an instance of the Article class
         $articleInstance = new Course();

         // Call the getAll method
         $articles = $articleInstance->delete($id);
        header('Location: index.php?controller=course&action=index');
    }
}

?>
