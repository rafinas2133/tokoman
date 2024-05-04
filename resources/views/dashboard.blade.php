<x-app-layout>
    <div class="flex h-screen">
        <div class="w-64">
            @include('layouts.navbarLeft') 
        </div>
        <div class="flex flex-col flex-1 w-full">
        @include('layouts.homeContent')
        </div>
        
    <!-- @if(session('role_id')==1)
    @if(session('error')=='true')
    <div class="error hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Error!</strong>
    <span class="block sm:inline">Input Gambar Harus File Max 2MB dengan Ekstensi jpg,png,jpeg</span>
    </div>
    <script>
        var error = document.querySelector('.error');
        error.classList.remove('hidden');
        setTimeout(() => {
        error.classList.add('hidden');
        }, 3000);
    </script>
    @else 
    @endif
    <x-search-stok :route="'emp'"/>
    <x-stok-layout :barang="$barangs"/>
    @endif 
    @if(session('role_id') ==0)
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ url('/stok') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manajemen Stok Barang</a>
                </div>
                <div class="pb-6 text-gray-900 dark:text-gray-100">
                <a href="/admin"type="button" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manajemen Pegawai</a>
                </div>
            </div>
        </div>
    </div>
    @endif -->
    </div>
    

    
</x-app-layout>

