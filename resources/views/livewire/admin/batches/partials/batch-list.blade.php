<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Batch Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\Batch::class"
            :columns="[
                        // 'id',
                        'code',
                        'programme.name',
                        'config.code',
                        'status',
                        'created_at'
                        // 'experienceType.code',
                        // 'pass_marks',
                        // 'duration',
                        // 'active',
                    ]"
             :column-labels="[
                        'code' => 'Batch Code',
                        'programme.name' => 'Programme',
                        'config.code' => 'Config Code',
                        'status' => 'Status',
                        'created_at' => 'Created On'
                    ]"
            :substitute-col-values="[
                        'status'=> [    0=>view('components.badges.inactive')->render(),
                                        1=> view('components.badges.active')->render(),
                                    ]
                    ]"

            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="name"
            :show-actions="true"
            :actionView="'livewire.admin.batches.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.batches',
                'label' => 'Export Batches',
                'filename' => 'batch_export',
                'tooltip' => 'Download batch list as Excel or CSV'
            ]"
        />
    </div>
</div>
