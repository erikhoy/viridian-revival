<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    if(empty($_GET['id'])) {
        redirect("shipped_products.php");
    } else {
        $product = Product::find_by_id($_GET['id']);
        $platforms = Platform::find_all();
        if(isset($_POST['update'])) {
            if($product) {
                $product->name = $_POST['name'];
                $product->delivered_date = date("Y-m-d", strtotime($_POST['delivered_date']));
                $product->status_id = 6;
                $session->message("The product {$product->name} has been completed");
                $product->save();
                redirect('shipped_products.php');
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
                <h1 class="page-header">Complete Product</h1>
                <form action="" method="post">
                    <div class="col col-md-8">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value='<?php echo $product->name; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="delivered_date">Delivered Date</label>
                            <input type="date" name="delivered_date" class="form-control datepicker" autofocus="autofocus">
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text"><span class="glyphicon glyphicon-calendar"></span> </p>
                                    <p class="text "><span class="data photo_id_box"></span></p>
                                    <p class="text"><span class="data"></span></p>
                                    <p class="text"><span class="data"></span></p>
                                    <p class="text"><span class="data"></span></p>
                                </div>
                                <div class="info-box-footer clearfix">
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