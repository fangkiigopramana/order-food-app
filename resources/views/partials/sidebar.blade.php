<ul class="navbar-nav bg-white sidebar sidebar-dark accordion" id="accordionSidebar">

{{-- Start: SuperAdmin Access --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-2" style="background-color: #FF8F0B;">
        <div class="sidebar-brand-text mx-3 text-gray-900">
            @hasanyrole('super admin')SUPER ADMIN TOOL @endhasanyrole 
            @hasanyrole('admin')ADMIN TOOL @endhasanyrole 
        </div>
    </a>
    <li class="nav-item text-gray-900 {{ request()->routeIs('dashboard') ?'text-white bg-orange-primary rounded-pill' : ''}}">
        <a class="nav-link text-gray-900" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
            <span>Beranda</span>
        </a>
    </li>

    @hasanyrole('super admin')
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('superadmin.menu') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('superadmin.menu')}}">
            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
            <span>Menu</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('superadmin.laporan') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('superadmin.laporan')}}">
            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
            <span>Laporan</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('superadmin.karyawan') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('superadmin.karyawan')}}">
            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
            <span>Karyawan</span>
        </a>
    </li>
    @endhasanyrole

    @hasanyrole('admin')
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('admin.pesanan') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('admin.pesanan')}}">
            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
            <span>Pesanan</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('admin.menu') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('admin.menu')}}">
            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
            <span>Menu</span>
        </a>
    </li>
    @endhasanyrole

    <div class="text-center d-none d-md-inline" style="margin-top: 200px">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: black; color: #FF8F0B;"></button>
    </div>
    <li class="nav-item active">
        <a class="nav-link text-gray-900" href="{{route('logout')}}">
            <i class="fas fa-fw fa-sign-out-alt text-gray-900"></i>
            <span>Log Out</span>
        </a>
    </li>
    

</ul>