
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

$authorId = $_POST["txtAuthorId"];
$authorName = $_POST["txtAuthorName"];

try {

 $pdo = new PDO($dsn, $user, $pass, $options);

 // Chuẩn bị câu lệnh SQL để cập nhật tên thể loại
 $sql = "UPDATE tacgia SET ten_tgia = :newName WHERE ma_tgia = :id";
 $stmt = $pdo->prepare($sql);

 // Gán giá trị cho tham số trong câu lệnh SQL
 $stmt->bindParam(':newName', $authorName);
 $stmt->bindParam(':id', $authorId);

 // Thực hiện câu lệnh UPDATE
 $stmt->execute();

 // Chuyển hướng sau khi cập nhật thành công
 header("Location: /btth01/admin/author.php");
 exit();





} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>