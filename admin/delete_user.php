<?php 
  include("includes/init.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect("users.php");
  }

  $user = User::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));

  if ($user) {
    $user->delete_photo();
    $session->message("The user {$user->username} has been deleted.");
    redirect("users.php");
  }

  redirect("users.php");
