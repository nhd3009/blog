<?php
    include("model/connect_db.php");
    include("model/register.php");
    include("model/login.php");
    include("model/post.php");
    include("model/category.php");
?>
<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php
        require_once("layout/head.php");
    ?>
    <body>
        
        <?php
            require_once("layout/nav.php");
        ?>
        <!-- Page Header-->
        <?php
            require_once("layout/header.php");
        ?>

        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php
                    if(isset($_GET['content'])){
                        switch($_GET['content']){
                            case 'register':
                                include('view/auth/register.php');
                                if(isset($_POST['register_submit'])){
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $hash_pasword = password_hash($password, PASSWORD_DEFAULT);
                                    $email = $_POST['email'];
                                    if(check_user_exist($username, $email)){
                                        echo "<script>window.alert('". "User or Email already exists!" ."');</script>";
                                    }else{
                                        register_user($email, $username, $hash_pasword);
                                        header("Location: index.php?content=login");
                                    }
                                }
                                break;
                            case 'login':
                                include('view/auth/login.php');
                                if(isset($_POST['login_submit'])){
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];
                                    $login = check_login($email);
                                    if($login){
                                        $hash_pasword = $login['mypassword'];
                                        if(password_verify($password, $hash_pasword)){
                                            $_SESSION['username'] = $login['username'];
                                            $_SESSION['email'] = $login['email'];
                                            $_SESSION['user_id'] = $login['id'];
                                            header('location: index.php');
                                        }
                                        else{
                                            echo "<script>window.alert('Incorrect password for the given email.');</script>";
                                        }               
                                    }
                                    else{
                                        echo "<script>window.alert('User not found for the given email.');</script>";
                                    }
                                }
                                if(isset($_SESSION["username"])){
                                    header('location: index.php');
                                }
                                break;
                            case 'logout':
                                session_unset();
                                session_destroy();
                                header('Location: index.php');
                                break;
                            case 'create_post' : 
                                if(!isset($_POST["submit_create_post"])){
                                    $categories = get_all_categories();
                                    include('view/posts/create_post.php');
                                }
                                if(!isset($_SESSION["user_id"])){
                                    header('location: index.php');
                                }
                                if (isset($_POST["submit_create_post"])) {
                                    $title = $_POST["title"];
                                    $subtitle = $_POST["subtitle"];
                                    $image = $_FILES["img"]["name"];
                                    $body = $_POST["body"];
                                    $category = $_POST["category"];
                                    $user_id = $_SESSION["user_id"];
                                    $user_name = $_SESSION["username"];
                                    $dir = "images/" . basename($image);
                                    create_post($title, $subtitle, $body, $image, $category, $user_id, $user_name);                        
                                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir)) {
                                        header('location: index.php');
                                    }
                                }
                                break;
                            case 'post_detail':
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $post = get_detail_post($id);
                                    $comments = get_comment_by_post_id($id);
                                    include('view/posts/post_detail.php');
                                }
                                break;
                            case 'update_post':
                                $post = get_detail_post($_GET['id']);
                                if(isset($_GET['id']) && $_SESSION['user_id'] == $post['user_id']){
                                    if(!isset($_POST['update_post_submit'])){
                                        $categories = get_all_categories();
                                        include('view/posts/update_post.php');
                                    }
                                    else{
                                        $id = $_GET['id'];
                                        $title = $_POST['title'];
                                        $subtitle = $_POST['subtitle'];
                                        $body = $_POST['body'];
                                        $category = $_POST["category"];
                                        $image = $_FILES['image']['name'];
                                        $dir = "images/" . basename($image);
                                        unlink("images/" . $post["img"]); 
                                        update_post($id, $title, $subtitle, $body, $category, $image);                 
                                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $dir)) {
                                            header('location: index.php');
                                        }
                                        
                                    }
                                    
                                    
                                }
                                else{
                                    header('location: index.php');
                                }
                                break;
                            case 'delete_post':
                                $post = get_detail_post($_GET['id']);
                                if(isset($_GET['id']) && $_SESSION['user_id'] == $post['user_id']){
                                    $id = $_GET['id'];
                                    unlink("images/" . $post["img"]);
                                    delete_post($id);
                                    header('location: index.php');
                                }
                                else{
                                    header('location: index.php');
                                }
                                break;
                            case 'post_comment':
                                if(!isset($_SESSION['user_id'])){
                                    header('index.php?content=login');
                                }
                                if(isset($_GET['id_post'])){
                                    $post_id = $_GET['id_post'];
                                    $user_name = $_SESSION['username'];
                                    if(isset($_POST['post_comment_submit'])){
                                        $comment = $_POST['comment'];
                                        $comment = insert_comment_from_user($post_id, $user_name, $comment);
                                        if($comment){
                                            header('location: index.php?content=post_detail&id='. $post_id);
                                        }
                                        else{
                                            echo "<script>window.alert('Comment failed');</script>";
                                        }
                                    }
                                }
                                break;
                            case 'category_post':
                                if($_GET['category_id']){
                                    $id = $_GET['category_id'];
                                    $posts = get_posts_by_category($id);
                                    $categories = get_all_categories();
                                    include('view/home.php');
                                }
                                break;
                            case 'delete_comment':
                                if(isset($_GET['comment_id']) && isset($_GET['post_id']) && isset($_GET['user_name'])){
                                    if(!isset($_SESSION['user_id'])){
                                        
                                        echo "<script>window.alert('No session id');</script>";
                                        // header('location: index.php?content=login');
                                    }
                                    else{
                                        $comment_id = $_GET['comment_id'];
                                        $post_id = $_GET['post_id'];
                                        $username = $_GET['user_name'];
                                        if($_SESSION['username'] == $username){
                                            delete_comment($comment_id, $username);
                                            header('location: index.php?content=post_detail&id='. $post_id);
                                        }
                                        else{
                                            echo "<script>window.alert('". $_SESSION['username'] . "and lmao&" . $_GET['user_name'] ."');</script>";
                                            // header('location: index.php?content=logout');
                                        }
                                    }    
                                }
                                break;
                            default:
                                $categories = get_all_categories();
                                $posts = get_all_post();
                                include('view/home.php');
                                break;
                        }
                    }
                    else{
                        $posts = get_all_post();
                        $categories = get_all_categories();
                        include('view/home.php');
                    }
                ?>
            </div>
        </div>
        <!-- Footer-->
        <?php 
            require_once("layout/footer.php");
        ?>

        <!-- Script -->
        <?php
            require_once("layout/script.php");
        ?>
    </body>
</html>
