<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
$expense = new Expense();

if(isset($_POST['create'])) {
    
    if($expense) {
        $expense->cost = htmlspecialchars($_POST['cost'], ENT_QUOTES, 'utf-8');
        $expense->date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'utf-8');
        $expense->description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'utf-8');
        $expense->payee = htmlspecialchars($_POST['payee'], ENT_QUOTES, 'utf-8');
        
        // $user->set_file($_FILES['user_image']);

        // $user->upload_photo();
        $session->message("The expense to {$expense->payee} has been created");
        $expense->save();
        redirect("expenses.php");
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
                <h1 class="page-header">Add Expense</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col col-md-offset-3 col-md-6">
                        <div class="form-group">
                            <label for="payee">Payee</label>
                            <input type="text" name="payee" class="form-control" autofocus="autofocus" value="">
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="text" name="cost" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                            <input type="file" name="user_image">
                        </div> -->
                        <div class="form-group">
                            <input type="submit" name="create" class="btn btn-primary pull-right">
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
