<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Module Semester Assignments</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\ModuleSemester::class"
            :columns="[
                'module.name',
                'semester.name',
                'semester.academic_year',
                'offering_type',
                'created_at'
            ]"
            :column-labels="[
                'module.name' => 'Module',
                'semester.name' => 'Semester',
                'semester.academic_year' => 'Academic Year',
                'offering_type' => 'Type',
                'created_at' => 'Assigned On'
            ]"
            {{-- :substitute-col-values="[
                'offering_type' => [
                    'main' => view('components.badges.active', ['label' => 'Main'])->render(),
                    'resit' => view('components.badges.warning', ['label' => 'Resit'])->render(),
                ]
            ]" --}}
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="module.name"
            :show-actions="true"
            :actionView="'livewire.admin.module-semester-assignments.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.module-semesters',
                'label' => 'Export Module Semesters',
                'filename' => 'module_semester_export',
                'tooltip' => 'Download module-semester assignments as Excel or CSV'
            ]"
        />
    </div>
</div>
