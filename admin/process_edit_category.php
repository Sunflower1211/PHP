
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

$categoryId = $_POST["txtCatId"];
$categoryName = $_POST["txtCatName"];

try {

 $pdo = new PDO($dsn, $user, $pass, $options);

 // Chuẩn bị câu lệnh SQL để cập nhật tên thể loại
 $sql = "UPDATE theloai SET ten_tloai = :newName WHERE ma_tloai = :id";
 $stmt = $pdo->prepare($sql);

 // Gán giá trị cho tham số trong câu lệnh SQL
 $stmt->bindParam(':newName', $categoryName);
 $stmt->bindParam(':id', $categoryId);

 // Thực hiện câu lệnh UPDATE
 $stmt->execute();

 // Chuyển hướng sau khi cập nhật thành công
 header("Location: /btth01/admin/category.php");
 exit();





} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>