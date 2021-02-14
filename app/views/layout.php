<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
  
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="/">Public gallery</a>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
    </ul>
    <?php 
        if (get_logged_user()) {
            $username = get_logged_user()['username'];
            echo "<a href=\"/gallery\" class=\"btn btn-outline-success my-2 my-sm-0\" style=\"margin-right:5px;\">All Photos</a>";
            echo "<a href=\"/gallery/myphotos\" class=\"btn btn-outline-success my-2 my-sm-0\" style=\"margin-right:5px;\">My Photos</a>";
            echo "<a href=\"/gallery/upload\" class=\"btn btn-outline-success my-2 my-sm-0\" style=\"margin-right:5px;\">Upload Photo</a>";
            echo "<a href=\"/users/logout\" class=\"btn btn-outline-success my-2 my-sm-0\" style=\"margin-right:5px;\">Logout ({$username})</a>";
        } else {
            echo "<a href=\"/users/register\" class=\"btn btn-outline-success my-2 my-sm-0\" style=\"margin-right:5px;\">Register</a>";
            echo "<a href=\"/users/login\" class=\"btn btn-outline-success my-2 my-sm-0\">Login</a>";
        }
    ?>
  </div>
</nav>
<div class="container" style="margin-top: 60px;">
  <div class="row">
  <?php 
      include $params['view'];
  ?>
  </div>
</div>
<script>
  $(document).on("click", '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });
</script>
</body>
</html>
