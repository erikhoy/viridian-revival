<?php require_once("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
    $status_id          = 6;
    $page               = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page     = 25;
    $items_total_count  = Product::count_products_by_status($status_id);
    $paginate           = new Paginate($page, $items_per_page, $items_total_count);
    $products           = Product::find_products_by_status($status_id, $page, $items_per_page, $items_total_count); 
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <?php include("../admin/includes/top_nav.php"); ?>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("../admin/includes/side_nav.php"); ?>
        <!-- /.navbar-collapse -->
    </div>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Listing Price</h1>
                <?php 
                    $etsy_url = "https://openapi.etsy.com/v2/listings/623571181?api_key=5imxq0ekjzgvursvpq5gujx7&includes=Images, ShippingInfo";
                    $etsy_json = file_get_contents($etsy_url);
                    $etsy_array = json_decode($etsy_json, true);
                    // $etsy_url_2 = "https://openapi.etsy.com/v2/listings/602222194/transactions?api_key=5imxq0ekjzgvursvpq5gujx7";
                    // $etsy_json_2 = file_get_contents($etsy_url_2);
                    // $etsy_array_2 = json_decode($etsy_json_2, true);
                    $etsy_url_3 = "https://openapi.etsy.com/v2/listings/623571181?/shipping/info?api_key=5imxq0ekjzgvursvpq5gujx7";
                    $etsy_json_3 = file_get_contents($etsy_url_3);
                    $etsy_array_3 = json_decode($etsy_json_3, true);
                    $price = $etsy_array['results'][0]['price'];
                    $title = $etsy_array['results'][0]['title'];
                    $url = $etsy_array['results'][0]['Images'][0]['url_fullxfull'];
                    // $sell_price = $etsy_array_2['results'][0]['price'];
                    $shipping = $etsy_array_3['results'][0]['ShippingInfo']['price'];
                    echo "<img src=".$url." width='200'>".$title."<br>$".$price."<br>".$sell_price."<br>".$shipping;
                ?>
                <?php if($message != "") { ?>
                    <p class="bg-success"><?php echo $message; ?></p>
                <?php } ?>
                <div class="col col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Purchase Price</th>
                                <th>Sold Price</th>
                                <th>Purchase Date</th>
                                <th>Sold Date</th>
                                <th>Profit Margin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product) { ?>
                                <?php $image = Image::find_by_id($product->id); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" data-lightbox="image-1" data-title="<?php echo $product->name; ?>"><img src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100">
                                        </a>
                                    </td>
                                    <td><a href="view_product.php?id=<?php echo $product->id; ?>"><?php echo $product->name; ?></a></td>
                                    <td><?php echo "$".number_format($product->purchase_price, 2); ?></td>
                                    <td><?php echo "$".number_format($product->sold_price, 2); ?></td>
                                    <td><?php echo date("n.j.y", strtotime($product->purchase_date)); ?></td>
                                    <td><?php echo date("n.j.y", strtotime($product->sold_date)); ?></td>
                                    <td><?php echo number_format($product->get_profit_margin($product->id), 2)."%"; ?></td>
                                    <td>
                                        <a href="edit_product.php?id=<?php echo $product->id; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
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
                                echo "<li class='next'><a href='sold_products.php?page={$paginate->next()}'>Next</a></li>";
                            }
                            for($i=1;$i<=$paginate->page_total();$i++) {
                                if($i == $page) {
                                    echo "<li class='active'><a href='completed_products.php?page={$i}'>{$i}</a></li>";
                                } else {
                                    echo "<li><a href='completed_products.php?page={$i}'>{$i}</a></li>";
                                }
                            }
                            if($paginate->has_previous()) {
                                echo "<li class='previous'><a href='completed_products.php?page={$paginate->previous()}'>Previous</a></li>";
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
<?php include("includes/footer.php"); ?>