<?php
require_once 'config.php';

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct()
    {
        // Initialize database connection
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getAll()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query('SELECT * FROM users');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // public static function getById($id)
    // {
    //     $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     $query = $db->prepare('SELECT * FROM articles WHERE id = :id');
    //     $query->bindParam(':id',$id, PDO::PARAM_INT);
    //     $query->execute();

    //     return $query->fetch(PDO::FETCH_ASSOC);
    // }

    // public function setTitle($title)
    // {
    //     $this->title = $title;
    // }

    // public function setContent($content)
    // {
    //     $this->content = $content;
    // }

    // public function save()
    // {
    //     $query = $this->db->prepare('INSERT INTO articles (title, content) VALUES (:title, :content)');
    //     $query->bindParam(':title', $this->title, PDO::PARAM_STR);
    //     $query->bindParam(':content', $this->content, PDO::PARAM_STR);
    //     $query->execute();
    // }

    // public function update()
    // {
    //     $query = $this->db->prepare('UPDATE articles SET title = :title, content = :content WHERE id = :id');
    //     $query->bindParam(':id', $this->id, PDO::PARAM_INT);
    //     $query->bindParam(':title', $this->title, PDO::PARAM_STR);
    //     $query->bindParam(':content', $this->content, PDO::PARAM_STR);
    //     $query->execute();
    // }

    // public function delete()
    // {
    //     $query = $this->db->prepare('DELETE FROM articles WHERE id = :id');
    //     $query->bindParam(':id', $this->id, PDO::PARAM_INT);
    //     $query->execute();
    // }
}


?>
