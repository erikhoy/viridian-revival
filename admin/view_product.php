<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect("listed_products.php");
  }

  $product = Product::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));
  $description = Description::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));
  $status = Status::find_by_id($product->status_id);
  $measurement = Measurement::get_measurements(filter_var($_GET['id'], FILTER_SANITIZE_INT));
  if (!empty($product->bin_id)) {
    $bin = Bin::find_by_id($product->bin_id);
  } else {
    $bin = Bin::find_by_id(15);
  }
  if (!empty($product->bin_id)) {
    $platform = Platform::find_by_id($product->platform_id);
  } else {
    $platform = Platform::find_by_id(6);
  }
  if (!empty($product->bin_id)) {
    $platform = Platform::find_by_id($product->platform_id);
  } else {
    $platform = Platform::find_by_id(6);
  }
  
  $image = Image::find_by_id($product->id);
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
        <h1><a href="index.php">Products</a> > <?=$product->name; ?></h1>
        <hr>
        <div class="col col-md-6">
          <?php if($image) { ?>
            <img class="img-responsive" src="<?=IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="400">
          <?php } ?>
        </div>
        <div class="col col-md-6">
          <p class="lead"> Purchase Date: <?=date("F j, Y", strtotime($product->purchase_date)); ?></p>
          <p class="lead"> Sold Date: <?=date("F j, Y", strtotime($product->sold_date)); ?></p>
          <p class="lead"> Delivered Date: <?=date("F j, Y", strtotime($product->delivered_date)); ?></p>
          <p class="lead"> Purchase Price: $<?=number_format($product->purchase_price, 2); ?></p>
          <p class="lead"> Sold Price: $<?=number_format($product->sold_price, 2); ?></p>
          <p class="lead"> Description: <?php if($description) { echo $description->body; } ?></p>
          <p class="lead"> Status: <?=$status->name; ?></p>
          <p class="lead"> Bin: <?=$bin->name; ?></p>
          <p class="lead"> Platform: <?=$platform->name; ?></p>
          <hr>
          <h2>Measurements</h2>
          <p class="lead"> Weight: <?=$measurement->weight; ?></p>
          <p class="lead"> Length: <?=$measurement->length; ?></p>
          <p class="lead"> Width: <?=$measurement->width; ?></p>
          <p class="lead"> Height: <?=$measurement->height; ?></p>
          <a class="btn btn-primary pull-right" href="edit_product.php?id=<?=$product->id; ?>">Edit</a>
        </div>
      </div>              
      <!-- /.row -->
    </div>
  </div>
</div>

<?php include("../includes/footer.php");
