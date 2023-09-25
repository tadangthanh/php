<?php
class Connect
{
    private static $conn;
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $database = "mywebsite";

    public static function getConnection()
    {
        if (self::$conn === null || !self::$conn->ping()) {
            self::$conn = mysqli_connect(self::$host, self::$username, self::$password, self::$database);
        }
        return self::$conn;
    }
}
