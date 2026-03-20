{{-- <div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Configuration Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\Config::class"
            :columns="[
                        // 'id',
                        'name',
                        'programme.name',
                        'deliveryType.code',
                        'experienceType.code',
                        'pass_marks', 
                        'duration',
                        'status',
                    ]"
                    :column-labels="[
                        'name' => 'Config Code',
                        'programme.name' => 'Programme',
                        'deliveryType.code' => 'Delivery',
                        'experienceType.code' => 'Experience',
                        'pass_marks' => 'Pass Mark',
                        // 'active' => 'Status',
                        'duration' => 'Duration'
                    ]"
                    :substitute-col-values="[
                        'status'=> [0=>'inactive',1=> 'active',]
                    ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="name"
            :show-actions="true"
            :actionView="'livewire.admin.configs.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.configs',
                'label' => 'Export Configs',
                'filename' => 'configs_export',
                'tooltip' => 'Download config list as Excel or CSV'
            ]"
        />
    </div>
</div> --}}


<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Configuration Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\Config::class"
            :columns="[
                'code',
                'programme.name',
                'pass_marks', 
                'status',
            ]"
            :column-labels="[
                'code' => 'Config Code',
                'programme.name' => 'Programme',
                'pass_marks' => 'Pass Mark',
            ]"
            :substitute-col-values="[
                        'status'=> [    0=>view('components.badges.inactive')->render(),
                                        1=> view('components.badges.active')->render(),
                                    ]
                    ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="code"
            :show-actions="true"
            :actionView="'livewire.admin.configs.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.configs',
                'label' => 'Export Configs',
                'filename' => 'configs_export',
                'tooltip' => 'Download config list as Excel or CSV'
            ]"
        />

    </div>
</div>
