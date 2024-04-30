<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard'. session('role_id')==0?'Admin':'Pegawai') }}
        </h2>
    </x-slot>
    @if(session('role_id')==1)
    <x-search-stok :route="'emp'"/>
    <x-stok-layout :barang="$barangs" />
    @endif 
    @if(session('role_id') ==0)
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ url('/stok') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manajemen Stok Barang</a>
                    <!-- Button trigger modal -->
                    <a href="/admin"type="button" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manajemen Pegawai</a>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

