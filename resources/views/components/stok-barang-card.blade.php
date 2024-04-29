<div class="max-w-sm rounded overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-500">
    <img class="w-fit" src="https://placeholder.pics/svg/300" alt="Gambar {{ $barang->nama_barang }}">
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 text-blue-800">{{ $barang->nama_barang }}</div>
        <p class="text-white text-base">
            <strong>Jenis:</strong> {{ $barang->jenis_barang }}<br>
            <strong>Stok:</strong> {{ $barang->stok }}
        </p>
        <p class="text-white text-sm">{{ $barang->deskripsi }}</p>
    </div>
</div>