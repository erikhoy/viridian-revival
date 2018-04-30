<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    if(empty($_GET['id'])) {
        redirect("listed_products.php");
    } else {
        $product = Product::find_by_id($_GET['id']);
        $description = Description::find_by_id($_GET['id']);
        $status = Status::find_by_id($product->status_id);
        $measurement = Measurement::get_measurements($_GET['id']);
        print_r($measurement);
        if(!empty($product->bin_id)) {
            $bin = Bin::find_by_id($product->bin_id);
        } else {
            $bin = Bin::find_by_id(15);
        }
        if(!empty($product->bin_id)) {
            $platform = Platform::find_by_id($product->platform_id);
        } else {
            $platform = Platform::find_by_id(6);
        }
        if(!empty($product->bin_id)) {
            $platform = Platform::find_by_id($product->platform_id);
        } else {
            $platform = Platform::find_by_id(6);
        }
        $image = Image::find_by_id($product->id);
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
                <h1><a href="index.php">Products</a> > <?php echo $product->name; ?></h1>
                <hr>
                <div class="col col-md-6">
                    <?php if($image) { ?>
                        <img class="img-responsive" src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="400">
                    <?php } ?>
                </div>
                <div class="col col-md-6">
                    <p class="lead"> Purchase Date: <?php echo date("F j, Y", strtotime($product->purchase_date)); ?></p>
                    <p class="lead"> Sold Date: <?php echo date("F j, Y", strtotime($product->sold_date)); ?></p>
                    <p class="lead"> Delivered Date: <?php echo date("F j, Y", strtotime($product->delivered_date)); ?></p>
                    <p class="lead"> Purchase Price: $<?php echo number_format($product->purchase_price, 2); ?></p>
                    <p class="lead"> Sold Price: $<?php echo number_format($product->sold_price, 2); ?></p>
                    <p class="lead"> Description: <?php if($description) { echo $description->body; } ?></p>
                    <p class="lead"> Status: <?php echo $status->name; ?></p>
                    <p class="lead"> Bin: <?php echo $bin->name; ?></p>
                    <p class="lead"> Platform: <?php echo $platform->name; ?></p>
                    <hr>
                    <h2>Measurements</h2>
                    <p class="lead"> Weight: <?php echo $measurement->weight; ?></p>
                    <p class="lead"> Length: <?php echo $measurement->length; ?></p>
                    <p class="lead"> Width: <?php echo $measurement->width; ?></p>
                    <p class="lead"> Height: <?php echo $measurement->height; ?></p>
                    <a class="btn btn-primary pull-right" href="edit_product.php?id=<?php echo $product->id; ?>">Edit</a>
                </div>
            </div>
                    
            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">
                <?php //include("includes/sidebar.php"); ?>
            </div> -->
            
        <!-- /.row -->
        </div>
<?php include("../includes/footer.php"); ?>

