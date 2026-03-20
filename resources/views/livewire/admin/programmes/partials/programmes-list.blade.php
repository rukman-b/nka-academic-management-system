 <div id="datatable-scroll" class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Advanced Table View</h3>
        </div>
        <div class="card-body table-responsive">
            <livewire:components.tables.data-table
                :model="\App\Models\Programme::class"
                :columns="['id', 'name', 'short_name', 'department.name','created_at']"
                :column-labels="[
                    'name' => 'Programme Name',
                    'short_name' => 'Short Code',
                    'department.name' => 'Department Name',
                    'created_at' => 'Created On'
                ]"
                :enable-search="true"
                :enable-sort="true"
                :enable-pagination="true"
                :enable-export="true"
                search-column="name"
                :show-actions="true"
                :actionView="'livewire.admin.programmes.partials.actions'"
                :key="$refreshKey"
                :export-options="[
                    'route' => 'admin.export.programmes',
                    'label' => 'Export Programmes',
                    'filename' => 'programmes_export',
                    'tooltip' => 'Download programmes list as Excel or CSV'
                ]"
            />
        </div>
    </div>