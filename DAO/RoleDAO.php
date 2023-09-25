<?php
$pathConnection = __DIR__ . "\..\Util\Connection.php";
$pathRoleModel = __DIR__ . "\..\model\Role.php";
include_once $pathConnection;
include_once $pathRoleModel;
class RoleDAO
{
    public function getAll()
    {
        $roles = array();
        $conn = Connect::getConnection();
        $sqlQuery = "select * from roles";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $role = new Role();
                $role->setId($row['id']);
                $role->setName($row['name']);
                array_push($roles, $role);
            }
        }
        return $roles;
    }
}
