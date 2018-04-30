<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
if(empty($_GET['id'])) {
    redirect("sold_products.php");
} else {
    $product = Product::find_by_id($_GET['id']);
    $platforms = Platform::find_all();
    if(isset($_POST['update'])) {
        if($product) {
            $product->name = $_POST['name'];
            $description->body = $database->escape_string($_POST['body']);
            $product->shipping = $_POST['shipping'];
            $product->actual_shipping = $_POST['actual_shipping'];
            $product->platform_id = $_POST['platform_id'];
            $product->status_id = 4;
            $product->bin_id = 14;
            $session->message("The product {$product->name} has been shipped");
            $product->save();
            redirect('sold_products.php');
        }
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
                <?php //print_r($product); ?>
                <?php //$name = Product::escape_string($product->name); ?>
                <form action="" method="post">
                    <div class="col col-md-8">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value='<?php echo $product->name; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="shipping">Shipping</label>
                            <input type="text" name="shipping" class="form-control" value='<?php echo $product->shipping; ?>' autofocus="autofocus">
                        </div>
                        <div class="form-group">
                            <label for="actual_shipping">Actual Shipping</label>
                            <input type="text" name="actual_shipping" class="form-control datepicker" value='<?php echo $product->actual_shipping; ?>'>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="photo-info-box">
                            <div class="info-box-header">
                               <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text"><span class="glyphicon glyphicon-calendar"></span> Purchased on: <?php echo $product->purchase_date; ?></p>
                                    <p class="text"><span class="glyphicon glyphicon-calendar"></span> Sold on: <?php echo $product->sold_date; ?></p>
                                    <p class="text"><span class="glyphicon glyphicon-usd"></span> Purchase Price: <?php echo number_format($product->purchase_price, 2); ?></p>
                                    <p class="text "><span class="glyphicon glyphicon-usd"></span> Sold Price: <?php echo number_format($product->sold_price, 2); ?></p>
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
<?php include("includes/footer.php"); ?>