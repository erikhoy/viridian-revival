<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo ROOT_PATH . DS . 'index.php'; ?>"><img class="logo" src='<?php echo IMAGES_PATH . DS . "viridian_revival_banner.png"; ?>'></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav pull-right">
        <li><a href="<?php echo ROOT_PATH . DS . 'index.php'; ?>">Home</a></li>
        <li><a href="<?php echo ROOT_PATH . DS . 'products' . DS . 'index.php'; ?>">Products</a>
        <li><a href="<?php echo ROOT_PATH . DS . 'contact.php'; ?>">Contact</a></li>
        <li><a href="<?php echo ROOT_PATH . DS . 'admin/index.php'; ?>">Admin</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>