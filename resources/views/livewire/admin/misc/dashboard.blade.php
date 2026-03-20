@section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle)

<div class="container-fluid">
    {{-- Row 1: Rectangular charts --}}
    <div class="row chart-card-equal-height">
        <div class="col-12 col-lg-6">
            @livewire('admin.dashboard-content.charts.programme-student-stats')
        </div>
        <div class="col-12 col-lg-6">
            @livewire('admin.dashboard-content.charts.complaints-escalated-chart')
        </div>
    </div>

    {{-- Row 2: Doughnut chart alone --}}
    <div class="row chart-card-equal-height mt-3 justify-content-center">
        <div class="col-12 col-lg-8">
            @livewire('admin.dashboard-content.charts.complaint-resolution-chart')
        </div>
    </div>

    {{-- Row 3: Activity chart alone --}}
    <div class="row chart-card-equal-height mt-3">
        <div class="col-12">
            @livewire('admin.dashboard-content.charts.student-account-activity-chart')
        </div>
    </div>
</div>

@push('css')
<style>
    .chart-card-equal-height > [class*="col-"] {
        display: flex;
        margin-bottom: 1rem;
    }

    .chart-card-equal-height .card {
        width: 100%;
        height: 100%;
        margin-bottom: 0;
    }

    .chart-card-equal-height .card-body {
        height: 420px;
        position: relative;
    }

    .chart-card-equal-height .chart-canvas-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .chart-card-equal-height .chart-canvas-wrapper canvas {
        width: 100% !important;
        height: 100% !important;
    }

    @media (max-width: 767.98px) {
        .chart-card-equal-height .card-body {
            height: 320px;
        }
    }
</style>
@endpush