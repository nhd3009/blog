<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-outline mb-4 mt-4">
                    <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" value="<?= $category['name'] ?>"/>          
                </div>
                <button type="submit" name="update_category_submit" class="btn btn-primary  mb-4 text-center">update</button>

            
                </form>

            </div>
        </div>
    </div>
</div>