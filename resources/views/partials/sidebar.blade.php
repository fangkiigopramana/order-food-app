<ul class="navbar-nav bg-white sidebar sidebar-dark accordion" id="accordionSidebar" style="position: sticky; top: 0; max-height: 100vh;">

{{-- Start: SuperAdmin Access --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-2" style="background-color: #FF8F0B;">
        <div class="sidebar-brand-text mx-3 text-gray-900">
            @hasanyrole('super admin')SUPER ADMIN TOOL @endhasanyrole 
            @hasanyrole('admin')ADMIN TOOL @endhasanyrole 
        </div>
    </a>
    <li class="nav-item text-gray-900 {{ request()->routeIs('dashboard') ?'text-white bg-orange-primary rounded-pill' : ''}}">
        <a class="nav-link text-gray-900" href="{{route('dashboard')}}">
            <img src="{{asset('svg/beranda.svg')}}" alt="Beranda Icon">
            <span>Beranda</span>
        </a>
    </li>

    @hasanyrole('super admin')
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('superadmin.menu') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('superadmin.menu')}}">
            <img src="{{asset('svg/menu-book.svg')}}" alt="Menu Book Icon">
            <span>Menu</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('superadmin.laporan') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('superadmin.laporan')}}">
            <img src="{{asset('svg/laporan.svg')}}" alt="Laporan Icon">
            <span>Laporan</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('superadmin.karyawan') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('superadmin.karyawan')}}">
            <img src="{{asset('svg/karyawan.svg')}}" alt="Karyawan Icon">
            <span>Karyawan</span>
        </a>
    </li>
    @endhasanyrole

    @hasanyrole('admin')
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('admin.pesanan') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('admin.pesanan')}}">
            <img src="{{asset('svg/pesanan.svg')}}" alt="Pesanan Icon">
            <span>Pesanan</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link text-gray-900 {{ request()->routeIs('admin.menu') ?'text-white bg-orange-primary rounded-pill' : ''}}" href="{{route('admin.menu')}}">
            <img src="{{asset('svg/menu-book.svg')}}" alt="Menu Icon">
            <span>Menu</span>
        </a>
    </li>
    @endhasanyrole

    <div class="text-center d-none d-md-inline my-5">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: black; color: #FF8F0B;"></button>
    </div>
    <li class="nav-item active" style="position: absolute; bottom: 0;">
        <a class="nav-link text-gray-900" href="#" id="logoutButton">
            <img src="{{asset('svg/logout.svg')}}" alt="Logout Icon">
            <span>Log Out</span>
        </a>
    </li>
</ul>

@push('scripts')
<script>
    document.getElementById('logoutButton').addEventListener('click', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    });
</script>
@endpush