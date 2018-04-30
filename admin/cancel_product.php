<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    if(empty($_GET['id'])) {
        redirect("dashboard.php");
    } else {
        $product            = Product::find_by_id($_GET['id']);
        $product->status_id = 7;
        if(is_null($product->sold_price)) {
            $product->sold_price = 0;
        }
        if(is_null($product->shipping)) {
            $product->sold_price = 0;
        }
        //$product->save();
        $session->message("The product {$product->name} has been deleted");
        $redirect_url = $_SERVER['HTTP_REFERER'];
        //redirect("unlisted_products.php");
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
</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>