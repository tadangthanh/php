<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
</head>
<?php
   include '../public.php';
   if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  if($_SESSION['role']!="ADMIN"&&$_SESSION['role']!="USER"){
      header("Location: login.php?err=vui lòng đăng nhập!");
  }
  $pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
  $pathCategoryDAO = __DIR__ . "\..\DAO\CategoryDAO.php";
  $pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
  include $pathUserDAO;
  include $pathCategoryDAO;
  include $pathNewsDAO;
$categoryDAO = new CategoriesDAO();
$listCategory = $categoryDAO->getAll();
$userDAO = new UserDAO();
$dao = new NewsDAO();
// tổng số item
$totalItem = $dao->count();
// tổng số trang
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
$sumOfPage = round($totalItem / $limit) + 1;
$numPage = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
$offset = ($numPage - 1) * $limit;
$searchValue = '';
if (isset($_REQUEST['search'])) {
    $searchValue = $_REQUEST['search'];
}
$newsList = $dao->paging($limit, $offset, $searchValue);
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
<style>

.card-text{
    display: block;
  	display: -webkit-box;
  	height: 16px*1.3*3;
  	font-size: 16px;
  	line-height: 1.3;
  	-webkit-line-clamp: 3;  /* số dòng hiển thị */
  	-webkit-box-orient: vertical;
  	overflow: hidden;
  	text-overflow: ellipsis;
  	margin-top:10px;
}
.input-group{

    border:1px solid black;

}
</style>
<body>
<div class="container"> 
<form action="" method="get">
                            <div class="input-group">
                                <input type="text" value="<?php echo $searchValue; ?>" class="form-control bg-light border-0 small" id="search" name="search" placeholder="Search for...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn-search" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

<?php
    foreach ($newsList as $n) {
        echo '
        <div class="row">
        <div class="mt-1 mb-1">
            <div class="card">
                <div class="card-header d-flex  justify-content-between" >
                    <h5 class="card-title">'.$n->getTitle().'</h5>
                </div>
                <div class="card-body content" >
                    <div class="card-text">'.$n->getContent().'</div>
                </div>
                <div class="card-footer text-muted text-end d-flex" style="justify-content: space-between;">
                <span>
                    <a href="news-detail.php?id='.$n->getId().'">xem chi tiết</a>
                </span>
                    <span class="text-sm">
                        <strong>Ngày đăng:</strong> '.$n->getPublishDate().'&nbsp;&nbsp;&nbsp;
                        <strong>Thể loại:</strong> '. getCategoryNameById($n->getCategoryId(), $listCategory) .'&nbsp;&nbsp;&nbsp;
                        <strong>Người đăng:</strong> '. $userDAO->getById($n->getUserId())->getUsername() .'
                    </span>
                </div>
            </div>
        </div>
        </div>
        ';
    }

?>

    <select id="offset" name="offset">
                        <?php
                        for ($i = 1; $i <= $sumOfPage; $i++) {
                            if ($numPage == $i) {
                                echo "<option selected value=\"home-news.php?offset=" . $i . "\">Trang " . $i . "</option>";
                            } else {
                                echo "<option value=\"home-news.php?offset=" . $i    . "\">Trang " . $i . "</option>";
                            }
                        }
                        ?>
                    </select>
                    Số bản ghi:
                    <select class="ml-2" id="limit" name="limit">
                        <option <?php if ($limit == 2) {
                                    echo "selected";
                                } ?> value="2">2</option>
                        <option <?php if ($limit == 5) {
                                    echo "selected";
                                } ?> value="5">5</option>
                        <option <?php if ($limit == 10) {
                                    echo "selected";
                                } ?> value="10">10</option>
                        <option <?php if ($limit == 15) {
                                    echo "selected";
                                } ?> value="15">15</option>
                        <option <?php if ($limit == 20) {
                                    echo "selected";
                                } ?> value="20">20</option>
                    </select>
    </div>
<!-- Link đến Bootstrap JS (đặt trước đóng thẻ body) -->


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  
        document.getElementById("offset").addEventListener("change", function() {
            var limit = document.getElementById('limit').value;
            let searchValue = document.getElementById('search').value;
            var selectedValue = this.value += "&limit=" + limit + "&search=" + searchValue;
            if (selectedValue !== "") {
                window.location.href = selectedValue;
            }
        });

        document.getElementById("limit").addEventListener("change", function() {
            var limit = document.getElementById('offset').value;
            let searchValue = document.getElementById('search').value;
            var selectedValue = "home-news.php?offset=1&search="+searchValue+ "&limit=" + this.value;
            if (selectedValue !== "") {
                window.location.href = selectedValue;
            }
        });
        document.querySelector('#btn-search').addEventListener('click', () => {
            let searchValue = document.getElementById('search').value;
            window.location.href = "home-news.php?offset=1&limit=2&search=" + searchValue;
        });
    </script>
</html>