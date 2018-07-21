<?php $page = "Contact"; ?>
<?php include("includes/header.php"); ?>
<?php 
if(isset($_POST['submit'])) {
    $to         = "erik@viridianrevival.com";
    $author     = $_POST['name'];
    $email      = $_POST['email'];
    $subject    = "Website Contact Form";
    $body      	= "<html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>Message</th>
                                </tr>
                                <tr>
                                    <td>".$author."</td>
                                    <td>".$_POST['msg']."</td>
                                </tr>
                            </table>
                        </body>
                    </html>";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <'.$_POST['email'].'>' . "\r\n";

    //$body = wordwrap($_POST['msg'], 70);

    if(mail($to,$subject,$body,$headers)) {
        $session->message("Thank you! Your message has been sent.");
    } else {
        $session->message("There was a problem. Please try again.");
    }
}
?>
<!-- Navigation -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Contact Us</h1>
                <?php if($message != "") { ?>
                    <p class="bg-success"><?php echo $message; ?></p>
                <?php } ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col col-md-offset-3 col-md-6">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" autofocus="autofocus" value="">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="msg">Message</label>
                            <textarea name="msg" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary pull-right">
                        </div>
                        <div class="g-recaptcha" data-sitekey="6Lfsw1EUAAAAANcUu5qwt6-3o9wa2QnCwVBHlQ4h"></div>
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