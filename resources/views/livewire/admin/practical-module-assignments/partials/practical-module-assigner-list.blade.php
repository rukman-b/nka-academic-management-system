    <div id="datatable-scroll" class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Module Practicals Table</h3>
        </div>
        <div class="card-body table-responsive">
            <livewire:components.tables.data-table
                :model="\App\Models\ModulePractical::class"
                :columns="[
                    'module.name',
                    'practical.title',
                    'lab_room',
                    // 'created_at',
                    // 'updated_at'
                ]"
                :column-labels="[
                    'module.name' => 'Module',
                    'practical.title' => 'Practical',
                    'lab_room' => 'Lab Room',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At'
                ]"
                :enable-search="true"
                :enable-sort="true"
                :enable-pagination="true"
                search-column="module.name"
                :show-actions="true"
                :actionView="'livewire.admin.practical-module-assignments.partials.actions'"
                :key="$refreshKey"
                :enable-export="true"
                :export-options="[
                    'route' => 'admin.export.module_practicals',
                    'label' => 'Export Assignments',
                    'filename' => 'module_practicals_export',
                    'tooltip' => 'Download module-practical mappings as Excel or CSV'
                ]"
            />
        </div>
    </div>
