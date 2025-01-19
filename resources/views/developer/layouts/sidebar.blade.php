<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('users.index') }}" class="brand-link">
        <img src="{{asset('admin-assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Daily Error Tracking</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('developer_error_trackings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Daily Error Tracking list</p>
                    </a>
                </li>
                 {{-- <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Developer </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Project Name</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('news.update_category') }}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i></i>
                        <p>Update Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i></i>
                        <p>General Report</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
