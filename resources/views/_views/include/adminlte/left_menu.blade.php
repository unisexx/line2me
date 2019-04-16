<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://stickershop.line-scdn.net/stickershop/v1/sticker/2021/ANDROID/sticker.png" class="img-circle" alt="User Image" width="160" height="160">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        @if(Auth::user()->level == 99)
          <li class="header">SuperAdmin</li>
          <!-- Optionally, you can add icons to the links -->
          <li {{ request()->segment(2) == 'page' ? 'class=active' : '' }}><a href="{{ url('creator/page') }}"><i class="fa fa-link"></i> <span>Page</span></a></li>
        @endif

        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
        <li {{ request()->segment(2) == 'dashboard' ? 'class=active' : '' }}><a href="{{ url('creator/dashboard') }}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
        <li {{ request()->segment(2) == 'sticker' ? 'class=active' : '' }}><a href="{{ url('creator/sticker') }}"><i class="fa fa-link"></i> <span>Sticker</span></a></li>
        <li {{ request()->segment(2) == 'theme' ? 'class=active' : '' }}><a href="{{ url('creator/theme') }}"><i class="fa fa-link"></i> <span>Theme</span></a></li>
        <li {{ request()->segment(2) == 'lucky' ? 'class=active' : '' }}><a href="{{ url('creator/lucky') }}"><i class="fa fa-link"></i> <span>Lucky Draw</span></a></li>

        <li class="header">Page</li>
        <li><a href="creator/page/view/6"><i class="fa fa-circle-o text-aqua"></i> <span>วิธีใช้งานเบื้องต้น</span></a></li>
        <li><a href="creator/page/view/8"><i class="fa fa-circle-o text-red"></i> <span>การอ้างสิทธิ์ในการเป็นเจ้าของ</span></a></li>

        <!-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
        <!-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>