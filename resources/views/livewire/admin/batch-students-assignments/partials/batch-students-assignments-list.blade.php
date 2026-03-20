<div class="card card-secondary mt-3">
    <div class="card-header">
        <h3 class="card-title">Existing Batch Assignments</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\BatchStudent::class"
            :columns="[
                'student.name',
                'batch.code',
                'batch.programme.name',
                'status',
                'created_at'
            ]"
            :column-labels="[
                'student.name' => 'Student',
                'batch.code' => 'Batch',
                'batch.programme.name' => 'Programme',
                'status' => 'Status',
                'created_at' => 'Assigned At'
            ]"
            :substitute-col-values="[
                'status' => [
                    'active' => view('components.badges.active')->render(),
                    'completed' => view('components.badges.completed')->render(),
                    'exit' => view('components.badges.exit')->render(),
                    'paused' => view('components.badges.paused')->render()
                ]
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="student.name"
            :show-actions="true"
            :actionView="'livewire.admin.batch-students-assignments.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                        'route' => 'admin.export.batch-assignments',
                        'label' => 'Export Assignments',
                        'filename' => 'batch_assignments_export',
                        'tooltip' => 'Download batch-student assignments as Excel or CSV'
                    ]"
        />
    </div>
</div>
