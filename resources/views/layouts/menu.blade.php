<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home text-red"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('items*') ||
                    request()->routeIs('location_types*') || request()->routeIs('locations*') || request()->routeIs('item_categories*') || request()->routeIs('brands*') ||
                    request()->routeIs('measurements*') || request()->routeIs('suppliers*')?'menu-open':'' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs text-blue"></i>
        <p>Master Data<i class="right fas fa-angle-left text-blue"></i></p>
    </a>

    <ul class="nav nav-treeview">

        @if(Auth::user()->can('master-location-types-list') )
            <li class="nav-item">
                <a href="{{route('location_types.index')}}" class="nav-link
                    {{ request()->routeIs('location_types*')?'active':'' }}">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>Location Type</p>
                </a>
            </li>
        @endif

        @if(Auth::user()->can('master-location-list') )
            <li class="nav-item">
                <a href="{{route('locations.index')}}" class="nav-link
                    {{ request()->routeIs('locations*')?'active':'' }}">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>Location</p>
                </a>
            </li>
        @endif

        @if(Auth::user()->can('master-item-categories-list') )
            <li class="nav-item">
                <a href="{{route('item_categories.index')}}" class="nav-link
                    {{ request()->routeIs('item_categories*')?'active':'' }}">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>Item Category</p>
                </a>
            </li>
        @endif

        @if(Auth::user()->can('master-item-list') )
            <li class="nav-item">
                <a href="{{route('items.index')}}" class="nav-link
                    {{ request()->routeIs('items*')?'active':'' }}">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>Item</p>
                </a>
            </li>
        @endif

        @if(Auth::user()->can('master-brand-list') )
            <li class="nav-item">
                <a href="{{route('brands.index')}}" class="nav-link
                    {{ request()->routeIs('brands*')?'active':'' }}">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>Brand</p>
                </a>
            </li>
        @endif

        @if(Auth::user()->can('master-measurement-list') )
            <li class="nav-item">
                <a href="{{route('measurements.index')}}" class="nav-link
                    {{ request()->routeIs('measurements*')?'active':'' }}">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>Denomination</p>
                </a>
            </li>
        @endif

        @if(Auth::user()->can('master-supplier-list') )
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('suppliers.index')}}" class="nav-link
                        {{ request()->routeIs('suppliers*')?'active':'' }}">
                        <i class="far fa-circle nav-icon text-blue"></i>
                        <p>Suppliers</p>
                    </a>
                </li>
            </ul>
        @endif
    </ul>

</li>


@can('role-list','user-list','logindetail-list','searchdetail-list')
    <li class="nav-item {{ request()->routeIs('users*', 'roles*','logindetails.index','searchdetails.index')?'menu-open':'' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt text-purple"></i>
            <p>
                System Management
                <i class="right fas fa-angle-left text-purple"></i>
            </p>
        </a>

        @can('role-list')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link
                    {{ request()->routeIs('roles.edit','roles.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon text-purple"></i>
                        <p>User Roles</p>
                    </a>
                </li>
            </ul>
        @endcan

        @can('user-list')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link
                    {{ request()->routeIs('users.index','users.edit')?'active':'' }}">
                        <i class="far fa-circle nav-icon text-purple"></i>
                        <p>All Users</p>
                    </a>
                </li>
            </ul>
        @endcan

        @can('logindetail-list')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('logindetails.index')}}" class="nav-link
                    {{ request()->routeIs('logindetails.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon text-purple"></i>
                        <p>Login Detail</p>
                    </a>
                </li>
            </ul>
        @endcan

    </li>
@endcan

<li class="nav-item">
    <a href="{{ route('change.index') }}" class="nav-link {{ Request::is('change.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-key text-orange"></i>
        <p>Change Password</p>
    </a>
</li>
