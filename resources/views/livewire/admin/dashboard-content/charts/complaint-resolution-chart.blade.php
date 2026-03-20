<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Avg. Complaint Resolution Time (hrs)</h3>
    </div>
    <div class="card-body">
        <div class="chart-canvas-wrapper">
            <canvas id="complaintDonutChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = @json($categories);
        const data = @json($averageTimes);

        const generateColor = () => {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.7)`;
        };

        const backgroundColors = labels.map(() => generateColor());
        const borderColors = backgroundColors.map(c => c.replace('0.7', '1'));

        const ctx = document.getElementById('complaintDonutChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    // backgroundColor: backgroundColors,
                    // borderColor: borderColors,
                    borderWidth: 0.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 20,
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} hrs`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush