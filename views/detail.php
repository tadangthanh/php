<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
</head>
<?php
$pathCategoryDAO = __DIR__ . "\..\DAO\CategoryDAO.php";
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
$pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
include $pathNewsDAO;
include $pathCategoryDAO;
include $pathUserDAO;
$userDAO = new UserDAO();
$newsDAO = new NewsDAO();
$categoryDAO = new CategoriesDAO();
$id = $_REQUEST['id'];
$news = $newsDAO->getById($id);
$listCategory = $categoryDAO->getAll();
?>

<body>
    <div class="container">
        <form action="../xulyform/update-news.php" method="post">
            <input type="hidden" value="<?php echo $news->getId() ?>" name="id">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $news->getTitle(); ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Content:</label>
                <textarea name="content" id="content" style="height: 100px;"><?php echo $news->getContent(); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Thể loại</label>
                <select name="category" id="category">
                    <?php
                    foreach ($listCategory as $c) {
                        if ($news->getCategoryId() == $c->getId()) {
                            echo "<option value=" . $c->getId() . " selected >" . $c->getName() . "</option>";
                        } else {
                            echo "<option value=" . $c->getId() . ">" . $c->getName() . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ngày đăng:</label>
                <input type="datetime" name="publish_date" id="publish_date" value="<?php echo $news->getPublishDate(); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Người tạo:</label>
                <input type="text" name="user_id" value="<?php echo $userDAO->getById($news->getUserId())->getUsername(); ?>" readonly>
            </div>
            <input type="submit" value="cập nhật" name="update">
            <button><a href="../xulyform/delete-news.php?id=<?php echo $news->getId(); ?>">Xóa</a></button>
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