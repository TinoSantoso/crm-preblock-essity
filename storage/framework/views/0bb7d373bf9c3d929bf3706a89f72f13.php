<!DOCTYPE html>
<html lang="en">
<head>
   <?php echo $__env->make("includes.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="hold-transition skin-black sidebar-collapse sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
    <?php echo $__env->make("includes.topbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Left side column. contains the logo and sidebar -->
    <?php echo $__env->make("includes.leftmenu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <?php echo $__env->yieldContent("content"); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
        <?php echo $__env->make("includes.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>		
  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar 
  <div class="control-sidebar-bg"></div>-->
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Bootstrap 3.3.6 -->
<script src="<?php echo url('asset/js/bootstrap.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo url('dist/js/app.js'); ?>"></script>

<!-- FastClick -->
<script src="<?php echo url('asset/js/fastclick/fastclick.js'); ?>"></script>
<script src ="<?php echo url('asset/js/bootbox.min.js'); ?>"></script>
<script src="<?php echo url('asset/js/moment.min.js'); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo url('asset/js/numeral.min.js'); ?>"></script>
 <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/jszip.js'); ?>"></script>
 <script type="text/javascript" language="javascript" src="<?php echo url('asset/js/devexp/dx.all.js'); ?>"></script>
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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
<?php /**PATH /Users/macbookpro/Herd/crm-microapp/resources/views/layouts/mains.blade.php ENDPATH**/ ?>