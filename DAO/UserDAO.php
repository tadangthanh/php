<?php
$pathConnection = __DIR__ . "\..\Util\Connection.php";
$pathUserModel = __DIR__ . "\..\model\User.php";
include_once $pathConnection;
include_once $pathUserModel;
class UserDAO
{
    public function getByUsernameAndPassword($username, $password)
    {
        $conn = Connect::getConnection();
        $user = new User();
        $sqlQuery = "select u.id as uid, u.username,u.email,r.id as rid,u.created_at from users as u inner join roles as r on r.id=u.role_id where username = '" . $username . "' and password = '" . $password . "'";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            if ($row = mysqli_fetch_array($result)) {
                $user->setId($row['uid']);
                $user->setUsername($row['username']);
                $user->setEmail($row['email']);
                $user->setRoleId($row['rid']);
                $user->setCreatedAt($row['created_at']);
            }
        }
        return $user;
    }
    public function count()
    {
        $conn = Connect::getConnection();
        $sqlQuery = "select count(*) from users";
        $result = mysqli_query($conn, $sqlQuery);
        return mysqli_fetch_array($result)[0];
    }
    public function getById($id)
    {
        $conn = Connect::getConnection();
        $user = new User();
        $sqlQuery = "select * from users where id= '$id'";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            if ($row = mysqli_fetch_array($result)) {
                $user->setId($row['id']);
                $user->setUsername($row['username']);
                $user->setEmail($row['email']);
            }
        }
        return $user;
    }
    public function getByUsername($username)
    {
        $conn = Connect::getConnection();
        $user = new User();
        $sqlQuery = "select u.id as uid, u.username,u.email,r.id as rid,u.created_at from users as u inner join roles as r on r.id=u.role_id where username = '" . $username . "'";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            if ($row = mysqli_fetch_array($result)) {
                $user->setId($row['uid']);
                $user->setUsername($row['username']);
                $user->setEmail($row['email']);
                $user->setRoleId($row['rid']);
                $user->setCreatedAt($row['created_at']);
            }
        }
        return $user;
    }
    public function save(User $user)
    {
        $conn = Connect::getConnection();
        $sqlQuery = "insert into users (created_at, email, password, role_id, username) VALUES ('" . date("Y-m-d") . "','" . $user->getEmail() . "','" . $user->getPassword() . "',1,'" . $user->getUsername() . "')";
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }
}
