<?php
  require_once("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  $status_id = 4;
  $page = !empty($_GET['page']) ? (int)filter_var($_GET['page'], FILTER_SANITIZE_INT) : 1;
  $items_per_page = 25;
  $items_total_count = Product::count_products_by_status($status_id);
  $paginate = new Paginate($page, $items_per_page, $items_total_count);
  $products = Product::find_products_by_status($status_id, $page, $items_per_page, $items_total_count); 
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("../admin/includes/top_nav.php"); ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("../admin/includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
  </div>
</nav>
<div id="page-wrapper">
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Shipped Products</h1>
        <?php if ($message != "") { ?>
          <p class="bg-success"><?=$message; ?></p>
        <?php } ?>
        <div class="col col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Sold Date</th>
                <th>Sold Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products as $product) { ?>
                <?php $image = Description::find_description_by_product_id($product->id); ?>
                <?php $image = Image::find_image_by_product_id($product->id); ?>
                <tr>
                  <td>
                    <a href="<?=IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" data-lightbox="image-1" data-title="<?=$product->name; ?>">
                      <img src="<?=IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100">
                    </a>
                  </td>
                  <td><a href="view_product.php?id=<?php echo $product->id; ?>"><?=product->name; ?></a></td>
                  <td><?=date("n.j.y", strtotime($product->sold_date)); ?></td>
                  <td><?="$".number_format($product->sold_price, 2); ?></td>
                  <td>
                    <a href="edit_product.php?id=<?=$product->id; ?>">Edit</a>
                    <br>
                    <a href="complete_product.php?id=<?=$product->id; ?>">Complete</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col col-xs-12">
        <ul class="pagination">
          <?php 
            if ($paginate->page_total() > 1) {
              if ($paginate->has_next()) {
                echo "<li class='next'><a href='sold_products.php?page={$paginate->next()}'>Next</a></li>";
              }
              for ($i=1; $i<=$paginate->page_total(); $i++) {
                if ($i == $page) {
                  echo "<li class='active'><a href='sold_products.php?page={$i}'>{$i}</a></li>";
                } else {
                  echo "<li><a href='sold_products.php?page={$i}'>{$i}</a></li>";
                }
              }
              if ($paginate->has_previous()) {
                echo "<li class='previous'><a href='sold_products.php?page={$paginate->previous()}'>Previous</a></li>";
              }
            }
          ?>                    
        </ul>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php");
