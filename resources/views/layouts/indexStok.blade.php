<x-search-stok :route="'admin'" />


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
                @foreach($barangs as $index => $usr)
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">{{ $barangs->firstItem() + $index }}</td>
                        <td class="border px-4 py-2">{{ $usr->id_barang }}</td>
                        <td class="border px-4 py-2">{{ $usr->nama_barang }}</td>
                        <td class="border px-4 py-2">{{ $usr->stok }}</td>
                        <td class="border px-4 py-2">{{ $usr->bal }}</td>
                        <td class="border px-4 py-2">{{ $usr->ukuran }}</td>
                        <td class="border px-4 py-2">{{ $usr->jenis_tutup }}</td>
                        <td class="border px-4 py-2 max-w-sm">{{ $usr->harga_beli }}</td>
                        <td class="border px-4 py-2 max-w-sm">{{ $usr->harga_jual }}</td>
                        <td class="border px-4 py-2 w-sm">
                            <form action="/tambahstok/{{$usr->id_barang}}" method="post">
                                @csrf
                                <input type="number" placeholder="insert" name="stok" id="stok" class="w-24" required>
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                            </form>
                        </td>
                        <td class="border px-4 py-2 ">
                            <div class="flex items-center justify-center">
                                <a href="/stok/edit/{{ $usr->id_barang }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded ">
                                    Edit
                                </a>
                                <form action="/stok/delete/{{ $usr->id }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
<!-- Pagination Links -->
<div class="text-center mt-4, bg-blue-700, text-white">
    {{ $barangs->appends(request()->query())->links('vendor.pagination.custom') }}
</div>
</div>