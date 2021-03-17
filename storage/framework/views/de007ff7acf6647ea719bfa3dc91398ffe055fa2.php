<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
<?php
    use App\Http\Controllers\RoleGroupDetailController;
    use Illuminate\Support\Facades\URL;
?>
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <?php if(Session::get('picture')!='-'): ?>
      <img src="<?php echo url('/');?>/public/adminlte/dist/img/profile/<?php echo isset($_SESSION['picture'])?$_SESSION['picture']:"";?>" class="user-image" alt="User Image">
      <?php else: ?>
      <img src="<?php echo e(url('public/adminlte/dist/profile-icon.png')); ?>" class="user-image" alt="User Image">
      <?php endif; ?>
    </div>
    <div class="pull-left info">
      <p><?php echo e(env('APP_NAME')); ?></p>
    </div>
  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">

    <!--<li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>-->        
    <?php        
        
        if(isset($_SESSION['login_status'])){
        //foreach(Session::get('parent_menu') as $mUtama)
        //{
    ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-address-book"></i> <span>MASTER</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <?php
                  /*foreach(Session::get('role_submenu') as $subMenu)
                  {
                      if($mUtama->modul_category == $subMenu->modul_category)
                      {
                          $roleAccess = RoleGroupDetailController::get_access_crud($subMenu->modul_alias);*/
            ?>
            <!--<li><a href="<?php //echo url('/').$subMenu->route_link;?>"><i class="fa fa-circle-o"></i><?php //echo $subMenu->modul_alias;?></a></li>-->
            <li><a href="<?php echo e(url('/').'/master/user'); ?>"><i class="fa fa-user-circle"></i>User Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/role'); ?>"><i class="fa fa-rouble"></i>User Role</a></li>
            <li><a href="<?php echo e(url('/').'/master/jabatan'); ?>"><i class="fa fa-bookmark"></i>Jabatan Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/departemen'); ?>"><i class="fa fa-briefcase"></i>Departemen Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/level'); ?>"><i class="fa fa-level-down"></i>Level Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/cost'); ?>"><i class="fa fa-dollar"></i>Cost Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/group'); ?>"><i class="fa fa-gg-circle"></i>Group Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/area'); ?>"><i class="fa fa-bullseye"></i>Area Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/areacost'); ?>"><i class="fa fa-money"></i>Area Cost</a></li>
            <li><a href="<?php echo e(url('/').'/master/company'); ?>"><i class="fa fa-building"></i>Company Info</a></li>          
            <li><a href="<?php echo e(url('/').'/master/client'); ?>"><i class="fa fa-chain"></i>Client Info</a></li>
            <li><a href="<?php echo e(url('/').'/master/employee'); ?>"><i class="fa fa-user-secret"></i>Employee Info</a></li>          
            <li><a href="<?php echo e(url('/').'/master/set_document'); ?>"><i class="fa fa-gears"></i>Pengaturan Dokumen</a></li>
            <?php
                      /*}
                  }*/
            ?>
        </ul>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-codepen"></i> <span>TRANSAKSI</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo e(url('/').'/transaksi/jobs/job/0/0/0'); ?>"><i class="fa fa-calendar"></i>Job</a></li>
            </ul>
        </li>
    <?php
        //}
        } else {
    ?>
    <script>
        alert("Sesi Login Anda Habis...!!!");
        window.location = "<?php echo e(url('/logout')); ?>";
    </script>
    <?php
        }
    ?>
</section>
<!-- /.sidebar -->
</aside>
<?php /**PATH E:\xampp\htdocs\timesheet\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>