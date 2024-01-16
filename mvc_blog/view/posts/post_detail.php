<header class="masthead" style="background-image: url('images/<?= $post['img'] ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?= $post['title'] ?></h1>
                    <h2 class="subheading"><?= $post['subtitle'] ?></h2>
                    <span class="meta">
                        Posted by
                        <?= $post['user_name'] ?>
                        <?= $post['created_at'] ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>
                            <?= $post['body'] ?>
                        </p>
                        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) : ?>
                            <a class="btn btn-warning" href="index.php?content=update_post&id=<?= $post['id'] ?>">Update</a>
                            <a class="btn btn-danger" href="index.php?content=delete_post&id=<?= $post['id'] ?>">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
</article>
<section>
          <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>

                    <div class="card p-3">
                        <div class="card-body">
                            <?php if(!empty($comments)) : ?>
                                <?php foreach($comments as $comment) :?>
                                    <div class="d-flex flex-start align-items-center">
                                        <div>
                                            <h6 class="fw-bold text-primary">
                                                <?= $comment['user_comment_name'] ?>
                                                <h8 class="p-3 text-black"><?= $comment['cmt_created_at'] ?></h8>
                                                <a style="text-align: right;" class="btn btn-danger">Delete</a>
                                            </h6> 
                                            
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-4 pb-2">
                                        <?= $comment['comment'] ?>
                                    </p>
                                    <hr class="my-4" />
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p style="font-style: italic;">This post feels lonely here can you make a comment to help me?</p>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($_SESSION['user_id'])) : ?>
                            <form method="post" action="index.php?content=post_comment&id_post=<?= $post['id'] ?>">

                                <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">

                                    <div class="d-flex flex-start w-100">
                                    
                                        <div class="form-outline w-100">
                                            <textarea class="form-control" id="" placeholder="write message" rows="4"
                                            name="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="float-end mt-2 pt-1">
                                        <button type="submit" name="post_comment_submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-danger text-center rounded-pill" role="alert">
                                <a href="index.php?content=login">You must login first to comment</a>
                            </div>
                        <?php endif; ?>
                    </div>
              </div>
            </div>
          </div>
        </section>