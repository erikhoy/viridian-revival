<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
if(empty($_GET['id'])) {
    redirect("unlisted_products.php");
} else {
    $product = Product::find_by_id($_GET['id']);

    if(isset($_POST['update'])) {
        if($product) {
            $product->name = $_POST['name'];
            $product->sold_price = $_POST['sold_price'];
            $product->sold_date = $_POST['sold_date'];
            $product->platform_id = $_POST['platform_id'];
            $product->status_id = 3;
            $product->transaction_fee = Product::get_transaction_fee($_POST['platform_id']);
            $session->message("The product {$product->name} has been sold");
            $product->save();
            redirect('sold_products.php');
        }
    }
}
$platforms = Platform::find_all();
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
                <h1 class="page-header">Sell Product</h1>
                <form action="" method="post">
                    <div class="col col-md-8">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value='<?php echo $product->name; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="sold_price">Sold Price</label>
                            <input type="text" name="sold_price" class="form-control" value='<?php echo $product->sold_price; ?>' autofocus="autofocus">
                        </div>
                        <div class="form-group">
                            <label for="sold_date">Sold Date</label>
                            <input type="date" name="sold_date" class="form-control datepicker" value='<?php echo $product->sold_date; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="platform_id">Platform</label>
                            <select name="platform_id">
                                <?php foreach($platforms as $platform): ?>
                                    <option class="form-control" value="<?php echo $platform->id; ?>"><?php echo $platform->name; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                                    <p class="text "><span class="glyphicon glyphicon-usd"></span> Purchase Price: <?php echo number_format($product->purchase_price, 2); ?></p>
                                    <p class="text "><span class="glyphicon glyphicon-usd"></span> List Price: <?php echo number_format($product->list_price, 2); ?></p>
                                    <p class="text"><span class="glyphicon glyphicon-home"></span> Source: <?php echo $product->source; ?></p>
                                    <p class="text"><span class="glyphicon glyphicon-home"></span> Bin No: <?php echo $product->bin_id; ?></p>
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