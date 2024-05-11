<div>
    <div id="profitChartContainer" class="w-full overflow-auto bg-gray-200 rounded-lg mt-4">
        <div class="h-[400px] rounded-lg mt-4 w-[1000px] sm:w-full">
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
    <script>
        function exportProfit() {
            var canvas = document.getElementById('profitChart');
            var canvasImg = canvas.toDataURL("image/png", 1.0);

            var form = new FormData();
            form.append('profit_image', canvasImg);

            fetch('/export-profit', {
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
                    a.download = 'profitTraficTokoman-' + Date.now() + '.pdf';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                });
        }

    </script>
</div>