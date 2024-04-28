<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="/stok" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 inline-block">Kembali</a>
    
 <form action="{{url('/stok/editsave/'.$brg->id)}}" method="post" class="needs-validation text-white">
    @csrf
    <div class="mb-4">
        <label for="nama" class="block text-white text-sm font-bold mb-2">Nama Barang:</label>
        <input type="text" id="nama" name="nama" value="{{$brg->nama_barang}}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
    <label for="stok" class="block text-sm font-bold mb-2">Stok:</label>
    <input type="number" id="stok" name="stok" required value="{{$brg->stok}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
    <label for="jenis" class="block text-sm font-bold mb-2">Jenis Barang:</label>
    <input type="text" id="jenis" name="jenis" required value="{{$brg->jenis_barang}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="desc" class="block text-sm font-bold mb-2">Deskripsi:</label>
        <textarea type="textarea" id="desc" name="desc" required value="{{$brg->deskripsi}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{$brg->deskripsi}}</textarea>
    </div>
    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan Data</button>
    </form>
 
      
                </div>
            </div>
        </div>
    </div>            <
</x-app-layout>

