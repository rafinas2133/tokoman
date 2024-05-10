<div>
    <div class="container m-10 w-max text-red-500">
        <h1 class="text-2xl font-bold">Hitung Profit</h1>
        <form id="profitForm" action="{{ route('profit.index') }}" method="GET">
            <label for="period">Select Period:</label>
            <select name="period" id="period">
                <option value="day">Day</option>
                <option value="week">Week</option>
                <option value="year">Year</option>
            </select>
            <label for="from_date">From Date:</label>
            <input type="date" id="from_date" name="from_date" value="{{ $fromDate }}">
            <label for="to_date">To Date:</label>
            <input type="date" id="to_date" name="to_date" value="{{ $toDate }}">
            <button type="submit">Filter</button>
        </form>
        <div id="profitChartContainer">
            <canvas class="bg-white" id="profitChart" width="400" height="200"></canvas>
            <h1 id="profitText">Profit from {{ $fromDate }} to {{ $toDate }}: ${{ $profit }}</h1>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk membuat grafik profit
            function createChart(fromDate, toDate, profit) {
                console.log(fromDate, toDate, profit);
                var ctx = document.getElementById('profitChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [fromDate, toDate],
                        datasets: [{
                            label: 'Profit',
                            data: [0, profit],
                            backgroundColor: [
                                'rgba(240, 240, 240, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Update teks yang menampilkan profit dari tanggal tertentu
                var profitTextElement = document.getElementById('profitText');
                if (profitTextElement) {
                    profitTextElement.innerText = 'Profit from ' + fromDate + ' to ' + toDate + ': $' + profit;
                }
            }

            // Panggil fungsi createChart saat halaman dimuat
            createChart('{{ $fromDate }}', '{{ $toDate }}', {{ $profit }});

            var form = document.getElementById('profitForm');

            form.addEventListener('change', function () {
                // Kirim formulir secara asynchronous
                var formData = new FormData(form);
                var url = form.getAttribute('action');

                // Jika metode formulir adalah GET, hilangkan body dari permintaan fetch
                var method = form.getAttribute('method').toUpperCase();
                if (method === 'GET') {
                    url += '?' + new URLSearchParams(formData).toString();
                    formData = null; // Atur body menjadi null untuk permintaan GET
                }

                fetch(url, {
                    method: method, // Gunakan metode formulir yang ditentukan
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        // Perbarui bagian halaman yang diperlukan dengan data yang diperoleh dari server
                        var parser = new DOMParser();
                        var newDocument = parser.parseFromString(data, 'text/html');
                        var newChart = newDocument.getElementById('profitChart');
                        var oldChart = document.getElementById('profitChart');

                        oldChart.parentNode.replaceChild(newChart, oldChart);

                        // Ambil nilai dari input tanggal dan profit, lalu panggil kembali fungsi createChart
                        var fromDate = document.getElementById('from_date').value;
                        var toDate = document.getElementById('to_date').value;
                        var profitTextElement = newDocument.getElementById('profitText');
                        var profit = parseFloat(profitTextElement.innerText.replace('Profit from ' + fromDate + ' to ' + toDate + ': $', '')); // Ambil nilai profit dari teks yang diperoleh dari server
                        createChart(fromDate, toDate, profit);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

    </script>

    <script>
        document.addEventListener("turbo:submit-end", function (event) {
            var newContent = event.detail.fetchOptions.response;
            var newChartContainer = newContent.querySelector("#profitChartContainer");

            var oldChartContainer = document.getElementById("profitChartContainer");
            oldChartContainer.parentNode.replaceChild(newChartContainer, oldChartContainer);
        });
    </script>
</div>