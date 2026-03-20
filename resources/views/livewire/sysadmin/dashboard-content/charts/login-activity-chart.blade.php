<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Login Success vs Failures (Last 30 Days)</h3>
    </div>
    <div class="card-body">
        <canvas id="loginActivityChart" height="300"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('loginActivityChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [
                    {
                        label: 'Success',
                        data: @json($successData),
                        backgroundColor: 'rgba(40, 167, 69, 0.8)', // green
                        stack: 'login'
                    },
                    {
                        label: 'Failure',
                        data: @json($failureData),
                        backgroundColor: 'rgba(220, 53, 69, 0.8)', // red
                        stack: 'login'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
