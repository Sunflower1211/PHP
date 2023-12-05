
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

$articleId = $_POST["txtArticleId"];
$title= $_POST["txtTitle"];
$songName = $_POST["txtSongName"];
$categoryId = $_POST["txtCategoryId"];
$summaryName = $_POST["txtSummaryName"];
$authorId = $_POST["txtAuthorId"];


try {

 $pdo = new PDO($dsn, $user, $pass, $options);

 // Chuẩn bị câu lệnh SQL để cập nhật tên thể loại
 $sql = "UPDATE baiviet SET 
 tieude = :title,
 ten_bhat = :songName,
 ma_tloai = :categoryId,
 tomtat = :summaryName,
 ma_tgia = :authorId
  WHERE ma_bviet = :id";
 $stmt = $pdo->prepare($sql);

 // Gán giá trị cho tham số trong câu lệnh SQL
 $stmt->bindParam(':id', $articleId);
 $stmt->bindParam(':title', $title);
 $stmt->bindParam(':songName', $songName);
 $stmt->bindParam(':categoryId', $categoryId);
 $stmt->bindParam(':summaryName', $summaryName);
 $stmt->bindParam(':authorId', $authorId);

 // Thực hiện câu lệnh UPDATE
 $stmt->execute();

 // Chuyển hướng sau khi cập nhật thành công
 header("Location: /btth01/admin/article.php");
 exit();


} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>