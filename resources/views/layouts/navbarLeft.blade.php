<div class="bg-gray-800 text-white h-full">
    <div class="p-5 text-xl font-semibold border-b border-gray-700">ANALYTICS</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>📦</span>
                <span>Manajemen Stok</span>
            </a>
        </li>
        @if(session('role_id')==0)
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>👥</span>
                <span>Manajemen Pegawai</span>
                <span class="ml-auto px-2 py-0.5 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">NEW</span>
            </a>
        </li>
        @endif
    </ul>
    <div class="p-5 text-xl font-semibold border-t border-gray-700">SHOP</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>📦</span>
                <span>Products</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>📑</span>
                <span>Orders</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>📊</span>
                <span>Reports</span>
            </a>
        </li>
    </ul>
    <div class="p-5 text-xl font-semibold border-t border-gray-700">SUPPORT</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>👤</span>
                <span>Agents</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>👥</span>
                <span>Customers</span>
            </a>
        </li>
    </ul>
    <div class="p-5 text-xl font-semibold border-t border-gray-700">SETTINGS</div>
    <ul class="space-y-2 p-5">
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>⚙️</span>
                <span>Settings</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
                <span>🚪</span>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>