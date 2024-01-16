<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Admins</h5>
                <a href="index.php?admin_content=create_admin" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">username</th>
                        <th scope="col">email</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        <?php foreach($admin_list as $admin) : ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?= $admin['adminname'] ?></td>
                                <td><?= $admin['email'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>