<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  $photos = Photo::find_all();
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
        <h1 class="page-header">Photos</h1>
        <p class="bg-success"><?=$message; ?></p>
        <div class="col col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Photo</th>
                <th>ID</th>
                <th>Filename</th>
                <th>Title</th>
                <th>Size</th>
                <th>Comments</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($photos as $photo) {
                  $filename = SITE_ROOT.DS.'admin'.DS.'images'.DS.$photo->filename;
                  $comments = Comment::find_the_comments($photo->id);
              ?>
                  <tr>
                    <td>
                      <img src="<?=$photo->picture_path(); ?>" width=62 />
                      <div class="action_links">
                        <a class="delete_link" href="delete_photo.php?id=<?=$photo->id; ?>">Delete</a>
                        <a href="edit_photo.php?id=<?=$photo->id; ?>">Edit</a>
                        <a href="../photo.php?id=<?=$photo->id; ?>">View</a>
                      </div>
                    </td>
                    <td><?=$photo->id; ?></td>
                    <td><?=$photo->filename; ?></td>
                    <td><?=$photo->title; ?></td>
                    <td><?=$photo->size; ?></td>
                    <td><a href="photo_comment.php?id=<?php echo $photo->id; ?>"><?=count($comments); ?></a></td>
                  </tr>
              <?php
                }
              ?>
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

<?php include("includes/footer.php");
