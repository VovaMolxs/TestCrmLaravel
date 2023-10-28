<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="{{ route('employes.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        @lang('sidebar.title_employess')
                        <span class="badge badge-info right">{{\App\Models\Employes::all()->count()}}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('companies.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        @lang('sidebar.title_companies')
                        <span class="badge badge-info right">{{\App\Models\Companies::all()->count()}}</span>
                    </p>
                </a>
            </li>




        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
