<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php"); ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
  </div>
</nav>
<div id="page-wrapper">
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Sales Reports</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div id="chart_div_1" style="width: 100%; height: 500px;"></div>
    </div>
    <div class="row">
      <div id="chart_div_2" style="width: 100%; height: 500px;"></div>
    </div>
    <div class="row">
      <div id="chart_div_3" style="width: 100%; height: 500px;"></div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php");
