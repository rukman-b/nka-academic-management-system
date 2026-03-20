<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Semester Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\Semester::class"
            :columns="[
                'name',
                'academic_year',
                'start_date',
                'end_date',
                'created_at'
            ]"
            :column-labels="[
                'name' => 'Semester',
                'academic_year' => 'Academic Year',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',
                'created_at' => 'Created On'
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="academic_year"
            :show-actions="true"
            :actionView="'livewire.admin.semesters.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.semesters',
                'label' => 'Export Semesters',
                'filename' => 'semester_export',
                'tooltip' => 'Download semester list as Excel or CSV'
            ]"
        />
    </div>
</div>
