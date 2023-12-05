
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

$user_name = $_POST["user_name"];

$user_password = $_POST["user_password"];


try {

    echo $user_name;
    echo $user_password;
 $pdo = new PDO($dsn, $user, $pass, $options);

 //b2 thuc hie ntruy van
 $sql = "
    SELECT * FROM users
    WHERE user_name = '$user_name' AND user_password = '$user_password';
 ";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 //b3 

 $user = $stmt->fetchAll();



 if($user){
    header("Location: /btth01/admin/index.php");
    exit();
 }else{
    header("Location: /btth01/login.php");
    exit();
 }


} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>