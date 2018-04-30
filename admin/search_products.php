<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
$search_results = NULL;
if(isset($_POST['search'])) {
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
                <!--         <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="user_image">
                         </div> -->
                    <div class="form-group">
                        <input type="submit" name="search" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
            <div class="col col-lg-8">
                <?php if($search_results) { ?>
                    <h3>Search Results</h3>
                    <?php foreach($search_results as $search_result): ?>
                        <?php $image = Image::find_by_id($search_result->id); ?>
                        <?php $bin_id = 1; ?>
                        <?php if(!empty($search_result->bin_id)) {
                            $bin_id = $search_result->bin_id;
                        } ?>
                        <?php $bin = Bin::find_by_id($bin_id); ?>
                        <div class="clearfix">
                            <a href="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" data-lightbox="image-1" data-title="<?php echo $search_result->name; ?>"><img src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100"></a>
                            <a href="view_product.php?id=<?php echo $search_result->id; ?>"><?php echo $search_result->name; ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->        
</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>