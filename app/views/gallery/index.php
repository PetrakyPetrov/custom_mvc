<?php 
    foreach ($images as $image) {
      $id = $image['id'];
      echo "<div class=\"col-md-4\" style=\"margin-top: 5px;\">";
      echo   "<a href=".SERVER_URL.$image['path']." data-toggle=\"lightbox\" data-gallery=\"gallery\">";
      echo       "<img src=".SERVER_URL.$image['path']." class=\"img-fluid rounded\">";
      echo   "</a><br>";
      echo   "<a href=\"/gallery/view?id={$id}\" >Get more info</a>";
      echo "</div>";
    }
?>