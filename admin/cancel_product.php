<?php 
  include("includes/header.php");

  if(!$session->is_signed_in()) {
    redirect("login.php");
  }

  if(empty($_GET['id'])) {
    redirect("dashboard.php");
  } 
  
  $product = Product::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));
  $product->status_id = 7;
  if(is_null($product->sold_price)) {
    $product->sold_price = 0;
  }
  if(is_null($product->shipping)) {
    $product->sold_price = 0;
  }
  $session->message("The product {$product->name} has been deleted");
  $redirect_url = $_SERVER['HTTP_REFERER'];
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
<?php 
  // Brand and toggle get grouped for better mobile display 
  include("includes/top_nav.php");
  // Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
  include("includes/side_nav.php");
?>
<!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper"></div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php");
