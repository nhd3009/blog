<?php
    function get_all_post(){
        $conn = connect_database();
        $sql = "Select * from posts";
        $result = $conn->prepare($sql);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }

    function change_status($id, $status){
        $conn = connect_database();
        $sql = "Update posts set status = :status where id = :id";
        $result = $conn->prepare($sql);
        $result->bindParam(":id", $id);
        $result->bindParam(":status", $status);
        $result->execute();
        return $result;
    }

    function delete_post( $id ){
        $conn = connect_database();
        $sql = "Delete from posts where id = :id";
        $result = $conn->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        return $result;
    }
?>