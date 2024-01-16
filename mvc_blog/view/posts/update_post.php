<div class="container px-4 px-lg-5">

            <form method="POST" action="index.php?content=update_post&id=<?= $post['id'] ?>" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" value="<?= $post['title'] ?>"/>
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" value="<?= $post['subtitle'] ?>"/>
            </div>

              <div class="form-outline mb-4">
                <input type="text" name="body" id="form2Example1" class="form-control" placeholder="body" value="<?= $post['body'] ?>"/>
            </div>
            <div class="form-outline mb-4">
                <select name="category" class="form-select" aria-label="Default select example">
                    <?php foreach($categories as $category) : ?>
                        <option <?php echo ($category['id'] == $post['category_id']) ? 'selected' : ''; ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <img src="images/<?= $post['img'] ?>" style="max-width: 500px; height: auto; margin-bottom: 20px;">
            <div class="form-outline mb-4">
                <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="update_post_submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>


           
</div>