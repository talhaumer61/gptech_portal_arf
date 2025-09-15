<?php
    echo '
    <!doctype html>
    <html lang="en" dir="ltr">
    <head>
        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Apportion">
        <meta name="author" content="'.COPY_RIGHTS.'">
        <meta name="keywords" content="">

        <!-- App favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/skin-modes.css" rel="stylesheet" />

        <!--- FONT-ICONS CSS -->
        <link href="assets/plugins/icons/icons.css" rel="stylesheet" />
        
        <!-- SWEETALERT JS/CSS -->
        <link rel="stylesheet" href="assets/sweetalert/sweetalert_custom.css">
        <script src="assets/sweetalert/sweetalert.min.js"></script>

        <!-- PNOTIFY NOTIFICATIONS CSS -->
        <link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

        <!-- JQUERY LIBS -->
        <script src="assets/vendor/jquery/jquery.js"></script>
        
        
    </head>
    <body class="ltr app light-mode horizontal dark-menu dark-header">
    <!-- LOADER -->
    <div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>';
    ?>
    
    <script type="text/javascript">
        jQuery(document).ready(function($) {	
            <?php 
            if(isset($_SESSION['msg'])) { 
                    echo 'new PNotify({
                            title	: "'.$_SESSION['msg']['title'].'"	,
                            text	: "'.$_SESSION['msg']['text'].'"	,
                            type	: "'.$_SESSION['msg']['type'].'"	,
                            hide	: true	,
                            buttons: {
                                closer	: true	,
                                sticker	: false
                            }
                        });';
                unset($_SESSION['msg']);
            }
            ?>
        });
    </script>
    <?php 
    echo '
    <div class="page">
        <div class="page-main">';
            include_once "include/".get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/topbar.php";  
            include_once "include/".get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/sidebar.php"; 