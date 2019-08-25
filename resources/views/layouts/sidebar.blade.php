<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
             style="opacity: .8;border-radius: 0;width: 100%;margin: auto;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block" style="color:#fff">
                    {{auth()->user()->name!= null ? auth()->user()->name : "Administrator"}}
                </span>
                <a href="{{ route('logout') }}" style="font-size: 15px;"><i class="fa fa-sign-out"></i> Thoát</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('sliders') }}" class="nav-link">
                        <i class="nav-icon fa fas fa-circle-notch text-danger"></i>
                        <p class="text">Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">
                        <i class="nav-icon fa fas fa-circle-notch text-warning"></i>
                        <p>Danh mục sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="nav-icon fa fas fa-circle-notch text-info"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('new_categories') }}" class="nav-link">
                        <i class="nav-icon fa fas fa-circle-notch"></i>
                        <p>Danh mục tin tức</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news') }}" class="nav-link">
                        <i class="nav-icon fa fas fa-circle-notch text-info"></i>
                        <p>Tin tức</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>