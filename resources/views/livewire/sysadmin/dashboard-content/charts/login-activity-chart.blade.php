<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Login Success vs Failures (Last 30 Days)</h3>
    </div>
    <div class="card-body">
        <div class="chart-container chart-container-wide">
            <canvas id="loginActivityChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('loginActivityChart');

        if (!canvas) {
            return;
        }

        const existingChart = Chart.getChart(canvas);

        if (existingChart) {
            existingChart.destroy();
        }

        const ctx = canvas.getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [
                    {
                        label: 'Success',
                        data: @json($successData),
                        backgroundColor: 'rgba(40, 167, 69, 0.8)',
                        stack: 'login'
                    },
                    {
                        label: 'Failure',
                        data: @json($failureData),
                        backgroundColor: 'rgba(220, 53, 69, 0.8)',
                        stack: 'login'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                resizeDelay: 150,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.dataset.label}: ${ctx.raw} logins`
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: { display: true, text: 'Date' },
                        ticks: { maxRotation: 45, minRotation: 30 }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Login Attempts' }
                    }
                }
            }
        });
    });
</script>
@endpush
