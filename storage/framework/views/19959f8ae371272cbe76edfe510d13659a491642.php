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
      <img src="<?php echo url('/');?>/public/adminlte/dist/img/profile/<?php echo e(Session::get('picture')); ?>" class="user-image" alt="User Image">
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

    <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
    <?php



        if(Session::get('parent_menu')>0){
        foreach(Session::get('parent_menu') as $mUtama)
        {
    ?>
    <li class="treeview">
      <a href="#">
        <i class="fa <?php echo $mUtama->modul_class;?>"></i> <span><?php echo $mUtama->modul_category;?></span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
          <?php
                foreach(Session::get('role_submenu') as $subMenu)
                {
                    if($mUtama->modul_category == $subMenu->modul_category)
                    {
                        $roleAccess = RoleGroupDetailController::get_access_crud($subMenu->modul_alias);
          ?>
          <li><a href="<?php echo url('/').$subMenu->route_link;?>"><i class="fa fa-circle-o"></i><?php echo $subMenu->modul_alias;?></a></li>
          <?php
                    }
                }
          ?>
      </ul>
    <?php
        }
        } else {
    ?>
    <script>
        alert("Sesi Login Anda Habis...!!!");
        window.location = '/logout';
    </script>
    <?php
        }
    ?>
</section>
<!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\sdhc\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>