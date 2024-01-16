<?php
    function check_admin_login($email) {
        $conn = connect_database();
        try {
            $sql = "SELECT * FROM admins WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
        
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null; // Close the database connection
    }
?>