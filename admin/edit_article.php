

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

$id = $_GET["id"];

try {
 $pdo = new PDO($dsn, $user, $pass, $options);

 //bài viết
 $sqlArticle = "
 SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.tomtat, baiviet.noidung,
       baiviet.ngayviet, baiviet.ma_tgia, baiviet.ma_tloai, tacgia.ten_tgia, theloai.ten_tloai
FROM baiviet
LEFT JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
LEFT JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE baiviet.ma_bviet = :id;
 ";
 $Article = $pdo->prepare($sqlArticle);
 $Article->bindParam(':id', $id);
 $Article->execute();

 $article = $Article->fetch();


//tác gải
 $sqlAuthor = "SELECT * FROM tacgia";
 $stmtAuthor = $pdo->prepare($sqlAuthor);
 $stmtAuthor->execute();

 $authors = $stmtAuthor->fetchAll();

//thể loại
  $sqlCategory = "SELECT * FROM theloai";
  $stmtCategory = $pdo->prepare($sqlCategory);
  $stmtCategory->execute();
 
  $categorys = $stmtCategory->fetchAll();


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin Bài hát</h3>
                <form action="process_edit_article.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã bài viết</span>
                        <input type="text" class="form-control" name="txtArticleId" readonly value="<?php echo $article['ma_bviet']; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTitle" value="<?php echo $article['tieude']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtSongName" value="<?php echo $article['ten_bhat']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                    <select id="lblCatName" name="txtCategoryId" class="form-control" required>
                    <option value="<?php echo $article['ma_tloai']; ?>" selected><?php echo $article['ten_tloai']; ?></option>
                        <?php foreach ($categorys as $category) { ?>
                            <option value="<?php echo $category['ma_tloai']; ?>"><?php echo $category['ten_tloai']; ?></option>
                        <?php } ?>
                    </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm tắt</span>
                        <textarea id="multilineInput" name="txtSummaryName" rows="4" cols="170"><?php echo $article['tomtat']; ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tác giả</span>
                        <select id="lblCatName" name="txtAuthorId" class="form-control" required>
                        <option value="<?php echo $article['ma_tgia']; ?>" selected><?php echo $article['ten_tgia']; ?></option>
                            <?php foreach ($authors as $author) { ?>
                                <option value="<?php echo $author['ma_tgia']; ?>"><?php echo $author['ten_tgia']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="author.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>