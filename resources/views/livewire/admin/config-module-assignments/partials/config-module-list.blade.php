<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Config Modules Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\ConfigModule::class"
            :columns="[
                'config.code',
                'module.name',
                'is_optional',
                'created_at'
            ]"
            :column-labels="[
                'config.code' => 'Config Code',
                'module.name' => 'Module Name',
                'is_optional' => 'Optional?',
                'created_at' => 'Assigned On'
            ]"
            {{-- :substitute-col-values="[
                'is_optional'=> [
                    0 => view('components.badges.inactive')->render(),
                    1 => view('components.badges.active')->render()
                ]
            ]" --}}
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="module.name"
            :show-actions="true"
            :actionView="'livewire.admin.batch-students-assignments.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.config-modules',
                'label' => 'Export Config-Modules',
                'filename' => 'config_module_export',
                'tooltip' => 'Download assigned modules list as Excel or CSV'
            ]"
        />
    </div>
</div>
