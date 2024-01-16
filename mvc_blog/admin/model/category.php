<?php
    function show_all_category(){
        $conn = connect_database();
        $sql = "Select * from categories";
        $result = $conn->prepare($sql);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_a_category($id) {
        $conn = connect_database();
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function update_category($id, $name){
        $conn = connect_database();
        $sql = "update categories set name = :name where id = :id";
        $result = $conn->prepare($sql);
        $result->bindParam(":id", $id);
        $result->bindParam(":name", $name);
        $result->execute();
        return $result;
    }
    
    function create_category($name){
        $conn = connect_database();
        $sql = "insert into categories (name) values (:name)";
        $result = $conn->prepare($sql);
        $result->bindParam(":name", $name);
        $result->execute();
        return $result;
    }

    function delete_category($id){
        $conn = connect_database();
        $sql = "Delete from categories where id = :id";
        $result = $conn->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        return $result;
    }
?>