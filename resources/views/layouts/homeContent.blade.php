<div id="content" class=" p-8 ">
<style>
    .colflex{
        @media screen and (max-width: 1024px) {
            display: grid;
        }
    }
</style>
<div class="flex colflex gap-4 grid-cols-2">
    <!-- Sales Metrics -->

        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">PENJUALAN PER HARI INI</div>
            <div class="text-3xl font-semibold">Rp. 13.650.00</div>
            <div class="text-green-500">+36%</div>
        </div>

   
        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENJUALAN</div>
            <div class="text-3xl font-semibold">Rp. 59.231.00</div>
            <div class="text-green-500">+14%</div>
        </div>
 
   
        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PEMBELIAN BARANG</div>
            <div class="text-3xl font-semibold">125</div>
            <div class="text-green-500">+36%</div>
        </div>

    
        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PEMBELI</div>
            <div class="text-3xl font-semibold">38</div>
            <div class="text-green-500">+36%</div>
        </div>
  
</div>

    <!-- Profit Chart -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Profit</h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export PDF</button>
        </div>
        <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <!-- Placeholder for chart -->
        <div class="h-64 bg-gray-200 rounded-lg mt-4"></div>
    </div>

    <!-- Traffic Sources -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow">
        <h2 class="text-xl font-semibold">Traffic Sources</h2>
        <!-- Placeholder for traffic sources -->
        <div class="h-32 bg-gray-200 rounded-lg mt-4"></div>
    </div>

    <!-- Recent Transactions -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Recent Transactions</h2>
            <a href="#" class="hover:text-blue-500">Show all ></a>
        </div>
        @foreach ($riwayatTerbaru as $riwayat )
        <ul class="divide-y divide-gray-200 px-2 py-2 rounded-lg my-2 {{$riwayat->jenis_riwayat=='masuk'?'bg-red-100':'bg-green-100'}}">
            <li class="py-4 flex justify-between items-center ">
                <div>
                    <p class="text-md text-gray-600">{{$riwayat->nama_barang}}</p>
                    <p class="text-sm">Jumlah: {{$riwayat->jumlah}}</p>
                    <p class="text-sm">{{$riwayat->jenis_riwayat=='masuk'?'Beli':'Jual'}} Rp: {{$riwayat->total_harga}}</p>
                </div>
                <div class="text-sm text-gray-600">{{$riwayat->tanggal}} {{$riwayat->jam_dibuat}}<div class="text-sm text-gray-600">stok {{$riwayat->jenis_riwayat}}</div></div>
                
            </li>
            <!-- More transactions here -->
        </ul>
        @endforeach
    </div>

    
</div>