<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
    $page               = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page     = 25;
    $items_total_count  = Expense::count_all();
    $paginate           = new Paginate($page, $items_per_page, $items_total_count);
    $expenses           = Expense::find_all(); 
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
                <h1 class="page-header">Expenses</h1>
                <?php if($message != "") { ?>
                    <p class="bg-success"><?php echo $message; ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12">
                <ul class="pagination">
                    <?php 
                        if($paginate->page_total() > 1) {
                            if($paginate->has_next()) {
                                echo "<li class='next'><a href='expenses.php?page={$paginate->next()}'>Next</a></li>";
                            }
                            for($i=1;$i<=$paginate->page_total();$i++) {
                                if($i == $page) {
                                    echo "<li class='active'><a href='expenses.php?page={$i}'>{$i}</a></li>";
                                } else {
                                    echo "<li><a href='expenses.php?page={$i}'>{$i}</a></li>";
                                }
                            }    
                            if($paginate->has_previous()) {
                                echo "<li class='previous'><a href='expenses.php?page={$paginate->previous()}'>Previous</a></li>";
                            }
                        }
                    ?>                    
                </ul>
            </div>
        </div>
        <div class="row">
                <div class="col col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Payee</th>
                                <th>Cost</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($expenses as $expense): ?>
                                <tr>
                                    <td><?php echo $expense->payee; ?></td>
                                    <td><?php echo "$".number_format($expense->cost, 2); ?></td>
                                    <td><?php echo $expense->description; ?></td>
                                    <td><?php echo date("n.j.y", strtotime($expense->date)); ?></td>
                                    <td><?php echo $bin->name; ?></td>
                                    <td>
                                        <a href="edit_product.php?id=<?php echo $product->id; ?>">Edit</a>
                                        <br>
                                        <a href="cancel_product.php?id=<?php echo $product->id; ?>">Cancel</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
                                echo "<li class='next'><a href='listed_products.php?page={$paginate->next()}'>Next</a></li>";
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
<?php include("includes/footer.php"); ?>