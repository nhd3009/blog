<?php
    if( !isset($_GET['content']) || (isset($_GET['content']) && $_GET['content'] != 'post_detail')) :
?>
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Blog</h1>
                    <span class="subheading">A Normal Blog</span>
                </div>
            </div>
        </div>
    </div>
</header>
<?php
    endif;
?>