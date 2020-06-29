<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

        <li class="nav-item has-treeview {{ setActiveMenu(['admin.posts.index',]) }} ">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Blog
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('view', new App\Post)
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index')}}"
                        class="nav-link {{ setActiveRoute('admin.posts.index') }} ">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <p>Ver Post</p>
                    </a>
                </li>
                @endcan
                @can('create', new App\Post)
                <li class="nav-item">
                    @if(request()->is('admin/posts/*'))
                    <a href="{{ route('admin.posts.index','#create') }}" class="nav-link"><i class="fa fa-plus"></i>
                        <p>Crear Post</p>
                    </a>
                    @else
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="nav-link"><i
                            class="fa fa-plus"></i>
                        <p>Crear Post</p>
                    </a>
                    @endif
                </li>
                @endcan
            </ul>
        </li>


        @can('view', new App\User)
        <li class="nav-item has-treeview {{ setActiveMenu(['admin.users.index','admin.users.create','admin.users.edit','admin.users.show']) }} ">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index')}}" class="nav-link {{ setActiveRoute(['admin.users.index','admin.users.edit','admin.users.show'])}}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <p>Ver Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.create') }}"
                        class="nav-link {{ setActiveRoute('admin.users.create')}}"><i class="fa fa-pen"></i>
                        <p>Crear un Usuario</p>
                    </a>

                </li>
            </ul>

        </li>
        @else
        <li class="nav-item has-treeview ">
            <a href="{{ route('admin.users.show', auth()->user())}}" class="nav-link {{ setActiveRoute(['admin.users.show','admin.users.edit'])}}">
                <i class="nav-icon fas fa-user"></i>
                <p>Perfil</p>
            </a>
        </li>
        @endcan
        @can('view', new \Spatie\Permission\Models\Role)
        <li class="nav-item has-treeview ">
            <a href="{{ route('admin.roles.index')}}" class="nav-link {{ setActiveRoute(['admin.roles.index','admin.roles.create','admin.roles.edit'])}}">
                <i class="nav-icon fas fa-address-book"></i>
                <p>Roles</p>
            </a>
        </li>
        @endcan
        @can('view', new \Spatie\Permission\Models\Permission)
        <li class="nav-item has-treeview ">
            <a href="{{ route('admin.permissions.index')}}" class="nav-link  {{ setActiveRoute(['admin.permissions.index','admin.permissions.edit'])}}">
                <i class="nav-icon fas fa-address-card"></i>
                <p>Permisos</p>
            </a>
        </li>
        @endcan
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
    </ul>
</nav>
