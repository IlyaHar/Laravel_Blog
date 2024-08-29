<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="">
            <ul class=" nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <div class="user-panel   d-flex align-items-center pt-2 pb-2">
                    <div class="image">
                        <img src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : Storage::url(auth()->user()->avatar) }}" class="avatar" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('personal.index') }}" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
                @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="fas fa-tools"></i>
                            <p class="mx-2">
                                Admin Panel
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('main') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <p class="mx-2">
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('personal.liked.index') }}" class="nav-link">
                        <i class="fas fa-heart"></i>
                        <p class="mx-2">
                            Liked posts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('personal.comments.index') }}" class="nav-link">
                        <i class="fas fa-comments"></i>
                        <p class="mx-2">
                            Comments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('personal.settings.index') }}" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <p class="mx-2">
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
