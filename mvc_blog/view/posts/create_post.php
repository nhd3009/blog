<div class="container px-4 px-lg-5">

    <form method="POST" action="index.php?content=create_post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" name="title" class="form-control" placeholder="title" />
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="subtitle" class="form-control" placeholder="subtitle" />
        </div>
        <div class="form-outline mb-4">
            <textarea name="body" class="form-control" placeholder="body" rows="8"></textarea>
        </div>
        
        <div class="form-outline mb-4">
            <select name="category" class="form-select" aria-label="Default select example">
                <?php foreach($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-outline mb-4">
            <input type="file" name="img" class="form-control" />
        </div>
        <button type="submit" name="submit_create_post" class="btn btn-primary mb-4 text-center">create</button>
    </form>

</div>