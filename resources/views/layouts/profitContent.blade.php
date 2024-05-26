<div class="flex flex-col">
    <div class="container text-white flex flex-col justify-center items-center">
        <h1 class="text-3x text-center my-8 font-bold">Hitung Profit</h1>
        <form id="profitForm" action="{{ route('ApiFetch') }}" method="GET" class="">
            <div class="flex flex-col md:flex-row gap-4">
                <div>
                    <label for="period">Select Period:</label>
                    <select class="text-black" name="period" id="period">
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="year">Year</option>
                    </select>
                </div>
                <div>
                    <label for="from_date">From Date:</label>
                    <input class="text-black" type="date" id="from_date" name="from_date" value="{{ $fromDate }}">
                </div>
                <div>
                    <label for="to_date">To Date:</label>
                    <input class="text-black" type="date" id="to_date" name="to_date" value="{{ $toDate }}">
                </div>
            </div>
        </form>
    </div>
    <div class="w-full overflow-auto bg-gray-200 rounded-lg mt-4">
        <div class="h-[600px] rounded-lg mt-4 w-[1000px] min-[1250px]:w-full" id="parrentchart">
            <canvas id="profitChart"></canvas>
        </div>
    </div>
    <h1 id="profitText" class="dark:text-white text-black text-center">Profit from {{ $fromDate }} to {{ $toDate }}:
        ${{ $profit }}</h1>
</div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi untuk membuat grafik profit
        console.log()
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
                    responsive: true,
                    maintainAspectRatio: false,
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
        createChart('{{ $fromDate }}', '{{ $toDate }}', '{{ $profit }}');

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
                method: method, // Use the specified form method
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Assuming 'data' contains the necessary profit, fromDate, and toDate directly

                    // Update the profit text directly without needing to parse HTML
                    var profitTextElement = document.getElementById('profitText');
                    profitTextElement.innerText = 'Profit from ' + data.from + ' to ' + data.to + ': $' + data.profit;
                    // Remove the existing canvas
                    document.getElementById("profitChart").remove();

                    // Create a new canvas element
                    var newCanvas = document.createElement('canvas');
                    newCanvas.id = "profitChart";

                    // Append the new canvas to the parent container
                    document.getElementById("parrentchart").appendChild(newCanvas);

                    // Now you can recreate the chart on the new canvas
                    createChart(data.from, data.to, data.profit);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });

</script>