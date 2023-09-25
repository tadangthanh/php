<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<?php
include_once('./DAO/NewsDAO.php');
// $newsDao = new NewsDAO();
// $id = $_REQUEST['id'];
// $news = $newsDao->getById($id);
?>

<body>
    <div class="container">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Content:</label>
                <textarea name="content" id="" cols="150" rows="4"></textarea>
            </div>
            <div class="mb-3 form-check">
                <label for="category" class="form-label">Category</label>
                <select name="categories" id="category">
                    <option value=""></option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>