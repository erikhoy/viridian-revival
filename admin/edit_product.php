<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    if(empty($_GET['id'])) {
        redirect("listed_products.php");
    } else {
        $product = Product::find_by_id($_GET['id']);
        $description = Description::find_by_id($_GET['id']);
        $statuses = Status::find_all();
        $bins = Bin::find_all();
        $platforms = Platform::find_all();
        $product->name = $database->escape_string($product->name);
        $image = Image::find_by_id($_GET['id']);
        
        if(isset($_POST['update'])) {
            if($product) {
                $product->name              = $database->escape_string($_POST['test']);
                $product->purchase_price    = $_POST['purchase_price'];
                $product->sold_price        = $_POST['sold_price'];
                $product->purchase_date     = date("Y-m-d", strtotime($_POST['purchase_date']));
                $product->sold_date         = date("Y-m-d", strtotime($_POST['sold_date']));
                $product->delivered_date    = date("Y-m-d", strtotime($_POST['delivered_date']));
                $description->body          = $database->escape_string($_POST['body']);
                $product->status_id         = $_POST['status_id'];
                $product->bin_id            = $_POST['bin_id'];
                $product->platform_id       = $_POST['platform_id'];
                //$product->image_url = $_POST['image_url'];
                $session->message("The product {$product->name} has been updated");
                echo "<br>".$_POST['test'];
                echo "<br>name: ".$product->name;
                $product->save();
                redirect("view_product.php?id={$product->id}");
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
                <h1 class="page-header">Edit Product</h1>
                <form action="" method="post" class="clearfix">
                    <div class="col col-md-6">
                        <?php if($image) { ?>
                            <img class="img-responsive" src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100">
                        <?php } ?>
                        <div class="form-group">
                            <label for="test">Product Title</label>
                            <input type="text" name="test" class="form-control" autofocus="autofocus" value="<?php echo $product->name; ?>">
                        </div>
                        <!-- <div class="form-group">
                            <a class="thumbnail" href="#"><img src="<?php //echo $photo->picture_path(); ?>" /></a>
                        </div> -->
                        <div class="form-group">
                            <label for="purchase_date">Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control" value="<?php echo $product->purchase_date; ?>">
                        </div>
                        <div class="form-group">
                            <label for="sold_date">Sold Date</label>
                            <input type="date" name="sold_date" class="form-control" value="<?php echo $product->sold_date; ?>">
                        </div>
                        <div class="form-group">
                            <label for="delivered_date">Delivered Date</label>
                            <input type="date" name="delivered_date" class="form-control" value="<?php echo $product->delivered_date; ?>">
                        </div>
                        <div class="form-group">
                            <label for="purchase_price">Purchase Price</label>
                            <input type="text" name="purchase_price" class="form-control" value="<?php echo $product->purchase_price; ?>">
                        </div>
                        <div class="form-group">
                            <label for="sold_price">Sold Price</label>
                            <input type="text" name="sold_price" class="form-control" value="<?php echo $product->sold_price; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Bin No</label>
                            <select name="bin_id" class="form-control" selected="<?php echo $product->bin_id; ?>">
                            <?php foreach($bins as $bin): ?>
                                <option value="<?php echo $bin->id; ?>" <?php if($product->bin_id == $bin->id) { echo "selected"; } ?>><?php echo $bin->name; ?></option>
                            <?php endforeach; ?>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="status_id">Status</label>
                            <select name="status_id" class="form-control" selected="<?php echo $product->status_id; ?>">
                            <?php foreach($statuses as $status): ?>
                                <option value="<?php echo $status->id; ?>" <?php if($product->status_id == $status->id) { echo "selected"; } ?>><?php echo $status->name; ?></option>
                            <?php endforeach; ?>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="">Platform</label>
                            <select name="platform_id" class="form-control" selected="<?php echo $product->platform_id; ?>">
                            <?php foreach($platforms as $platform): ?>
                                <option value="<?php echo $platform->id; ?>" <?php if($product->platform_id == $platform->id) { echo "selected"; } ?>><?php echo $platform->name; ?></option>
                            <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>               
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" class="form-control" cols="30" rows="10"><?php echo $description->body; ?></textarea>
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
                                <a href="delete_product.php?id=<?php echo $product->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
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
<?php include("includes/footer.php"); ?>