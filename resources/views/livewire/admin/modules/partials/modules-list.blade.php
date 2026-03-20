<div id="datatable-scroll" class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Existing Modules</h3>
        </div>
        <div class="card-body table-responsive">
        <livewire:components.tables.data-table
                :model="\App\Models\Module::class"
                :columns="['module_code', 'name','fheqLevel.name','mark','departments_list','created_at']"
                :column-labels="[
                                  'name' => 'Module Name',
                                  'module_code' => 'Code',
                                  'fheqLevel.name' => 'FHEQ Level',
                                  'mark' => 'Mark',
                                  'created_at'=> 'Created On'
                                ]"
                :enable-search="true"
                :enable-sort="true"
                :enable-pagination="true"
                :enable-export="true"
                search-column="module_code"
                :show-actions="true"
                :actionView="'livewire.admin.modules.partials.actions'"
                :key="$refreshKey" {{--Livewire will remount DataTable when key changes --}}
                :export-options="[
                                    'route' => 'admin.export.modules',
                                    'label' => 'Export Departments',
                                    'filename' => 'departments_export',
                                    'tooltip' => 'Download departments list as Excel or CSV'
                                ]"
          />

        </div>
    </div>