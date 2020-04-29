  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminpanel/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin ICloudEms</span>
    </a>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(@Auth::check())
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <div class="image">
                <img src="{{asset('adminpanel/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
              </div>
              <h4>
                {{Auth::user()->name}}
                <i class="right fas fa-angle-left"></i>
              </h4>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active" onclick="event.preventDefault(); document.getElementById('faculty-logout-form').submit();" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Log Out</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                FACULTY
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('faculty.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Faculty List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                COURSE
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('course.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Course List</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <!-- logout form start -->
    <form id="faculty-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form> 
    <!-- logout form end    -->
  </aside>
