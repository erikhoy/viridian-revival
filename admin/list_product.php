<?php 
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
        redirect("unlisted_products.php");
  }

  $product = Product::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));
  $bins = Bin::find_all();
  $description = new Description();
  $measurement = new Measurement();
  $image = new Image();
  if (isset($_POST['update'])) {
    if ($product) {
      $product->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $description->body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
      $description->product_id = $product->id;
      $product->list_price = filter_var($_POST['list_price'], FILTER_SANITIZE_DOUBLE_FLOAT);
      $product->bin_id = filter_var($_POST['bin_id'], FILTER_SANITIZE_INT);
      $product->status_id = 2;
      $measurement->product_id = $product->id;
      $measurement->weight = filter_var($_POST['weight'], FILTER_SANITIZE_DOUBLE_FLOAT);
      $measurement->length = filter_var($_POST['length'], FILTER_SANITIZE_INT);
      $measurement->width = filter_var($_POST['width'], FILTER_SANITIZE_INT);
      $measurement->height = filter_var($_POST['height'], FILTER_SANITIZE_INT);
      $image->image_url = filter_var($_POST['image_url'], FILTER_SANITIZE_URL);
      $image->product_id = $product->id;
      $image->set_file($_FILES['file']);
      $description->save();
      $measurement->save();
      $image->save();
      $product->save();
      redirect('listed_products.php');
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
        <h1 class="page-header">List Product</h1>
        <form action="" method="post">
          <div class="col col-md-8">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value='<?php echo $product->name; ?>'>
            </div>
            <div class="form-group col-md-4">
              <label for="list_price">List Price</label>
              <input type="text" name="list_price" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label for="bin_id">Bin Number</label><br>
              <select name="bin_id">
                <?php foreach($bins as $bin): ?>
                  <option class="form-control" value="<?php echo $bin->id; ?>"><?php echo $bin->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col col-md-4">
              <label for="image_url">Image</label>
              <input type="file" name="image_url" class="form-control" value='<?php if($image) { echo $image->image_url;  } ?>'>
            </div>
            <div class="form-group">
              <label for="body">Description</label>
              <textarea name="body" class="form-control" cols="30" rows="10" autofocus="autofocus"><?php if($description) { echo $description->body; } ?></textarea>
            </div>
            <hr>
          </div>
          <div class="col-md-4" >
            <div class="photo-info-box">
              <div class="info-box-header">
                <h4>Details <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
              </div>
              <div class="inside">
                <div class="box-inner">
                  <p class="text"><span class="glyphicon glyphicon-calendar"></span> Purchased on: <?php echo $product->purchase_date; ?></p>
                  <p class="text "><span class="glyphicon glyphicon-usd"></span> Purchase Price: <?php echo number_format($product->purchase_price, 2); ?></p>
                  <p class="text"><span class="glyphicon glyphicon-home"></span> Source: <?php echo $product->source; ?></p>
                </div>
              </div>
            </div>
            <h2>Measurements</h2>
            <div class="form-group col-md-6">
              <label for="weight">Weight</label>
              <input type="text" name="weight" class="form-control" value='<?php //echo $measurement->weight; ?>'>
            </div>
            <div class="form-group col-md-6">
              <label for="length">Length</label>
              <input type="text" name="length" class="form-control" value='<?php //echo $measurement->length; ?>'>
            </div>
            <div class="form-group col-md-6">
              <label for="width">Width</label>
              <input type="text" name="width" class="form-control" value='<?php //echo $measurement->width; ?>'>
            </div>
            <div class="form-group col-md-6">
              <label for="height">Height</label>
              <input type="text" name="height" class="form-control" value='<?php //echo $measurement->height; ?>'>
            </div>
            <div class="info-box-footer clearfix">
              <div class="info-box-delete pull-left">
                <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
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
