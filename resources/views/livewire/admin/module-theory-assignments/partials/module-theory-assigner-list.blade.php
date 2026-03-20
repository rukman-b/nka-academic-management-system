<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Module Theories Table</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\ModuleTheory::class"
            :columns="[
                'module.name',
                'theory.title',
                'teaching_notes',
                // 'created_at',
                // 'updated_at'
            ]"
            :column-labels="[
                'module.name' => 'Module',
                'theory.title' => 'Theory',
                'teaching_notes' => 'Teaching Notes',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At'
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="module.name"
            :show-actions="true"
            :actionView="'livewire.admin.module-theory-assignments.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.module_theories',
                'label' => 'Export Assignments',
                'filename' => 'module_theories_export',
                'tooltip' => 'Download module-theory mappings as Excel or CSV'
            ]"
        />
    </div>
</div>
