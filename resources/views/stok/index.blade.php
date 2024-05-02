<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Stok Barang') }}
        </h2>
    </x-slot>
    @if($error=='true')
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
    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
       
        <a href="/dashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Kembali</a>
    </div>
    <x-search-stok :route="'admin'" />
    <div class="p-6 text-gray-900 dark:text-gray-100 text-center mx-auto">
        <a href="/stok/add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block"> + Tambah data barangs</a>
        <a href="/stok/deleteAll" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block"> - Hapus semua data barangs</a>
    </div>
    @if($barangs->isEmpty())
        <div class="text-center text-white text-info">
            <p>Belum ada data</p>
        </div>
    @else
        <div class="overflow-auto">
            <table class="table-auto border-collapse border mx-auto w-fit">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">ID Barang</th>
                        <th class="px-4 py-2">Nama Barang</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Isi/Bal</th>
                        <th class="px-4 py-2">Ukuran</th>
                        <th class="px-4 py-2">Jenis Tutup</th>
                        <th class="px-4 py-2">Harga Beli</th>
                        <th class="px-4 py-2">Harga Jual</th>
                        <th class="px-4 py-2">Tambahkan Stok</th>
                        <th class="px-4 py-2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a=0;?>
                    @foreach($barangs as $usr)
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2"><?php echo$a+=1?></td>
                        <td class="border px-4 py-2">{{ $usr->id_barang }}</td>
                        <td class="border px-4 py-2">{{ $usr->nama_barang }}</td>
                        <td class="border px-4 py-2">{{ $usr->stok }}</td>
                        <td class="border px-4 py-2">{{ $usr->bal }}</td>
                        <td class="border px-4 py-2">{{ $usr->ukuran }}</td>
                        <td class="border px-4 py-2">{{ $usr->jenis_tutup }}</td>
                        <td class="border px-4 py-2 max-w-sm">{{ $usr->harga_beli }}</td>
                        <td class="border px-4 py-2 max-w-sm">{{ $usr->harga_jual }}</td>
                        <td class="border px-4 py-2">
                        <form action="/tambahstok/{{$usr->id_barang}}" method="post">
                        @csrf
                        <Label for="stok">Masukkan stok: </Label>
                        <input type="number" name="stok" id="stok" required>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                        </form>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="/stok/edit/{{ $usr->id_barang }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                            <a href="/stok/delete/{{ $usr->id }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">Hapus</a>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <!-- Pagination Links -->
    <div class="text-center mt-4, bg-blue-700, text-white">
        {{ $barangs->links('vendor.pagination.tailwind') }}
    </div>
</x-app-layout>
