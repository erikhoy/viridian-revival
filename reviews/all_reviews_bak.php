<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reviews</h1>
                    <p class="bg-success"><?php echo $message; ?></p>
                    <div class="col col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Review</th>
                                    <th>Author</th>
                                </tr>
                            </thead>
                            <?php $products = Product::find_all(); ?>
                            <tbody>
                                <?php foreach($products as $product) { ?>
                                    <?php //$filename = SITE_ROOT.DS.'admin'.DS.'images'.DS.$photo->filename; ?>
                                    <?php $review = Review::find_the_reviews($product->id); ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $product->name; ?></td>
                                        <td>
                                            <?php 
                                                if(!empty($review->body)) {
                                                    echo $review->body;
                                                } 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(!empty($review->body)) {
                                                    echo $review->body;
                                                } 
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper --> 
<?php include("../includes/footer.php"); ?>