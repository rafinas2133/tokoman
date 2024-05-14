<!-- Hamburger Button -->
<button id="menuButton" class="sm:hidden p-4 text-white focus:outline-none w-full flex justify-center bg-transparent"
    onclick="toggleNavbar()">
    <!-- Hamburger Icon -->
    <svg id="hamburgerIcon" class="w-10 h-6" fill="none" stroke="currentColor" viewBox="0 0 40 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 6h36M2 12h36M2 18h36"></path>
    </svg>
    <!-- Cross Icon -->
    <svg id="crossIcon" class="w-10 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
</button>

<div
    class="bg-gray-800 text-white h-full border-r border-t border-gray-700 transform -translate-x-full sm:translate-x-0 max-[640px]:hidden transition-transform duration-300">
    @if (Auth::user()->email_verified_at != null)
        <div class="p-4 text-xl font-semibold border-b border-gray-700">Manajemen</div>
        <ul class="space-y-2 p-5">
            <li>
                <a href="{{ route('stokIndex') }}"
                    class="{{ request()->routeIs('stokIndex', 'searchStokadmin', 'tambahBarang', 'editStok') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                    <span>📦</span>
                    <span>Manajemen Stok</span>
                </a>
            </li>
            @if(Auth::user()->role_id == 0)
                <li>
                    <a href="{{ route('Manajemen.Admin') }}"
                        class="{{ request()->routeIs('Manajemen.Admin', 'Tambah.Pegawai', 'Edit.Pegawai') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                        <span>🧑‍💼</span>
                        <span>Manajemen Pegawai</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="p-4 text-xl font-semibold border-y border-gray-700">ANALYTICS</div>
        <ul class="space-y-2 p-5">
            <li>
                <a href="{{ route('profit.index') }}"
                    class="{{ request()->routeIs('profit.index') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                    <span>📊</span>
                    <span>Profit</span>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan') }}"
                    class="{{ request()->routeIs('laporan') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                    <span>📝</span>
                    <span>Reports</span>
                </a>
            </li>
            <li>
                <a href="/riwayat"
                    class="{{ request()->routeIs('riwayat', 'riwayatFilter') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                    <span>⏰</span>
                    <span>History</span>
                </a>
            </li>
        </ul>
        <div class="p-4 text-xl font-semibold border-y border-gray-700">SUPPORT</div>
        <ul class="space-y-2 p-5">
            <li>
                <a href="#"
                    class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                    <span>👤</span>
                    <span>Agents</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                    <span>👥</span>
                    <span>Mitra</span>
                </a>
            </li>
        </ul>
    @endif
    <div class="p-4 text-xl font-semibold border-y border-gray-700">SETTINGS</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="{{ route('profile.edit') }}"
                class="{{ request()->routeIs('profile.edit') ? 'bg-blue-500 text-white px-3 py-1 rounded-md shadow' : '' }} flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow">
                <span>👤</span>
                <span>Profile</span>
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('post')
                <button type="submit"
                    class="flex items-center space-x-2 py-1 hover:bg-gray-700 hover:text-white hover:rounded-md hover:shadow w-full">
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
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const crossIcon = document.getElementById('crossIcon');
        const menuButton = document.getElementById('menuButton');
        hamburgerIcon.classList.toggle('hidden');
        crossIcon.classList.toggle('hidden');
        if (navbar.classList.contains('max-[640px]:hidden')) {
            navbar.classList.remove('max-[640px]:hidden');
        } else {
            navbar.classList.add('max-[640px]:hidden');
        }
        navbar.classList.toggle('-translate-x-full');
    }
</script>