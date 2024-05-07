<div id="content" class="w-full">
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
            <div class="text-xl font-semibold">Rp. {{$totalToday}}</div>
            <div class="{{$differencePercentage > 0 ? 'text-green-500' : 'text-red-500'}}">{{$differencePercentage > 0 ? '+' : ''}}{{$differencePercentage}}%</div>
        </div>

   
        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENJUALAN PER BULAN</div>
            <div class="text-xl font-semibold">Rp. {{$dataThisMonth}}</div>
            <div class="{{$percentageThisMonth >= 0 ? 'text-green-500' : 'text-red-500'}}">{{$percentageThisMonth >= 0 ? '+' : ''}}{{$percentageThisMonth}}%</div>
        </div>
 
   
        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENJUALAN BARANG</div>
            <div class="text-xl font-semibold">{{$barangPenjualan}}</div>
        </div>

    
        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENGHASILAN</div>
            <div class="text-xl font-semibold">Rp. 13.650.00</div>
            <div class="text-green-500">+36%</div>
        </div>
  
</div>

    <!-- Profit Chart -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Profit</h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export PDF</button>
        </div>
        <!-- Placeholder for chart -->
        <div class="h-64 bg-gray-200 rounded-lg mt-4"></div>
    </div>

    <!-- Traffic Sources -->
    <div class="mt-8 bg-white p-4 rounded-t-lg shadow overflow-auto">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Traffic Sources</h2>
            <button onclick="exportToPDF()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export PDF</button>
        </div>
        <!-- Placeholder for traffic sources -->
        <button id="openChart" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Open Chart in New Tab</button>
    </div>
    <div class="w-full overflow-auto bg-gray-200 rounded-b-lg">
    <div class="h-[600px] rounded-lg mt-4 w-[1000px] sm:w-full">
        <canvas id="barangChart"></canvas>
    </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function exportToPDF() {
    var canvas = document.getElementById('barangChart');
    var canvasImg = canvas.toDataURL("image/png", 1.0);

    var form = new FormData();
    form.append('chart_image', canvasImg);

    fetch('/export-pdf', {
        method: 'POST',
        body: form,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan CSRF token disertakan untuk keamanan
        }
    })
    .then(response => response.blob())
    .then(blob => {
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'riwayatTraficTokoman-'+Date.now()+'.pdf';
        document.body.appendChild(a);
        a.click();
        a.remove();
    });
}

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('barangChart');
    var ctx = canvas.getContext('2d');
    var combinedData = @json($combinedData);

    var labels = combinedData.map(data => data.tanggal);
    var dataMasuk = combinedData.map(data => data.totalMasuk);
    var dataKeluar = combinedData.map(data => data.totalKeluar);

    var barangChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Masuk',
                data: dataMasuk,
                borderColor: 'blue',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                fill: false
            }, {
                label: 'Total Keluar',
                data: dataKeluar,
                borderColor: 'green',
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    document.getElementById('openChart').addEventListener('click', function() {
        var canvasImg = ctx.canvas.toDataURL("image/png");
        var win = window.open();
        win.document.write('<img src="' + canvasImg + '" />');
    });
    
});
</script>
    </div>

    <!-- Recent Transactions -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Recent Transactions</h2>
            <a href="/riwayat" class="hover:text-blue-500">Show all ></a>
        </div>
        @foreach ($riwayatTerbaru as $riwayat)
        <ul class="divide-y divide-gray-200 px-2 py-2 rounded-lg my-2 {{$riwayat->jenis_riwayat == 'masuk' ? 'bg-blue-100' : 'bg-green-100'}}">
            <li class="py-4 flex justify-between items-center ">
                <div>
                    <p class="text-md text-gray-600">{{$riwayat->nama_barang}}</p>
                    <p class="text-sm">Jumlah: {{$riwayat->jumlah}}</p>
                    <p class="text-sm">{{$riwayat->jenis_riwayat == 'masuk' ? 'Beli' : 'Jual'}} Rp: {{$riwayat->total_harga}}</p>
                </div>
                <div class="text-sm text-gray-600">{{$riwayat->tanggal}} {{$riwayat->jam_dibuat}}<div class="text-sm text-gray-600">stok {{$riwayat->jenis_riwayat}}</div></div>
                
            </li>
            <!-- More transactions here -->
        </ul>
        @endforeach
    </div>

    
</div>