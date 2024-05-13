<div id="content">
    <style>
        .colflex {
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
            <div class="{{$differencePercentage > 0 ? 'text-green-500' : 'text-red-500'}}">
                {{$differencePercentage > 0 ? '+' : ''}}{{$differencePercentage}}%
            </div>
        </div>


        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENJUALAN PER BULAN</div>
            <div class="text-xl font-semibold">Rp. {{$dataThisMonth}}</div>
            <div class="{{$percentageThisMonth >= 0 ? 'text-green-500' : 'text-red-500'}}">
                {{$percentageThisMonth >= 0 ? '+' : ''}}{{$percentageThisMonth}}%
            </div>
        </div>


        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENJUALAN BARANG</div>
            <div class="text-xl font-semibold">{{$barangPenjualan}}</div>
        </div>


        <div class="bg-gray-100 w-full p-4 rounded-lg shadow">
            <div class="text-gray-600">TOTAL PENGHASILAN MINGGUAN</div>
            <div class="text-xl font-semibold">Rp. {{$profit}}</div>
            <div class="{{$precentageProfit >= 0 ? 'text-green-500' : 'text-red-500'}}">
                {{$precentageProfit >= 0 ? '+' : ''}}{{$precentageProfit}}%
            </div>
        </div>

    </div>

    <!-- Profit Chart -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow w-full">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Profit</h2>
            <button onclick="exportProfit()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export PDF</button>
        </div>
        <button id="openProfit"
            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Open
            Chart in New Tab</button>
        @include('layouts.profitHomeContent')

    </div>

    <!-- Traffic Sources -->
    <div class="mt-8 bg-white p-4 rounded-lg shadow w-full">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-xl font-semibold">Traffic Sources</h2>
            <form id="hiddenForm" action="/export-pdf" method="post">
                @csrf
                <input type="hidden" id="hiddenImage" name="chart_image" accept="image/*">
                <input type="hidden" id="hiddenInput" name="timeFilter" value="{{$choosenPeriod}}">
            </form>
            <button onclick="exportToPDF()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export PDF</button>
        </div>
        <!-- Placeholder for traffic sources -->
        <div class="flex gap-4">
            <form action="/dashboard" method="get">
                <select id="timeFilter" name="timeFilter"
                    class="bg-blue-500 text-white font-bold py-2 px-4 w-full my-2 rounded">
                    <option value="daily" {{$choosenPeriod == 'daily' ? 'selected' : ''}}>Harian</option>
                    <option value="weekly" {{$choosenPeriod == 'weekly' ? 'selected' : ''}}>Mingguan</option>
                    <option value="monthly" {{$choosenPeriod == 'monthly' ? 'selected' : ''}}>Bulanan</option>
                    <option value="yearly" {{$choosenPeriod == 'yearly' ? 'selected' : ''}}>Tahunan</option>
                </select>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Load
                    Data</button>
            </form>
        </div>
        <button id="openChart"
            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Open
            Chart in New Tab</button>
        <div class="w-full overflow-auto bg-gray-200 rounded-lg mt-4">
            <div class="h-[600px] rounded-lg mt-4 w-[1000px] min-[1250px]:w-full">
                <canvas id="barangChart"></canvas>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function exportToPDF() {
            var canvas = document.getElementById('barangChart');
            var canvasImg = canvas.toDataURL("image/png", 1.0);
            document.getElementById('hiddenImage').value = canvasImg;
            document.getElementById('hiddenForm').submit();
        }

    </script>
    <script>
        var canvas = document.getElementById('barangChart');
        var ctx = canvas.getContext('2d');
        var canvas2 = document.getElementById('profitChart');
        var ctx2 = canvas2.getContext('2d');
        function fetchChartData() {
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
        }
        document.addEventListener('DOMContentLoaded', function () {
            fetchChartData();
            document.getElementById('openChart').addEventListener('click', function () {
                var canvasImg = ctx.canvas.toDataURL("image/png");
                var win = window.open();
                win.document.write('<img src="' + canvasImg + '" />');
            });
            document.getElementById('openProfit').addEventListener('click', function () {
                var canvasImg = ctx2.canvas.toDataURL("image/png");
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
        <ul
            class="divide-y divide-gray-200 px-2 py-2 rounded-lg my-2 {{$riwayat->jenis_riwayat == 'masuk' ? 'bg-blue-100' : 'bg-green-100'}}">
            <li class="py-4 flex justify-between items-center ">
                <div>
                    <p class="text-md text-gray-600">{{$riwayat->nama_barang}}</p>
                    <p class="text-sm">Jumlah: {{$riwayat->jumlah}}</p>
                    <p class="text-sm">{{$riwayat->jenis_riwayat == 'masuk' ? 'Beli' : 'Jual'}} Rp:
                        {{$riwayat->total_harga}}
                    </p>
                </div>
                <div class="text-sm text-gray-600">{{$riwayat->tanggal}} {{$riwayat->jam_dibuat}}
                    <div class="text-sm text-gray-600">stok {{$riwayat->jenis_riwayat}}</div>
                </div>

            </li>
            <!-- More transactions here -->
        </ul>
    @endforeach
</div>


</div>