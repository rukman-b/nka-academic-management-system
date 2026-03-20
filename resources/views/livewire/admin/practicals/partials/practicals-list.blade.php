 <div id="datatable-scroll" class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Advanced Table View</h3>
        </div>
        <div class="card-body table-responsive">
        <livewire:components.tables.data-table
                :model="\App\Models\Practical::class"
                :columns="['title','department.name']"
                :column-labels="[
                                  'title' => 'Practical',
                                  'department.name' => 'Department Name',
                                ]"
                :enable-search="true"
                :enable-sort="true"
                :enable-pagination="true"
                :enable-export="true"
                search-column="title"
                :show-actions="true"
                :actionView="'livewire.admin.practicals.partials.actions'"
                :key="$refreshKey" {{--Livewire will remount DataTable when key changes --}}
                :export-options="[
                                    'route' => 'admin.export.practicals',
                                    'label' => 'Export Practicals',
                                    'filename' => 'practicals_export',
                                    'tooltip' => 'Download Practicals list as Excel or CSV'
                                ]"
          />

        </div>
    </div>