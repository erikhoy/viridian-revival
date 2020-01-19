<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  $descriptions = Description::find_all();
  $images = Image::find_all();
  
  foreach ($descriptions as $description) {
    $description->product_id = $description->id;
    $description->body = $database->escape_string($description->body);
    $description->update();
  }
  
  foreach ($images as $image) {
    $image->product_id = $image->id;
    $image->update();
  }    
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->     
  <?php include("includes/top_nav.php"); ?>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <?php include("includes/side_nav.php"); ?>
<!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="container-fluid"></div>
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php");
