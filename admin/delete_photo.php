<?php 
  include("includes/init.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect("photos.php");
  }

  $photo = Photo::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));

  if($photo) {
    $photo->delete_photo();
    $session->message("The photo {$photo->filename} has been deleted");
    redirect("photos.php");
  }
  
  redirect("photos.php");
