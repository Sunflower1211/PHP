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

 //b2 thuc hie ntruy van
 $sql = "
 SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.tomtat, baiviet.noidung,
       baiviet.ngayviet, baiviet.hinhanh, tacgia.ten_tgia, theloai.ten_tloai
FROM baiviet
LEFT JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
LEFT JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE baiviet.ma_bviet = $id;
 ";

 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 //b3 

 $detail = $stmt->fetchAll();


} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo2.png" alt="" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./login.php">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Nội dung cần tìm" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
       
                <div class="row mb-5">
                    <div class="col-sm-4">
                        <img src="images/songs/<?php echo $detail[0]['hinhanh']; ?>.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="col-sm-8">
                    <?php foreach ($detail as $detail) { ?>
                        <h5 class="card-title mb-2">
                            <a href="" class="text-decoration-none"></span><?php echo $detail['ten_bhat']; ?></a>
                        </h5>
                        <p class="card-text"><span class=" fw-bold">Bài hát: </span><?php echo $detail['ten_bhat']; ?></p>
                        <p class="card-text"><span class=" fw-bold">Thể loại: </span><?php echo $detail['ten_tloai']; ?></p>
                        <p class="card-text"><span class=" fw-bold">Tóm tắt: </span><?php echo $detail['tomtat']; ?></p>
                        <p class="card-text"><span class=" fw-bold">Nội dung: </span><?php echo $detail['tomtat']; ?></p>
                        <p class="card-text"><span class=" fw-bold">Tác giả: </span><?php echo $detail['ten_tgia']; ?></p>
                        <?php } ?>
                    </div>          
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>