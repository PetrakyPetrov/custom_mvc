<div class="col-md-12">
    <a href="/gallery" class="btn btn-outline-success my-2 my-sm-0" style="margin-right:5px;">Back to Gallery</a><br>
</div>
<div class="col-md-12">
    <img src="<?= SERVER_URL.$image['path'] ?>" class="img-fluid rounded"/>
    <span class="form-control"><b>Name:</b> <?= $image['name']?></span>
    <span class="form-control"><b>Size:</b> <?= $image['size_KB']?> KB</span>
    <span class="form-control"><b>Create Date:</b> <?= $image['create_date']?></span>
    <span class="form-control"><b>From User:</b> <?= $image['username']?></span><br>
    <?php 
        if (isset(get_logged_user()['id']) && get_logged_user()['id'] == $image['user_id']) {
            $id = $image['id'];
            echo "<a href=\"/gallery/delete?id={$id}\" class=\"btn btn-outline-danger my-2 my-sm-0\">Delete</a>";
        }
    ?>
</div>