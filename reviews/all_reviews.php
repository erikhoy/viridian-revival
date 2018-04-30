<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
    $page               = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page     = 25;
    $items_total_count  = Review::count_all();
    $paginate           = new Paginate($page, $items_per_page, $items_total_count);
    $reviews            = Review::find_all();
?>
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
                            <tbody>
                                <tr>
                                    <?php foreach($reviews as $review) { ?>
                                        <td></td>
                                        <?php $product = Product::find_by_id($review->product_id); ?>
                                            <td><?php echo $product->name; ?></td>
                                            <td><?php echo $review->body; ?></td>
                                            <td><?php echo $review->author; ?></td> 
                                        <?php } ?>
                                    <?php $products = Product::find_all(); ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                    <div class="col col-xs-12">
                        <ul class="pagination">
                            <?php 
                                if($paginate->page_total() > 1) {
                                    if($paginate->has_next()) {
                                        echo "<li class='next'><a href='all_products.php?page={$paginate->next()}'>Next</a></li>";
                                    }
                                    for($i=1;$i<=$paginate->page_total();$i++) {
                                        if($i == $page) {
                                            echo "<li class='active'><a href='all_products.php?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li><a href='all_products.php?page={$i}'>{$i}</a></li>";
                                        }
                                    }
                            
                                    if($paginate->has_previous()) {
                                        echo "<li class='previous'><a href='all_products.php?page={$paginate->previous()}'>Previous</a></li>";
                                    }
                                }
                            ?>                    
                        </ul>
                    </div>
                </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper --> 
<?php include("../includes/footer.php"); ?>