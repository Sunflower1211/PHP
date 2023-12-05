
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

$ArticleName = $_POST["txtArticleName"];
$SongName = $_POST["txtSongName"];
$CategoryName = $_POST["txtCategoryName"];
$SummaryName = $_POST["txtSummaryName"];
$AuthorName = $_POST["txtAuthorName"];


try {

 $pdo = new PDO($dsn, $user, $pass, $options);

 //b2 thuc hie ntruy van
 $sql = "SELECT COUNT(*) AS quantity FROM baiviet;";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 //b3 

 $result = $stmt->fetch();
 $quantity = $result['quantity']+1;

 // Thực hiện truy vấn INSERT INTO
 $insertSql = "INSERT INTO 
 baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia)
  VALUES 
  (:mabaiviet, :tieude, :tenBaihat, :maTheloai, :tomtat, :maTacgia)";
 $insertStmt = $pdo->prepare($insertSql);

 // Gán giá trị cho các tham số
 $insertStmt->bindParam(':mabaiviet', $quantity);
 $insertStmt->bindParam(':tieude', $ArticleName);
 $insertStmt->bindParam(':tenBaihat', $SongName);
 $insertStmt->bindParam(':maTheloai', $CategoryName);
 $insertStmt->bindParam(':tomtat', $SummaryName);
 $insertStmt->bindParam(':maTacgia', $AuthorName);

 // Thực hiện thêm dữ liệu
 $insertStmt->execute();

    header("Location: /btth01/admin/article.php");
    exit();




} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>