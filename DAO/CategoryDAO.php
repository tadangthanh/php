<?php
$pathConnection = __DIR__ . "\..\Util\Connection.php";
$pathCategoriesModel = __DIR__ . "\..\model\Categories.php";
include_once $pathConnection;
include_once $pathCategoriesModel;
class CategoriesDAO
{
    public function getAll()
    {
        $categories = array();
        $conn = Connect::getConnection();
        $sqlQuery = "select * from categories";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $category = new Categories();
                $category->setId($row["id"]);
                $category->setName($row['name']);
                array_push($categories, $category);
            }
        }
        return $categories;
    }
}
