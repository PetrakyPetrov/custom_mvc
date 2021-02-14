<div class="col-md-8 offset-md-2" style="margin-top: 10px;">
    <form action="/gallery/upload" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="image" required>
        <?php 

            $logged_user = get_logged_user()['id'];
            echo "<input type='hidden' value='{$logged_user}' name='user_id'>"
        ?>
        <input type="submit" value="Upload Image" name="submit"><br>
        <?php 
            if (isset($params['error'])) {
                echo "<span class='text-danger'>{$params['error']}</span>";
            }
        ?>
    </form>
</div>