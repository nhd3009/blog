<?php
    function get_all_categories(){
        $conn = connect_database();
        $sql = "Select * from categories";
        $categories = $conn->query($sql);
        return $categories->fetchAll(PDO::FETCH_ASSOC);
    }
?>