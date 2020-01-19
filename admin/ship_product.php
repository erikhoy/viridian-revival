<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect("sold_products.php");
  }

  $product = Product::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));
  $platforms = Platform::find_all();
  
  if (isset($_POST['update'])) {
    if ($product) {
      $product->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $description->body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
      $product->shipping = filter_var($_POST['shipping'], FILTER_SANITIZE_DOUBLE_FLOAT);
      $product->actual_shipping = filter_var($_POST['actual_shipping'], FILTER_SANITIZE_DOUBLE_FLOAT);
      $product->platform_id = filter_var($_POST['platform_id'], FILTER_SANITIZE_INT);
      $product->status_id = 4;
      $product->bin_id = 14;
      $session->message("The product {$product->name} has been shipped");
      $product->save();
      redirect('sold_products.php');
    }
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
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Ship Product</h1>
        <form action="" method="post">
          <div class="col col-md-8">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value='<?=$product->name; ?>'>
            </div>
            <div class="form-group">
              <label for="shipping">Shipping</label>
              <input type="text" name="shipping" class="form-control" value='<?=$product->shipping; ?>' autofocus="autofocus">
            </div>
            <div class="form-group">
              <label for="actual_shipping">Actual Shipping</label>
              <input type="text" name="actual_shipping" class="form-control datepicker" value='<?=$product->actual_shipping; ?>'>
            </div>
          </div>
          <div class="col-md-4" >
            <div class="photo-info-box">
              <div class="info-box-header">
                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
              </div>
              <div class="inside">
                <div class="box-inner">
                  <p class="text"><span class="glyphicon glyphicon-calendar"></span> Purchased on: <?=$product->purchase_date; ?></p>
                  <p class="text"><span class="glyphicon glyphicon-calendar"></span> Sold on: <?=$product->sold_date; ?></p>
                  <p class="text"><span class="glyphicon glyphicon-usd"></span> Purchase Price: <?=number_format($product->purchase_price, 2); ?></p>
                  <p class="text "><span class="glyphicon glyphicon-usd"></span> Sold Price: <?=number_format($product->sold_price, 2); ?></p>
                </div>
                <div class="info-box-footer clearfix">
                  <div class="info-box-delete pull-left">
                    <a href="delete_photo.php?id=<?=$photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                  </div>
                  <div class="info-box-update pull-right ">
                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                  </div>   
                </div>
              </div>          
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php");
