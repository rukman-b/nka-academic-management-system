<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Students per Programme</h3>
        </div>
        <div class="card-body">
            <div class="chart-canvas-wrapper">
                <canvas id="programmeChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('programmeChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Number of Students',
                    data: @json($data),
                    // backgroundColor: [
                    //     'rgba(60,141,188,0.9)',
                    //     'rgba(0,166,90,0.9)',
                    //     'rgba(243,156,18,0.9)',
                    //     'rgba(0,192,239,0.9)',
                    //     'rgba(221,75,57,0.9)',
                    //     'rgba(96,92,168,0.9)',
                    //     'rgba(210,214,222,0.9)',
                    //     'rgba(57,204,204,0.9)',
                    //     'rgba(255,133,27,0.9)',
                    //     'rgba(100,221,23,0.9)'
                    // ],
                    // borderColor: [
                    //     'rgba(60,141,188,1)',
                    //     'rgba(0,166,90,1)',
                    //     'rgba(243,156,18,1)',
                    //     'rgba(0,192,239,1)',
                    //     'rgba(221,75,57,1)',
                    //     'rgba(96,92,168,1)',
                    //     'rgba(210,214,222,1)',
                    //     'rgba(57,204,204,1)',
                    //     'rgba(255,133,27,1)',
                    //     'rgba(100,221,23,1)'
                    // ],
                    borderWidth: 0.5,
                    borderRadius: 4,
                    categoryPercentage: 0.8,
                    barPercentage: 0.9
                }]
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endpush