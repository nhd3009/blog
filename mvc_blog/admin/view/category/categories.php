<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Categories</h5>
                <a  href="index.php?admin_content=create_category" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($category_list as $category): ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $category['name'] ?></td>
                            <td><a  href="index.php?admin_content=update_category&id=<?= $category['id']?>" class="btn btn-warning text-white text-center ">Update Categories</a>
                                <a href="index.php?admin_content=delete_category&id=<?= $category['id']?>" class="btn btn-danger  text-center ">Delete Categories</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
