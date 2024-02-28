
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/sadik-logo.svg')}}"
      alt="Sadik & Counsel" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sadik & Counsel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user8-128x128.jpg')}}" class="img-circle elevation-2"
          alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item active">
            <a href="{{ route('admin.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('admin.members.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Members</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.services.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
                <p>Services</p>
            </a>
          </li>

          <li class="nav-item open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>Pages</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('pages.home') }}"
                    class="nav-link"><i class="far fa-circle nav-icon"></i> <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pages.about') }}"
                    class="nav-link"><i class="far fa-circle nav-icon"></i> <p>About</p>
                    </a>
                </li>
                
            </ul>
          </li>

          <li class="nav-item open">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Blog</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.blog.categories.index') }}"
                    class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>Category</p></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.blog.posts.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Posts</p>
                    </a>
                </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('contact.list') }}" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
                <p>Contacts</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Settings</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
