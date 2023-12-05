<?php
$host = '127.0.0.1';
$db = 'btth01_cse485';
$user = 'root';
$pass = '123';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false,
];

$id = $_GET['id'];
try {
 $pdo = new PDO($dsn, $user, $pass, $options);

 $sqlAuthor = "DELETE FROM tacgia WHERE ma_tgia = $id;";
 $stmtAuthor = $pdo->prepare($sqlAuthor);
 $stmtAuthor->execute();

 header("Location: /btth01/admin/category.php");
 exit();


} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>