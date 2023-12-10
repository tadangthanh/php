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
        $sqlQuery = "select u.id as uid, u.username,u.email,r.id as rid,u.created_at from users as u inner join roles as r on r.id=u.role_id where username = '" . $username . "' and password = '" . $password . "' and status = 1";
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
                $user->setRoleId($row['role_id']);
                $user->setStatus($row['status']);
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

    public function updateEmailPasswordByUsername($username,$email,$password){
        $conn = Connect::getConnection();
        $sqlQuery="";
        if($email === null || empty($email)){
            $sqlQuery = "update users set password='$password' where username='$username' ";
        }
        if($password===null ||empty($password)){
            $sqlQuery = "update users set email ='$email' where username='$username' ";
        }
        if($password !==null && !empty($password) && $email !==null && !empty($email)){
            $sqlQuery = "update users set email ='$email', password='$password' where username='$username'";
        }
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }
    public function getAll(){
        $conn = Connect::getConnection();
        $users = [];
        $sqlQuery = "SELECT u.id AS uid, u.username, u.email,u.status,u.password, r.id AS rid, u.created_at 
                     FROM users AS u 
                     INNER JOIN roles AS r ON r.id=u.role_id";
        $result = mysqli_query($conn, $sqlQuery);
    
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = new User();
                $user->setId($row['uid']);
                $user->setUsername($row['username']);
                $user->setEmail($row['email']);
                $user->setStatus($row['status']);
                $user->setRoleId($row['rid']);
                $user->setCreatedAt($row['created_at']);
                $users[] = $user;
            }
        }
        return $users;
    }
    public function updateUserById($id,$email,$roleId,$status){
        $conn = Connect::getConnection();
        $sqlQuery = "update users set email ='$email', role_id=$roleId,status=$status where id=$id";
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }
}
