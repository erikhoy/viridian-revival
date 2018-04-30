<?php ob_start(); ?>
<?php require_once("includes/init.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Products: Viridian Revival</title>
    <link rel="SHORTCUT ICON" href="<?php echo IMAGES_PATH.DS.'favicon.ico'; ?>">
    <link href="<?php echo ROOT_PATH.DS.'admin'.DS.'css'.DS.'styles.css'; ?>" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ROOT_PATH.DS.'admin'.DS.'css'.DS.'bootstrap.min.css'; ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="<?php //echo ROOT_PATH.DS.'admin'.DS.'css'.DS.'sb-admin.css'; ?>" rel="stylesheet"> -->
    
    <!-- Dropzone CSS -->
    <link href="<?php echo ROOT_PATH.DS.'admin'.DS.'css'.DS.'dropzone.css'; ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo ROOT_PATH.DS.'css'.DS.'lightbox.css'; ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH.DS.'js'.DS.'lightbox.js'; ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxLength = 125;
            $(".show-read-more").each(function(){
                var myStr = $(this).text();
                if($.trim(myStr).length > maxLength){
                    var newStr = myStr.substring(0, maxLength);
                    //alert(newStr);
                    var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                    $(this).empty().html(newStr);
                    // $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                    $(this).append('<span class="collapse" id="more">' + removedStr + '</span><span><a href="#more" data-toggle="collapse">... <i class="fa fa-caret-down"></i></span>');
                }
            });
            $(".read-more").click(function(){
                $(this).siblings(".more-text").append('<a href="javascript:void(0);" class="read-less">read less...</a>').contents().unwrap();
                $(this).remove();
            });
            $("a.read-less").click(function(){
                //  myStr = $(this).parent(".show-read-more").text();
                alert('less');
                // if($.trim(myStr).length > maxLength){
                //     var newStr = myStr.substring(0, maxLength);
                //     var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                //     $(this).empty().html(newStr);
                //     $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                //     $(this).append('<span class="more-text">' + removedStr + '</span>');
                // }
            });
        });
    </script>
    <style>
    .collapse.in { display: inline !important; }
</style>
</head>

<body>
    <?php include("includes/navigation.php"); ?>
    <div id="wrapper">