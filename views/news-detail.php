<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Thông Tin Bài Viết</title>
  <!-- Link đến Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
  include '../public.php';
  if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }
 if($_SESSION['role']!="ADMIN" &&$_SESSION['role']!="MANAGER"&&$_SESSION['role']!="USER"){
     header("Location: login.php?err=vui lòng đăng nhập!");
 }
 $pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
 $pathCategoryDAO = __DIR__ . "\..\DAO\CategoryDAO.php";
 $pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
 $pathCommentDAO = __DIR__ . "\..\DAO\CommentDAO.php";
 include $pathUserDAO;
 include $pathCategoryDAO;
 include $pathNewsDAO;
 include $pathCommentDAO;
 $categoryDAO = new CategoriesDAO();
 $listCategory = $categoryDAO->getAll();
 $commentDAO = new CommentDAO();
 $listComment = $commentDAO->loadCommentByNewsId($_GET['id']);
 $userDAO = new UserDAO();
 $newsDao = new NewsDAO();
 $news= $newsDao->getById($_GET['id']);
 function getNameUserByComment($comment,$userDAO){
    $user = $userDAO->getById($comment->getUserId());
    return $user->getUsername();
 }
 function getCategoryNameById($id, $listCategory)
{
    foreach ($listCategory as $c) {
        if ($c->getId() == $id) {
            return $c->getName();
        }
    }
    return "";
}
?>
<body>

<!-- Nội dung chính -->
  <div class="row">
    <div class="col-md-8 offset-md-2">

      <!-- Thông tin bài viết -->
      <div class="card">
        <div class="card-header">
          <h1 class="card-title"><?php echo $news->getTitle(); ?></h1>
        </div>
        <div class="card-body">
          <p class="card-text"><?php echo $news->getContent(); ?></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Người đăng:</strong> <?php echo $userDAO->getById($news->getUserId())->getUsername(); ?></li>
          <li class="list-group-item"><strong>Ngày đăng:</strong> <?php echo $news->getPublishDate(); ?></li>
          <li class="list-group-item"><strong>Thể loại: </strong><?php echo  getCategoryNameById($news->getCategoryId(), $listCategory); ?></li>
        </ul>
        
      </div>
      <div class="mt-4">
          <h5>Comment:</h5>
         <?php
            foreach ($listComment as $c) {
                $nameUser= getNameUserByComment($c,$userDAO);
                echo '
                <div class="media mt-4">
                <div class="media-body">
                <h5 class="mt-0">'.$nameUser.': </h5>
                <small class="text-muted">Date: '.$c->getCommentDate().'</small>
                <p style="  letter-spacing: 1.5px;">'.$c->getContent().'</p>
                </div>
                </div>
                <hr>
                ';
            }

            ?>



        </div>
    </div>
   
  </div>
        <div class="container">
          <form action="../xulyform/up-comment.php" method="post">
            <input type="text" name="userId" hidden value="<?php echo $_SESSION['id']; ?>">
            <input type="text" name="newsId" hidden value="<?php echo $_GET['id']; ?>">
            <!-- Ô nhập comment -->
          <div class="form-group">
            <label for="comment">Bình luận:</label>
            <textarea class="form-control" id="comment" name="content" rows="3"></textarea>
          </div>
          <!-- Nút gửi comment -->
          <button type="submit" class="btn btn-primary" value="postcomment" name="postcomment">Gửi Bình Luận</button>
          </form>
        </div>

</body>
<!-- Link đến Bootstrap JS và Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>