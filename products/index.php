<?php require_once('includes/header.php'); ?>
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
        <div class="row">
            <div class="col col-lg-offset-1 col-lg-10">
                <h1 class="page-header">Products</h1>
                <?php foreach($products as $product) { ?>
                    <?php $description = Description::find_by_id($product->id); ?>
                    <?php $maxLength = 125; ?>
                    <?php if(strlen($description->body) >= $maxLength) { ?>
                        <?php $stringLength = strlen($description->body); ?>
                        <?php $descript1 = substr($description->body, 0, $maxLength); ?>
                        <?php $descript2 = substr($description->body, $maxLength, $stringLength); ?>
                        <?php $description = $descript1 . '<span class="collapse" id="more'.$product->id.'">'.$descript2.'</span><span><a href="#more'.$product->id.'" data-toggle="collapse">... <i class="fa fa-caret-down"></i></a></span>'; ?>
                    <?php } else { ?>
                        <?php $description = $description->body; ?>
                    <?php } ?>
                    <?php $image = Image::find_by_id($product->id); ?>
                    <div class="col col-lg-6">
                        <div class="product">
                            <div class="col col-xs-12 col-sm-4">
                                <a href="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" data-lightbox="image-1" data-title="<?php echo $product->name; ?>"><img src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" alt="<?php echo $product->name; ?>" class="listed_thumbnails"></a>
                            </div>
                            <div class="col col-xs-12 col-sm-8">
                                <a href="view_product.php?id=<?php echo $product->id; ?>"><strong><?php echo $product->name; ?></strong></a>
                                <p><?php echo $description; ?></p>
                                <p><?php echo "$".number_format($product->list_price, 2); ?></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col col-xs-offset-1 col-xs-10">
                <ul class="pagination">
                    <?php 
                        if($paginate->page_total() > 1) {
                            if($paginate->has_next()) {
                                echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                            }
                            for($i=1;$i<=$paginate->page_total();$i++) {
                                if($i == $page) {
                                    echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                                } else {
                                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                                }
                            }
                            if($paginate->has_previous()) {
                                echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
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