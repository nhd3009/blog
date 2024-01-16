<?php
    function count_users(){
        $conn = connect_database();
        $sql = "Select COUNT(*) as users_count from users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    function count_posts(){
        $conn = connect_database();
        $sql = "Select COUNT(*) as users_count from posts";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    function count_categories(){
        $conn = connect_database();
        $sql = "Select COUNT(*) as users_count from categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
?>