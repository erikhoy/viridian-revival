<?php
  include("includes/header.php");

  if (!$session->is_signed_in()) {
    redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect("photos.php");
  }

  $comments = Comment::find_the_comments(filter_var($_GET['id'], FILTER_SANITIZE_INT));

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
        <h1 class="page-header">Users</h1>
        <p class="bg-success"><?=$message; ?></p>
        <div class="col col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Body</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($comments as $comment) : ?>
                <tr>
                  <td>
                    <?=$comment->id; ?>
                    <div class="action_links">
                      <a href="delete_comment_photo.php?id=<?=$comment->id; ?>">Delete</a>
                    </div>
                  </td>
                  <td><?=$comment->author; ?></td>
                  <td><?=$comment->body; ?></td>
                </tr>
              <?php endforeach; ?>
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
