<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title mb-0">Cache Usage by Section</h3>
    </div>
    <div class="card-body">
        @if (array_sum($usage) > 0)
            <canvas id="cacheUsageChart" style="width: 100%; height: 300px;"></canvas>
        @else
            <p class="text-muted text-center">No cache items found or unsupported cache driver.</p>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const usageData = @json($usage);

    if (Object.keys(usageData).length > 0) {
        const labels = Object.keys(usageData);
        const data = Object.values(usageData);

        //Generate unique HSL-based color per tag
        const generateColor = (index, total, lightness = '60%') => {
            const hue = (index * 360 / total) % 360;
            return `hsl(${hue}, 70%, ${lightness})`;
        };

        const backgroundColors = labels.map((_, i) => generateColor(i, labels.length));
        const borderColors = labels.map((_, i) => generateColor(i, labels.length, '45%'));

        const ctx = document.getElementById('cacheUsageChart').getContext('2d');
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
    }
</script>
@endpush
