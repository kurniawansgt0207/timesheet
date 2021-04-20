<?php
    //session_start();
?>
<header class="main-header">
<!-- Logo -->
<a href="{{url('/home')}}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="{{url('public/adminlte/dist/img/mgi_gideon_adi.png')}}"></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="{{url('public/adminlte/dist/img/mgi_gideon_adi.png')}}"></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->

      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          @if(Session::get('picture')!='-')
          <img src="{{url('/')}}/public/adminlte/dist/img/profile/<?php echo isset($_SESSION['picture'])?$_SESSION['picture']:"";?>" class="user-image" alt="User Image">
          @else
          <img src="{{url('/public/adminlte/dist/img/profile-icon.png')}}" class="user-image" alt="User Image">
          @endif
          <span class="hidden-xs" style="color: #000000"><?php echo isset($_SESSION['name'])?$_SESSION['name']:"";?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <?php
            if(isset($_SESSION['picture'])){
            ?>
            <img src="{{url('/')}}/public/adminlte/dist/img/profile/<?php echo isset($_SESSION['picture'])?$_SESSION['picture']:"";?>" class="img-circle" alt="User Image">
            <?php } else { ?>
            <img src="{{url('/public/adminlte/dist/img/profile-icon.png')}}" class="img-circle" alt="User Image">
            <?php
            }
                $userRole = Session::get('role_name');
                $userRole = str_replace("_"," ",str_replace(","," & ",str_replace("'","",$userRole)));
            ?>
            <p style="color: #000000">
              {{isset($_SESSION['name'])?$_SESSION['name']:""}}<br>{{$userRole}} {{ $_SESSION['id'] }}
            </p>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{url('/')}}/master/data_pekerja/profil/{{isset($_SESSION['id'])?$_SESSION['id']:0}}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>

            </div>
          </li>
        </ul>
      </li>

    </ul>
  </div>
</nav>
</header>
