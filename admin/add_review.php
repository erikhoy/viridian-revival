<?php 
  include("includes/header.php");
    
  if(!$session->is_signed_in()) {
    redirect("login.php");    
  }

  $review = new Review();
  $products = Product::find_all();
 
  if(isset($_POST['create'])) { 
    if($review) {
      $review->author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
      $review->stars = filter_var($_POST['stars'], FILTER_SANITIZE_INT);
      $review->body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
      $review->product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_INT);
      $session->message("The review by {$review->author} has been created");
      $review->save();
      redirect("all_reviews.php");
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
                <h1 class="page-header">Add Review</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col col-md-offset-3 col-md-6">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" autofocus="autofocus">
                        </div>
                        <div class="form-group">
                            <label for="stars">Stars</label>
                            <input type="text" name="stars" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" class="form-control" cols="30" rows="10"><?php echo $review->body; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select type="text" name="product_id" class="form-control">
                            <?php foreach($products as $product): ?>
                                <option name="product_id" class="form-control" value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="create" class="btn btn-primary pull-right">
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
