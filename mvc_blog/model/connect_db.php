<?php
    function connect_database(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db_name = "php_blog";
    
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
?>