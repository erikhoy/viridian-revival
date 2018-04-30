<?php include("includes/header.php"); ?>
<?php
    $status_id          = 2;
    $page               = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page     = 25;
    $items_total_count  = Product::count_products_by_status($status_id);
    $paginate           = new Paginate($page, $items_per_page, $items_total_count);
    $products           = Product::find_products_by_status($status_id, $page, $items_per_page, $items_total_count); 
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <div class="row">
            <div class="col col-lg-offset-1 col-lg-10">
                <h1 class="page-header">Products</h1>
                <p class="bg-success"><?php echo $message; ?></p>
                <table class="table table-hover">
                    <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Asking Price</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product) { ?>
                                <?php $description = Description::find_by_id($product->id); ?>
                                <?php $image = Image::find_by_id($product->id); ?>
                                <tr>
                                    <td><a href="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" data-lightbox="image-1" data-title="<?php echo $product->name; ?>"><img src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" alt="<?php echo $product->name; ?>" class="listed_thumbnails"></a></td>
                                    <td><?php echo $product->name; ?></td>
                                    <td><?php echo $description->body; ?></td>
                                    <td><?php echo "$".number_format($product->list_price, 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col col-xs-offset-1 col-xs-10">
                <ul class="pagination">
                    <?php 
                        if($paginate->page_total() > 1) {
                            if($paginate->has_next()) {
                                echo "<li class='next'><a href='all_products.php?page={$paginate->next()}'>Next</a></li>";
                            }
                            for($i=1;$i<=$paginate->page_total();$i++) {
                                if($i == $page) {
                                    echo "<li class='active'><a href='listed_products.php?page={$i}'>{$i}</a></li>";
                                } else {
                                    echo "<li><a href='listed_products.php?page={$i}'>{$i}</a></li>";
                                }
                            }
                            if($paginate->has_previous()) {
                                echo "<li class='previous'><a href='listed_products.php?page={$paginate->previous()}'>Previous</a></li>";
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