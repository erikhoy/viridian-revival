<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    $descriptions = Description::find_all();
    $images = Image::find_all();
    print_r($descriptions);
    echo "<br>";
    print_r($images);
    echo "<br>";
    foreach($descriptions as $description) {
        $description->product_id = $description->id;
        echo $description->id."<br>".$description->product_id."<br>";
        $description->body = $database->escape_string($description->body);
        $description->update();
    }
    foreach($images as $image) {
        $image->product_id = $image->id;
        echo $image->id."<br>".$image->product_id."<br>";
        $image->update();
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
        
        <!-- /.row -->
    </div>        
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>