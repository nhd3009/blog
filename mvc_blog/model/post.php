<?php
    function get_all_post(){
        $conn = connect_database();
        $sql = "SELECT * FROM posts where status = 1";
        $result = $conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_posts_by_category( $category_id ){
        $conn = connect_database();
        try{
            $sql = "Select * from posts where category_id = :category";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":category", $category_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    function create_post($title, $subtitle, $body, $image, $category_id, $user_id, $user_name){
        $conn = connect_database();
        try {
            $sql = "INSERT INTO posts (title, subtitle, body, img, category_id, user_id, user_name) values (:title, :subtitle, :body, :img, :category_id, :user_id, :user_name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":subtitle", $subtitle);;
            $stmt->bindParam(":body", $body);
            $stmt->bindParam(":img", $image);
            $stmt->bindParam(":category_id", $category_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":user_name", $user_name);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null; // Close the database connection
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
    
    function update_post($id, $title, $subtitle, $body, $category, $image){
        $conn = connect_database();
        try {
            $sql = "Update posts set title = :title, subtitle = :subtitle, body = :body, category_id = :category, img = :image where id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":subtitle", $subtitle);
            $stmt->bindParam(":body", $body);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":image", $image);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    function delete_post($id){
        $conn = connect_database();
        try{
            $sql = "Delete from posts where id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        }catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    function get_comment_by_post_id($id){
        $conn = connect_database();
        try{
            $sql = "SELECT a.id as post_id, b.id as comment_id, b.comment as comment, b.user_name_comment as user_comment_name, b.created_at as cmt_created_at
                from posts a join comments b
                on a.id = b.id_post_comment
                where b.status_comment = 1 and a.id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    function insert_comment_from_user($post_id, $user_name, $comment){
        $conn = connect_database();
        try{
            $sql = "insert into comments (id_post_comment, user_name_comment, comment, status_comment) values (:post_id, :user_name, :comment, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":post_id", $post_id);
            $stmt->bindParam(":user_name", $user_name);
            $stmt->bindParam(":comment", $comment);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }
?>