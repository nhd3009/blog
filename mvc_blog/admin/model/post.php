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

    function get_comment_by_post_id($id){
        $conn = connect_database();
        try{
            $sql = "SELECT a.id as post_id, b.id as comment_id, b.comment as comment, b.user_name_comment as user_comment_name, b.created_at as cmt_created_at, b.status_comment as status
                from posts a join comments b
                on a.id = b.id_post_comment
                where a.id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    function get_detail_post($id){
        $conn = connect_database();
        try {
            $sql = "select * from posts where id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    function change_status_comment($comment_id, $status){
        $conn = connect_database();
        try {
            $sql = "update comments set status_comment = :status where id = :comment_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":comment_id", $comment_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    function delete_comment($comment_id){
        $conn = connect_database();
        try {
            $sql = "delete from comments where id = :comment_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":comment_id", $comment_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }
?>