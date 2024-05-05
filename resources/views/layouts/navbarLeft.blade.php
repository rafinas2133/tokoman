<button class="sm:hidden p-4 text-white focus:outline-none mx-auto flex justify-center" onclick="toggleNavbar()">
<svg class="w-10 h-6" fill="none" stroke="currentColor" viewBox="0 0 40 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 6h36M2 12h36M2 18h36"></path>
    </svg>
</button>
<div class="bg-gray-800 text-white h-full border-r border-gray-700 transform -translate-x-full sm:translate-x-0 max-[640px]:hidden transition-transform duration-300">
    <div class="p-4 text-xl font-semibold border-b border-gray-700">ANALYTICS</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="{{ route('stokIndex') }}" class="{{ request()->routeIs('stokIndex', 'searchStokadmin', 'tambahBarang', 'editStok') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>📦</span>
                <span>Manajemen Stok</span>
            </a>
        </li>
        @if(session('role_id') == 0)
        <li>
            <a href="{{ route('Manajemen.Admin') }}" class="{{ request()->routeIs('Manajemen.Admin', 'Tambah.Pegawai', 'Edit.Pegawai') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>👥</span>
                <span>Manajemen Pegawai</span>
                <span class="ml-auto px-2 py-0.5 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">NEW</span>
            </a>
        </li>
        @endif
    </ul>
    <div class="p-4 text-xl font-semibold border-y border-gray-700">SHOP</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="#" class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>📦</span>
                <span>Products</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>📑</span>
                <span>Orders</span>
            </a>
        </li>
        <li>
            <a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>📊</span>
                <span>Reports</span>
            </a>
        </li>
    </ul>
    <div class="p-4 text-xl font-semibold border-y border-gray-700">SUPPORT</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="#" class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>👤</span>
                <span>Agents</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>👥</span>
                <span>Customers</span>
            </a>
        </li>
    </ul>
    <div class="p-4 text-xl font-semibold border-y border-gray-700">SETTINGS</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>👤</span>
                <span>Profile</span>
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('post')
                <button type="submit" class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow w-full">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
            </a>
        </li>
    </ul>
</div>
<script>
    function toggleNavbar() {
        const navbar = document.querySelector('.bg-gray-800');
        if(navbar.classList.contains('max-[640px]:hidden')) {
            navbar.classList.remove('max-[640px]:hidden');
        } else {
            navbar.classList.add('max-[640px]:hidden');
        }
        navbar.classList.toggle('-translate-x-full');
    }
</script>