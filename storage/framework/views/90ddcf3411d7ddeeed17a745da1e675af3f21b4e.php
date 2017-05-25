    <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Window To Japan</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" type="image/ico" href="<?php echo e(url('/images/favicon.png')); ?>" />

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="styles/style.css">

<!--  Material Dashboard CSS    -->
    <link href="<?php echo e(url('/assets/css/material-dashboard.css')); ?>" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>


</head>
<body class="blank">

<!-- Simple splash screen
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Homer - Responsive Admin Theme</h1><p>Special Admin Theme for small and medium webapp with very clean and aesthetic style and feel. </p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]

<div class="color-line"></div>-->

<div class="login-container">
     <div class="row">

    <?php echo $__env->yieldContent('content'); ?>

    </div>
    <!--<div class="row">
        <div class="container-fluid">
                    <p class="copyright text-center">
                        &copy; <script>document.write(new Date().getFullYear())</script> WTJ, Nothing other than this
                    </p>
        </div>
    </div>-->
</div>


    <!-- Vendor scripts -->
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="vendor/iCheck/icheck.min.js"></script>
    <script src="vendor/sparkline/index.js"></script>

    <!-- App scripts -->
    <script src="scripts/homer.js"></script>

    
    <script src="<?php echo e(url('/assets/js/material.min.js')); ?>" type="text/javascript"></script>

    <!-- Material Dashboard javascript methods -->
    <script src="<?php echo e(url('/assets/js/material-dashboard.js')); ?>"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo e(url('/assets/js/bootstrap-notify.js')); ?>"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo e(url('/assets/js/demo.js')); ?>"></script>
    
</body>
</html>
