<nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav side-nav" >
                <li class="nav-item">
                <a class="nav-link text-white" style="margin-left: 20px;" href="index.php">Home
                    <span class="sr-only">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?admin_content=admins" style="margin-left: 20px;">Admins</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?admin_content=categories" style="margin-left: 20px;">Categories</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?admin_content=posts" style="margin-left: 20px;">Posts</a>
                </li>
                <!--  <li class="nav-item">
                <a class="nav-link" href="#" style="margin-left: 20px;">Comments</a>
                </li> -->
            </ul>
            <ul class="navbar-nav ml-md-auto d-md-flex">
                <?php ?>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['adminname'] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?admin_content=logout">Logout</a>
                    
                </li>
                                
                
            </ul>
        </div>
    </div>
</nav>