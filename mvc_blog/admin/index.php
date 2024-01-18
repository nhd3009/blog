
<?php
    include("model/connect_db.php");
    include("model/login.php");
    include("model/dashboard.php");
    include("model/admins.php");
    include("model/category.php");
    include("model/post.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once("layout/head.php");
?>
<body>
<div id="wrapper">
    <?php
        if(isset($_SESSION['adminname']))
            require_once("layout/nav.php");
    ?>
    <div class="container-fluid">
            
        <?php
            if(isset($_GET['admin_content'])){
                switch($_GET['admin_content']){

                    case 'login':
                        include('view/auth/login.php');
                        if(isset($_POST['login_admin_submit'])){
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $login = check_admin_login($email);
                            if($login){
                                $hash_pasword = $login['mypassword'];
                                if(password_verify($password, $hash_pasword)){
                                    $_SESSION['adminname'] = $login['adminname'];
                                    $_SESSION['email'] = $login['email'];
                                    $_SESSION['admin_id'] = $login['id'];
                                    
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
                        if(isset($_SESSION["adminname"])){
                            header('location: index.php');
                        }
                        break;

                    case 'logout':
                        session_unset();
                        session_destroy();
                        header('Location: index.php?admin_content=login');
                        break;

                    case 'admins':
                        if(!isset($_SESSION["admin_id"])){
                            header('location: index.php?admin_content=logout');
                        }
                        else{
                            $admin_list = show_admin_list();
                            include('view/admin/admin.php');
                        }
                        break;

                    case 'create_admin':
                        if(!isset($_SESSION["admin_id"])){
                            header('location: index.php?admin_content=logout');
                        }
                        if(!isset($_POST['create_admin_submit']))
                            include('view/admin/create_admin.php');
                        else{
                            $email = $_POST['email'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $hash_pasword = password_hash($password, PASSWORD_DEFAULT);
                            $result = create_admin($email, $username, $password);
                            if($result){
                                header('location: index.php?admin_content=admins');
                            }
                            else{
                                echo "<script>window.alert('Create admin failed');</script>";
                            }
                        }
                        break;

                    case 'categories':
                        if(!isset($_SESSION["admin_id"])){
                            header('location: index.php?admin_content=logout');
                        }
                        else{
                            $category_list = show_all_category();
                            include('view/category/categories.php');
                        }
                        break;

                    case 'create_category':
                        if(!isset($_POST["create_category_submit"])){
                            include('view/category/create_category.php');
                        }
                        if(!isset($_SESSION["admin_id"])){
                            header('location: index.php?admin_content=logout');
                        }
                        if(isset($_POST['create_category_submit'])){
                            $name = $_POST['name'];
                            $result = create_category($name);
                            if($result){
                                header('location: index.php?admin_content=categories');
                            }
                            else{
                                echo "<script>window.alert('Create category failed');</script>";
                            }
                        }
                        break;

                    case 'update_category':
                        if(isset($_GET['id']) && isset($_SESSION['admin_id'])){
                            if(!isset($_POST['update_category_submit'])){
                                $category = get_a_category($_GET['id']);
                                include('view/category/update_category.php');
                            }
                            else{
                                $id = $_GET['id'];
                                $name = $_POST['name'];
                                $result = update_category($id, $name);
                                if($result){
                                    header('location: index.php?admin_content=categories');
                                }
                                else{
                                    echo "<script>window.alert('Update category failed');</script>";
                                }
                                
                            }
                        }
                        else{
                            header('location: index.php?admin_content=logout');
                        }
                        break;

                    case 'delete_category':
                        if(isset($_GET['id']) && isset($_SESSION['admin_id'])){
                            $id = $_GET['id'];
                            delete_category($id);
                            header('location: index.php?admin_content=categories');
                        }
                        else{
                            header('location: index.php?admin_content=logout');
                        }
                        break;
                        
                    case 'posts':
                        if(!isset($_SESSION["admin_id"])){
                            header('location: index.php?admin_content=logout');
                        }
                        else{
                            $categories = show_all_category();
                            $post_list = get_all_post();
                            include('view/post/posts.php');
                        }
                        break;

                    case 'change_post_status':
                        if(isset($_GET['status']) && isset($_GET['id']) && isset($_SESSION['admin_id'])){
                            $id = $_GET['id'];
                            $status = $_GET['status'];
                            $result = change_status($id, $status);
                            if($result){
                                header('location: index.php?admin_content=posts');
                            }
                            else{
                                echo "<script>window.alert('Update status failed');</script>";
                            }
                        }
                        else{
                            header("location: index.php?admin_content=logout");
                        }
                        break;
                    case 'delete_post':
                        if(isset($_GET['id']) && isset($_SESSION['admin_id'])){
                            $id = $_GET['id'];
                            $result = delete_post($id);
                            if($result){
                                header('location: index.php?admin_content=posts');
                            }
                            else{
                                echo "<script>window.alert('Delete post failed');</script>";
                            }
                        }
                        else{
                            header('location: index.php?admin_content=logout');
                        }
                        break;

                    case 'change_status_comment':
                        if(isset($_GET['comment_id']) && isset($_GET['status']) && isset($_GET['post_id'])){
                            if(!isset($_SESSION['admin_id'])){
                                header('location: index.php?admin_content=logout');
                            }
                            else{
                                $comment_id = $_GET['comment_id'];
                                $status = $_GET['status'];
                                $post_id = $_GET['post_id'];
                                $result = change_status_comment($comment_id, $status);
                                if($result){
                                    header('location: index.php?admin_content=detail_post&id=' . $post_id);
                                }
                                else{
                                    echo "<script>window.alert('Changing status failed');</script>";
                                }
                                
                            }
                        }
                        break;
                    case 'delete_comment':
                        if(isset($_GET['comment_id']) && isset($_GET['post_id'])){
                            if(!isset($_SESSION['admin_id'])){
                                header('location: index.php?admin_content=logout');
                            }
                            else{
                                $comment_id = $_GET['comment_id'];
                                $post_id = $_GET['post_id'];
                                $result = delete_comment($comment_id);
                                if($result){
                                    header('location: index.php?admin_content=detail_post&id=' . $post_id);
                                }
                                else{
                                    echo "<script>window.alert('Changing status failed');</script>";
                                }
                            }
                        }
                        break;

                    case 'detail_post':
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $post = get_detail_post($id);
                            $comments = get_comment_by_post_id($id);
                            include('view/post/post_detail.php');
                        }
                        break;

                    default:
                        if(!isset($_SESSION["adminname"])){
                            header('location: index.php?admin_content=logout');
                        }
                        break;
                }
            }
            else{
                if(!isset($_SESSION["adminname"])){
                    header('location: index.php?admin_content=logout');
                }
                $count_user = count_users();
                $count_posts = count_posts();
                $count_categories = count_categories();
                include('view/dashboard.php');
            }
        ?>
            
    </div>
</div>
<script type="text/javascript">

</script>
</body>
</html>
