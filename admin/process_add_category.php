
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

$nameCategory = $_POST["txtCatName"];


try {
    if(!$nameCategory){
        header("Location: /btth01/admin/add_category.php");
        exit();
    }

 $pdo = new PDO($dsn, $user, $pass, $options);

 //b2 thuc hie ntruy van
 $sql = "SELECT COUNT(*) AS quantity FROM theloai;";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 //b3 

 $result = $stmt->fetch();
 $quantity = $result['quantity']+1;

 // Thực hiện truy vấn INSERT INTO
 $insertSql = "INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (:maTheLoai, :tenTheLoai)";
 $insertStmt = $pdo->prepare($insertSql);

 // Gán giá trị cho các tham số
 $insertStmt->bindParam(':maTheLoai', $quantity);
 $insertStmt->bindParam(':tenTheLoai', $nameCategory);

 // Thực hiện thêm dữ liệu
 $insertStmt->execute();



    header("Location: /btth01/admin/category.php");
    exit();




} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>