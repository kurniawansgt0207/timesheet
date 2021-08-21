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
      @if(Session::get('picture')!='-')
      <img src="<?php echo url('/');?>/public/adminlte/dist/img/profile/<?php echo isset($_SESSION['picture'])?$_SESSION['picture']:"";?>" class="user-image" alt="User Image">
      @else
      <img src="{{url('public/adminlte/dist/profile-icon.png')}}" class="user-image" alt="User Image">
      @endif
    </div>
    <div class="pull-left info">
      <p>{{ env('APP_NAME') }}</p>
    </div>
  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">

    <!--<li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>-->        
    <?php         
        if(isset($_SESSION['login_status'])){
            foreach($_SESSION['menu_group'] as $menuGroup){
    ?>
    <li class="treeview">
        <a href="#">
            <i class="fa <?php echo $menuGroup->modul_group_icon;?>"></i> <span><?php echo strtoupper($menuGroup->modul_group);?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <?php
                foreach ($_SESSION['role_menu_user'] as $role_menu){
                    if($menuGroup->modul_group == $role_menu->modul_group){
            ?>
            <li><a href="{{ url('/').$role_menu->modul_link }}"><i class="fa <?php echo $role_menu->modul_icon;?>"></i><?php echo $role_menu->modul_label;?></a></li>
            <?php
                    }
                }
            ?>
        </ul>
    </li>
    <?php
            }    
        } else {
    ?>
    <script>
        alert("Sesi Login Anda Habis...!!!");
        window.location = "{{url('/logout')}}";
    </script>
    <?php
        }
    ?>
</section>
<!-- /.sidebar -->
</aside>
