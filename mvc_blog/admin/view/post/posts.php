<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Posts</h5>
            
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">category</th>
                        <th scope="col">user</th>
                        <th scope="col">status</th>
                        <th scope="col">delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i=0; foreach($post_list as $post): ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $post['title'] ?></td>
                                <td>
                                    <?php
                                        $category = get_a_category($post['category_id']);
                                        echo $category['name'];
                                    ?>
                                </td>
                                <td><?= $post['user_name'] ?></td>
                                <?php
                                    if($post['status'] == 1){
                                        echo '<td><a href="index.php?admin_content=change_post_status&status=0&id='. $post['id'] .'" class="btn btn-success  text-center ">Activated</a></td>';
                                    }
                                    else{
                                        echo '<td><a href="index.php?admin_content=change_post_status&status=1&id='. $post['id'] .'" class="btn btn-danger  text-center ">Deactivated</a></td>';
                                    }
                                ?>
                                <td><a href="index.php?admin_content=delete_post&id=<?= $post['id'] ?>" class="btn btn-danger  text-center ">delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>