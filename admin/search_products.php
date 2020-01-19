<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  $search_results = NULL;
  if (isset($_POST['search'])) {
    $search_results = Product::search_products($_POST['name']);
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
      <h1 class="page-header">Search Products</h1>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" name="name" class="form-control" autofocus="autofocus" value="">
          </div>
          <div class="form-group">
            <label for="cost">Purchase Date</label>
            <input type="text" name="daterange"  class="form-control" value="01/01/2015 - 01/31/2015" />
          </div>
          <div class="form-group">
            <input type="submit" name="search" class="btn btn-primary pull-right">
          </div>
        </form>
      </div>
      <div class="col col-lg-8">
        <?php if ($search_results) { ?>
          <h3>Search Results</h3>
          <?php
            foreach ($search_results as $search_result) {
              $image = Image::find_by_id($search_result->id);
              $bin_id = 1;
              if (!empty($search_result->bin_id)) {
                $bin_id = $search_result->bin_id;
              }
              $bin = Bin::find_by_id($bin_id);
          ?>
              <div class="clearfix">
                <a href="<?=IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" data-lightbox="image-1" data-title="<?=$search_result->name; ?>"><img src="<?=IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100"></a>
                <a href="view_product.php?id=<?=$search_result->id; ?>"><?=$search_result->name; ?></a>
              </div>
          <?php
            }
          ?>
        <?php } ?>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->        
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php");
