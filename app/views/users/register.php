<div class="col-md-4 offset-md-4">
    <form class="form-signin" action="/users/register" method="POST">
        <h1 class="h3 mb-3 font-weight-normal text-center">Public gallery registration</h1>
        <input type="text" class="form-control" placeholder="Username" name="username" required><br>
        <input type="password" class="form-control" placeholder="Password" name="password" required><br>
        <?php 
            if (isset($params['error'])) {
                echo "<span>{$params['error']}</span>";
            }
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>
</div>