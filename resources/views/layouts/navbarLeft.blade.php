<div class="bg-gray-800 text-white h-full border-r border-gray-700">
    <div class="p-4 text-xl font-semibold border-b border-gray-700">ANALYTICS</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="{{ route('stokIndex') }}" class="{{ request()->routeIs('stokIndex','searchStokadmin','tambahBarang','editStok') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>📦</span>
                <span>Manajemen Stok</span>
            </a>
        </li>
        @if(session('role_id')==0)
        <li>
            <a href="{{ route('Manajemen.Admin') }}" class="{{ request()->routeIs('Manajemen.Admin','Tambah.Pegawai','Edit.Pegawai') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
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