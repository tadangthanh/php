<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới bài viết</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php
$pathCategoryDAO = __DIR__ . "\..\DAO\CategoryDAO.php";
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
include $pathNewsDAO;
include $pathCategoryDAO;
$newsDAO = new NewsDAO();
$categoryDAO = new CategoriesDAO();
$listCategory = $categoryDAO->getAll();
?>

<body>
    <div class="container">
        <form action="../xulyform/create-news.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Content:</label>
                <textarea name="content" id="content" style="height: 100px;"></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Thể loại</label>
                <select name="category" id="category">
                    <?php
                    foreach ($listCategory as $c) {
                        echo "<option value=" . $c->getId() . ">" . $c->getName() . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Thêm" name="add" class="btn btn-primary">
        </form>
    </div>
</body>

<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>

</html>