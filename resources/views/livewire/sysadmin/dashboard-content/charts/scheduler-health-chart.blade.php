<div class="card card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Cron Scheduler Execution Duration</h3>
        <span class="badge badge-secondary">
            Last Cron Run: {{ $lastRunTime }}
        </span>
    </div>
    <div class="card-body">
        @if (count($chartData['labels']) > 0)
            <canvas id="schedulerChart" style="width: 100%; height: 300px;"></canvas>
        @else
            <p class="text-center text-muted mb-0">No data to display yet.</p>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const schedulerChartData = @json($chartData);

    if (schedulerChartData && Array.isArray(schedulerChartData.labels) && schedulerChartData.labels.length > 0) {
        const ctx = document.getElementById('schedulerChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: schedulerChartData.labels,
                datasets: [{
                    label: 'Duration (seconds)',
                    data: schedulerChartData.durations,
                    backgroundColor: schedulerChartData.statuses.map(status =>
                        status === 'success' ? 'rgba(75, 192, 192, 0.7)' : 'rgba(255, 99, 132, 0.7)'
                    ),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (ctx) {
                                return `${ctx.parsed.y} seconds`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Cron Execution Duration'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Duration (s)'
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
