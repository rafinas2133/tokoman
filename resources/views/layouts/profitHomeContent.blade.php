<div>
    <div id="profitChartContainer" class="h-full w-full rounded-lg">
        <div class="w-full h-64 bg-gray-200 rounded-lg">
            <canvas id="profitChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk membuat grafik profit
            function createChart(labels, data) {
                var ctx = document.getElementById('profitChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Profit',
                            data: data,
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

            }

            // Panggil fungsi createChart saat halaman dimuat dengan data default
            createChart(['{{ $fromDate }}', '{{ $toDate }}'], [0, {{ $profit }}]);
        });
    </script>
</div>