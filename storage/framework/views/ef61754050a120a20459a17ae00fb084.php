<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sales Data Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Web Application E-Expenses Essity Indonesia">
    <meta name="author" content="Dendy Insan Nugraha">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo url('asset/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo url('asset/css/font-awesome.min.css'); ?>">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo url('asset/css/ionicons.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo url('dist/css/AdminLTE.css'); ?>">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php echo url('dist/css/skins/skin-black.min.css'); ?>">
        <link rel="shortcut icon" href="<?php echo url('dist/img/favicon.png'); ?>">
        <!-- jQuery 2.2.0 -->


    <link href="<?php echo url('asset/css/devexp/dx.common.css'); ?>" rel='stylesheet'>
    
    

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <!-- DevExpress Theme -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/24.1.7/css/dx.light.css">
    
    
    <!-- DevExpress Core -->
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/24.1.7/js/dx.all.js"></script>

</head>

<body class="hold-transition skin-black sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php echo $__env->make("includes.topbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php echo $__env->make("includes.leftmenu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
                <?php echo $__env->make("includes.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>		
        </footer>
    </div>

    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo url('asset/js/bootstrap.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo url('dist/js/app.js'); ?>"></script>

    <script src="<?php echo url('asset/js/fastclick/fastclick.js'); ?>"></script>
    <script src ="<?php echo url('asset/js/bootbox.min.js'); ?>"></script>
    <script src="<?php echo url('asset/js/moment.min.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/numeral.min.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/jszip.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/devextreme-license.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/cldr.js'); ?>"></script>   
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/cldr/event.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/cldr/supplemental.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/globalize.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/globalize/message.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/globalize/number.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/globalize/currency.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/globalize/date.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo url('asset/js/tools.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/bootstrap-filestyle.js'); ?>"></script>
</body>
</html><?php /**PATH /Users/macbookpro/Herd/crm-microapp/resources/views/layouts/backend.blade.php ENDPATH**/ ?>