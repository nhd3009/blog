<?php
    function register_user($email, $username, $password){
        $conn = connect_database();
        
        try {
            $sql = "INSERT INTO users (email, username, mypassword) VALUES (:email, :username, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
    
            $stmt->execute();
            echo "<script>window.alert('". "User registered successfully!" ."');</script>";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $conn = null; // Close the database connection
    }

    function check_user_exist($username, $email){
        $conn = connect_database();
        try {
            $sql = "select * from users where username = :username or email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
    
            $stmt->execute();
            if( $stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>