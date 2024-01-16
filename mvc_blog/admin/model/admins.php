<?php
    function show_admin_list(){
        $conn = connect_database();
        $sql = "Select * from admins";
        $result = $conn->prepare($sql);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }

    function create_admin($email, $adminname, $password){
        $conn = connect_database();
        $sql = "insert into admins(email, adminname, mypassword) values (:email, :adminname, :mypassword)";
        $result = $conn->prepare($sql);
        $result->bindParam(":email", $email);
        $result->bindParam(":adminname", $adminname);
        $result->bindParam(":mypassword", $password);
        $result->execute();
        return $result;
    }
?>