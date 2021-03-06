<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(env('APP_NAME')); ?></title>
  <link rel="icon" type="image/x-icon" href="<?php echo e(url('public/favicon.ico')); ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/dist/css/AdminLTE.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/dist/css/skins/_all-skins.min.css')); ?>">
  <!-- Morris chart -->
  <!--<link rel="stylesheet" href="<?php echo e(url('adminlte/bower_components/morris.js/morris.css')); ?>">-->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/jvectormap/jquery-jvectormap.css')); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/plugins/iCheck/all.css')); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/select2/dist/css/select2.min.css')); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(url('public/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php $__env->startSection('css'); ?>
  <?php echo $__env->yieldSection(); ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="content-wrapper">
      <?php echo $__env->yieldContent('content'); ?>
  </div>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(url('public/adminlte/bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(url('public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- Morris.js charts -->
<!--<script src="<?php echo e(url('adminlte/bower_components/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(url('adminlte/bower_components/morris.js/morris.min.js')); ?>"></script>-->
<!-- Sparkline -->
<script src="<?php echo e(url('public/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(url('public/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(url('public/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(url('public/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')); ?>"></script>
<!-- Select2 -->
<script src="<?php echo e(url('public/adminlte/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- InputMask -->
<script src="<?php echo e(url('public/adminlte/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(url('public/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(url('public/adminlte/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<!-- DataTables -->
<script src="<?php echo e(url('public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>

<!-- daterangepicker -->
<script src="<?php echo e(url('public/adminlte/bower_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(url('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(url('public/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo e(url('public/adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo e(url('public/adminlte/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(url('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo e(url('public/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo e(url('public/adminlte/plugins/iCheck/icheck.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(url('public/adminlte/bower_components/fastclick/lib/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(url('public/adminlte/dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php echo e(url('adminlte/dist/js/pages/dashboard.js')); ?>"></script>-->
<!-- ChartJS -->
<script src="<?php echo e(url('public/adminlte/bower_components/chart.js/Chart.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(url('public/adminlte/dist/js/demo.js')); ?>"></script>
<!-- CK Editor -->
<script src="<?php echo e(url('public/adminlte/bower_components/ckeditor/ckeditor.js')); ?>"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })



  })

  $("#listpekerja").load("<?php echo e(url('/master/data_pekerja/list/0')); ?>");
  $("#listMitra").load("<?php echo e(url('/master/mitra_kerja/list/0')); ?>");

</script>

<script language="javascript" type="text/javascript">
        jQuery(function(){
            $("#frmKL").submit(function(){
                var post_data = $(this).serialize();
                var form_action = $(this).attr("action");
                var form_method = $(this).attr("method");
                $.ajax({
                     type : form_method,
                     url : form_action,
                     cache: false,
                     data : post_data,
                     success : function(x){
                         alert(x);
                         window.location = "<?php echo e(url('/master/kategori_layanan')); ?>";
                     },
                     error : function(){
                        alert("Error");
                     }
                });
                return false;
             });
        });
</script>
 <?php $__env->startSection('js'); ?>

  <?php echo $__env->yieldSection(); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\sdhc\resources\views/layouts/app.blade.php ENDPATH**/ ?>