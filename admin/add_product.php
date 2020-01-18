<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    $product = new Product();
    $description = new Description();
    $bins = Bin::find_all();
    if(isset($_POST['create'])) {
        if($product) {
            $product->name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
            $product->purchase_date = htmlspecialchars($_POST['purchase_date'], ENT_QUOTES, 'utf-8');
            $product->purchase_price = htmlspecialchars($_POST['purchase_price'], ENT_QUOTES, 'utf-8');
            $product->source = htmlspecialchars($_POST['source'], ENT_QUOTES, 'utf-8');
            $product->platform_id = 6;
            $product->status_id = 1;
            $product->bin_id = htmlspecialchars($_POST['bin_id'], ENT_QUOTES, 'utf-8');
            $session->message("The product {$product->name} has been created");
            $product->save();
	}
	if($description) {
            $description->body = "";
    	    $description->product_id = $database->the_insert_id();
    	    $description->save();
            redirect("unlisted_products.php");
            
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
                <h1 class="page-header">Add Product</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col col-md-offset-3 col-md-6">
                        <div class="form-group">
                            <label for="name">Product Title</label>
                            <input type="text" name="name" class="form-control" autofocus="autofocus">
                        </div>
                        <div class="form-group">
                            <label for="purchase_date">Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control datepicker">
                        </div>
                        <div class="form-group">
                            <label for="purchase_price">Purchase Price</label>
                            <input type="text" name="purchase_price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="source">Source</label>
                            <input type="text" name="source" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bin_id">Bin Number</label><br>
                            <select name="bin_id">
                                <?php foreach($bins as $bin): ?>
                                    <option class="form-control" value="<?php echo $bin->id; ?>"><?php echo $bin->name; ?></option>
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
<?php include("includes/footer.php"); ?>
