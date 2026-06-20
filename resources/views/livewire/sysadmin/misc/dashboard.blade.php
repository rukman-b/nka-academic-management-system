@section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle)

<div class="container-fluid sysadmin-dashboard">

    {{-- Top row --}}
    <div class="row">
        <div class="col-lg-6 mb-4">
            @livewire('sysadmin.dashboard-content.charts.users-by-role-chart')
        </div>

        <div class="col-lg-6 mb-4">
            @livewire('sysadmin.dashboard-content.charts.scheduler-health-chart')
        </div>
    </div>

    {{-- Middle row --}}
    <div class="row">
        <div class="col-lg-6 offset-lg-3 mb-4">
            @livewire('sysadmin.dashboard-content.charts.cache-usage-chart')
        </div>
    </div>

    {{-- Bottom row --}}
    <div class="row">
        <div class="col-12 mb-4">
            @livewire('sysadmin.dashboard-content.charts.login-activity-chart')
        </div>
    </div>

</div>


@push('css')
    <style>
        .sysadmin-dashboard .chart-container {
            position: relative;
            width: 100%;
            height: 200px;
            min-height: 200px;
            max-height: 200px;
            overflow: hidden;
        }

        .sysadmin-dashboard .chart-container-lg {
            height: 200px;
            min-height: 200px;
            max-height: 200px;
        }

        .sysadmin-dashboard .chart-container-wide {
            height: 200px;
            min-height: 200px;
            max-height: 200px;
        }

        .sysadmin-dashboard .chart-empty-state {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .sysadmin-dashboard canvas {
            display: block;
        }
    </style>
@endpush