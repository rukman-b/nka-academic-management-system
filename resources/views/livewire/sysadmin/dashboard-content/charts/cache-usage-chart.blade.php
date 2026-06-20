<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title mb-0">Cache Usage by Section</h3>
    </div>
    <div class="card-body">
        <div class="chart-container chart-container-lg">
            @if (array_sum($usage) > 0)
                <canvas id="cacheUsageChart"></canvas>
            @else
                <div class="chart-empty-state">
                    <p class="text-muted mb-0">
                        No cache items found or unsupported cache driver.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const usageData = @json($usage);

        if (Object.keys(usageData).length === 0) {
            return;
        }

        const canvas = document.getElementById('cacheUsageChart');

        if (!canvas || typeof Chart === 'undefined') {
            return;
        }

        const existingChart = Chart.getChart(canvas);

        if (existingChart) {
            existingChart.destroy();
        }

        const labels = Object.keys(usageData);
        const data = Object.values(usageData);

        const generateColor = (index, total, lightness = '60%') => {
            const hue = (index * 360 / total) % 360;
            return `hsl(${hue}, 70%, ${lightness})`;
        };

        const backgroundColors = labels.map((_, i) => generateColor(i, labels.length));
        const borderColors = labels.map((_, i) => generateColor(i, labels.length, '45%'));

        const ctx = canvas.getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Items Cached',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                resizeDelay: 150,
                plugins: {
                    title: {
                        display: true,
                        text: 'Cache Usage by Tag'
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            boxWidth: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const tag = ctx.label;
                                const count = ctx.parsed;
                                return `${tag}: ${count} item${count === 1 ? '' : 's'}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
