@section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle)


@section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle)


    <div class="container-fluid">
        <div class="row chart-card-equal-height">
            <div class="col-md-6">
               @livewire('sysadmin.dashboard-content.charts.users-by-role-chart')
            </div>
            <div class="col-md-6">
                @livewire('sysadmin.dashboard-content.charts.login-activity-chart')
            </div>
        </div>

        <div class="row chart-card-equal-height mt-3">
            
            <div class="col-md-6">
                @livewire('sysadmin.dashboard-content.charts.scheduler-health-chart')
            </div>
            <div class="col-md-6">
                @livewire('sysadmin.dashboard-content.charts.cache-usage-chart')
            </div>
        </div>
    </div>


@push('css')
    <style>
        
        .chart-card-equal-height .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }
    </style>
@endpush