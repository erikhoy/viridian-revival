<?php 
  include("includes/init.php");

  if(!$session->is_signed_in()) {
    redirect("login.php");
  }
  
  if(empty($_GET['id'])) {
    redirect("comments.php");
  }

  $comment = Comment::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));

  if($comment) {
    $comment->delete();
    $session->message("The comment with ID {$comment->id} has been deleted");
    redirect("comments.php");
  } 

  redirect("comments.php");
