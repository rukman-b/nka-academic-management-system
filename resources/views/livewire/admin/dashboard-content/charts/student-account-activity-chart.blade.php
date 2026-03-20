<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Student Account Activity</h3>
    </div>
    <div class="card-body">
        <div class="chart-canvas-wrapper">
            <canvas id="studentActivityChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('studentActivityChart').getContext('2d');

        const labels = @json($labels);
        const added = @json($added);
        const updated = @json($updated);
        const deleted = @json($deleted);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Added',
                        data: added,
                        // backgroundColor: 'rgba(40, 167, 69, 0.8)',
                        stack: 'actions',
                        categoryPercentage: 0.8,
                        barPercentage: 0.9
                    },
                    {
                        label: 'Updated',
                        data: updated,
                        // backgroundColor: 'rgba(255, 193, 7, 0.8)',
                        stack: 'actions',
                        categoryPercentage: 0.8,
                        barPercentage: 0.9
                    },
                    {
                        label: 'Deleted',
                        data: deleted,
                        // backgroundColor: 'rgba(220, 53, 69, 0.8)',
                        stack: 'actions',
                        categoryPercentage: 0.8,
                        barPercentage: 0.9
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        right: 10,
                        bottom: 10,
                        left: 10
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Student Count'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush