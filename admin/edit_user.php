<?php 
  include("includes/header.php");
  include("includes/photo_library_modal.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect("users.php");
  }

  $user = User::find_by_id(filter_var($_GET['id'], FILTER_SANITIZE_INT));

  if (isset($_POST['update'])) {
    if($user) {
      $user->username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $user->password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      $user->last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
      $user->first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
            
      if(empty($_FILES['user_image'])) {
        $user->save();
        $session->message("The user has been updated");
        redirect("users.php");
      }
        
      $user->set_file($_FILES['user_image']);
      $user->upload_photo();
      $user->save();
      $session->message("The user has been updated");
      redirect("users.php");
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
        <h1 class="page-header">Edit User</h1>
        <div class="col col-md-6 user_image_box">
          <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?=$user->image_path_and_placeholder(); ?>" width="100%" /></a>
          <br>
          <a id="user-id" href="delete_user.php?id=<?=$user->id; ?>" class="btn btn-danger">Delete User</a>
        </div>
        <div class="col col-md-6">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?=$user->username; ?>">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" value="<?=$user->password; ?>">
              </div>
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?=$user->first_name; ?>">
              </div>
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?=$user->last_name; ?>">
              </div>
              <div class="form-group">
                <input type="file" name="user_image">
              </div>
              <div class="form-group">
                <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php");
