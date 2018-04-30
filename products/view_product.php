<?php include("includes/header.php"); ?>
<?php 
    if(empty($_GET['id'])) {
        redirect("listed_products.php");
    } else {
        $product = Product::find_by_id($_GET['id']);
        $status = Status::find_by_id($product->status_id);
        $description = Description::find_by_id($product->id);
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
                    <p class="lead"> <strong>List Price:</strong> $<?php echo number_format($product->list_price, 2); ?></p>
                    <p class="lead"> <strong>Description:</strong> <?php echo $description->body; ?></p>
                </div>
            </div>
                    
            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">
                <?php //include("includes/sidebar.php"); ?>
            </div> -->
            
        <!-- /.row -->
        </div>
<?php include("../includes/footer.php"); ?>

