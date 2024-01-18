<section>
          <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>

                    <div class="card p-3">
                        <div class="card-body">
                            <?php if(!empty($comments)) : ?>
                                <?php foreach($comments as $comment) :?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="fw-bold text-primary">
                                            <?= $comment['user_comment_name'] ?>
                                            <h8 class="p-3 text-black"><?= $comment['cmt_created_at'] ?></h8>
                                        </h6> 
                                        <div class="d-flex">
                                            <?php if($comment['status'] == 1) : ?>
                                                <a href="index.php?admin_content=change_status_comment&comment_id=<?= $comment['comment_id'] ?>&status=0&post_id=<?= $comment['post_id'] ?>" class="btn btn-success btn-sm rounded-pill me-2 mr-2">Activated</a>
                                            <?php else : ?>
                                                <a href="index.php?admin_content=change_status_comment&comment_id=<?= $comment['comment_id'] ?>&status=1&post_id=<?= $comment['post_id'] ?>" class="btn btn-warning btn-sm rounded-pill me-2 mr-2">Deactivated</a>
                                            <?php endif; ?>
                                            <a href="index.php?admin_content=delete_comment&comment_id=<?= $comment['comment_id'] ?>&post_id=<?= $comment['post_id'] ?>" class="btn btn-danger btn-sm rounded-pill">Delete</a>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-4 pb-2">
                                        <?= $comment['comment'] ?>
                                    </p>
                                    <hr class="my-4" />
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p style="font-style: italic;">No comment on this post</p>
                            <?php endif; ?>
                        </div>
                    </div>
              </div>
            </div>
          </div>
</section>
<div>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Header</th>
            <th scope="col">Content</th>
        </thead>
        <tbody>
            <tr>
                <th scope="row">From user</th>
                <td><?= $post['user_name'] ?></td>
            </tr>
            <tr>
                <th scope="row">Created at</th>
                <td><?= $post['created_at'] ?></td>
            </tr>
            <tr>
                <th scope="row">Title</th>
                <td><?= $post['title'] ?></td>
            </tr>
            <tr>
                <th scope="row">Subtitle</th>
                <td><?= $post['subtitle'] ?></td>
            </tr>
            <tr>
                <th scope="row">Body</th>
                <td><?= $post['body'] ?></td>
            </tr>
            <tr>
                <th scope="row">Image</th>
                <td><img style="width: 100%; height: auto;" src="../images/<?= $post['img'] ?>" alt=""></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="container text-center mb-3">
    <a href="index.php?admin_content=delete_post&id=<?= $post['id'] ?>" class="btn btn-danger mx-auto">Delete</a>
</div>