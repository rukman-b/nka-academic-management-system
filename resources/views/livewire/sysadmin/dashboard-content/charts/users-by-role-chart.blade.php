<div class="card card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Users by Role & Guard</h3>
        <button
            wire:click="exportCsv"
            wire:loading.attr="disabled"
            class="btn btn-sm btn-outline-light"
            title="Download CSV"
        >
            <i class="fas fa-download"></i> CSV
        </button>
    </div>
    <div class="card-body">
        <canvas id="usersByRoleChart" height="250"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('usersByRoleChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'User Count',
                    data: @json($data),
                    backgroundColor: @json($colors),
                    borderColor: @json($colors),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.label}: ${context.raw} users`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Users'
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 30
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
