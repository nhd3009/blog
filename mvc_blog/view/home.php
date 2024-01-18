<div class="col-md-10 col-lg-8 col-xl-7">
    <h3 class="text-center" style="margin: 20px;">Posts</h3>
    <?php
        if (isset($posts) && is_array($posts)) {
            foreach ($posts as $row) {
                echo '
                <!-- Post preview-->
                <div class="post-preview">
                    <a href="index.php?content=post_detail&id='. $row['id'] .'">
                        <h2 class="post-title">' . $row['title'] . '</h2>
                        <h3 class="post-subtitle">' . $row['subtitle'] . '</h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!">' . $row['user_name'] . '</a> at
                        ' . $row['created_at'] . '
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />';
            }
        }   else if(isset($search_post) && !empty($search_post)){
                foreach ($search_post as $row) {
                    echo '
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="index.php?content=post_detail&id='. $row['id'] .'">
                            <h2 class="post-title">' . $row['title'] . '</h2>
                            <h3 class="post-subtitle">' . $row['subtitle'] . '</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">' . $row['user_name'] . '</a> at
                            ' . $row['created_at'] . '
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />';
                }
        } else {
            echo '<p>No posts available.</p>';
        }
    ?>
</div>

<div class="row gx-4 gx-lg-5 justify-content-center">
    <h3 class="text-center" style="margin: 20px;">Categories</h3>
    <?php 
        foreach ($categories as $row){
            if(isset($_GET['category_id']) && $_GET['category_id'] == $row['id']){
                continue;
            }
            else{
                echo '
                <div class="col-md-4">
                    <div class="alert alert-dark text-center rounded-pill" role="alert">
                        <a href="index.php?content=category_post&category_id=' .$row['id'] . '">' . $row['name'] . '</a>
                    </div>
                </div>
                ';
            }
        } 
    ?>
        
</div>

