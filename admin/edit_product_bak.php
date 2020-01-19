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
  $statuses = Status::find_all();
  $bins = Bin::find_all();
  $platforms = Platform::find_all();
  $product->name = $database->escape_string($product->name);
  $image = Image::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));
        
  if (isset($_POST['update'])) {
    if ($product) {
      $product->name = filter_var($_POST['test'], FILTER_SANITIZE_STRING);
      $product->purchase_price = filter_var($_POST['purchase_price'], FILTER_SANITIZE_DOUBLE_FLOAT);
      $product->sold_price = filter_var($_POST['sold_price'], FILTER_SANITIZE_DOUBLE_FLOAT);
      $product->purchase_date = date("Y-m-d", strtotime(filter_var($_POST['purchase_date'], FILTER_SANITIZE_STRING));
      $product->sold_date = date("Y-m-d", strtotime(filter_var($_POST['sold_date'], FILTER_SANITIZE_STRING)));
      $product->delivered_date = date("Y-m-d", strtotime(filter_var($_POST['delivered_date'], FILTER_SANITIZE_STRING)));
      $description->body = filter_var($_POST['body'], FILTER_SANITIZE_STRING));
      $product->status_id = filter_var($_POST['status_id'], FILTER_SANITIZE_INT);
      $product->bin_id = filter_var($_POST['bin_id'], FILTER_SANITIZE_INT);
      $product->platform_id = filter_var($_POST['platform_id'], FILTER_SANITIZE_INT);
      $session->message("The product {$product->name} has been updated");
      $product->save();
      redirect("view_product.php?id={$product->id}");
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
        <h1 class="page-header">Edit Product</h1>
        <form action="" method="post" class="clearfix">
          <div class="col col-md-6">
            <?php if($image) { ?>
              <img class="img-responsive" src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100">
            <?php } ?>
            <div class="form-group">
              <label for="test">Product Title</label>
              <input type="text" name="test" class="form-control" autofocus="autofocus" value="<?=$product->name; ?>">
            </div>
            <div class="form-group">
              <label for="purchase_date">Purchase Date</label>
              <input type="date" name="purchase_date" class="form-control" value="<?=$product->purchase_date; ?>">
            </div>
            <div class="form-group">
              <label for="sold_date">Sold Date</label>
              <input type="date" name="sold_date" class="form-control" value="<?=$product->sold_date; ?>">
            </div>
            <div class="form-group">
              <label for="delivered_date">Delivered Date</label>
              <input type="date" name="delivered_date" class="form-control" value="<?=$product->delivered_date; ?>">
            </div>
            <div class="form-group">
              <label for="purchase_price">Purchase Price</label>
              <input type="text" name="purchase_price" class="form-control" value="<?=$product->purchase_price; ?>">
            </div>
            <div class="form-group">
              <label for="sold_price">Sold Price</label>
              <input type="text" name="sold_price" class="form-control" value="<?=$product->sold_price; ?>">
            </div>
            <div class="form-group">
              <label for="">Bin No</label>
              <select name="bin_id" class="form-control" selected="<?=$product->bin_id; ?>">
                <?php foreach($bins as $bin): ?>
                  <option value="<?php echo $bin->id; ?>" <?php if($product->bin_id == $bin->id) { echo "selected"; } ?>><?=$bin->name; ?></option>
                <?php endforeach; ?>
              </select> 
            </div>
            <div class="form-group">
              <label for="status_id">Status</label>
              <select name="status_id" class="form-control" selected="<?php echo $product->status_id; ?>">
                <?php foreach($statuses as $status): ?>
                  <option value="<?=$status->id; ?>" <?php if($product->status_id == $status->id) { echo "selected"; } ?>><?=$status->name; ?></option>
                <?php endforeach; ?>
              </select> 
            </div>
            <div class="form-group">
              <label for="">Platform</label>
              <select name="platform_id" class="form-control" selected="<?=$product->platform_id; ?>">
                <?php foreach($platforms as $platform): ?>
                  <option value="<?=$platform->id; ?>" <?php if($product->platform_id == $platform->id) { echo "selected"; } ?>><?=$platform->name; ?></option>
                <?php endforeach; ?>
              </select> 
            </div>
          </div>               
          <div class="col-md-6" >
            <div class="form-group">
              <label for="body">Description</label>
              <textarea name="body" class="form-control" cols="30" rows="10"><?=$description->body; ?></textarea>
            </div>
            <h2>Measurements</h2>
            <div class="form-group">
              <label for="weight">Weight</label>
              <input type="text" name="weight" class="form-control" value='<?php //echo $product->weight; ?>'>
            </div>
            <div class="form-group">
              <label for="length">Length</label>
              <input type="text" name="length" class="form-control" value='<?php //echo $product->length; ?>'>
            </div>
            <div class="form-group">
              <label for="width">Width</label>
              <input type="text" name="width" class="form-control" value='<?php //echo $product->width; ?>'>
            </div>
            <div class="form-group">
              <label for="height">Height</label>
              <input type="text" name="name" class="form-control" value='<?php //echo $product->height; ?>'>
            </div>
            <div class="info-box-footer clearfix">
              <div class="info-box-delete pull-left">
                <a href="delete_product.php?id=<?=$product->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
              </div>
              <div class="info-box-update pull-right ">
                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
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
