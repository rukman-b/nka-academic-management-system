 <div id="datatable-scroll" class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Advanced Table View</h3>
        </div>
            <div class="card-body table-responsive">
                 <livewire:components.tables.data-table
                        :model="\App\Models\Level::class"
                        :columns="['fheq_level', 'name','created_at']"
                        :column-labels="[
                                        //   'fheq_level'                => 'Programme Name',
                                          'name'     => 'Level Name',
                                          'created_at' => 'Created On',
                                        ]"
                        :enable-search="true"
                        :enable-sort="true"
                        :enable-pagination="true"
                        :enable-export="true"
                        search-column="name"
                        :show-actions="true"
                        :actionView="'livewire.admin.levels.partials.actions'"
                        :key="$refreshKey" {{--Livewire will remount DataTable when key changes --}}
                        :export-options="[
                                            'route' => 'admin.export.levels',
                                            'label' => 'Export Levels',
                                            'filename' => 'levels_export',
                                            'tooltip' => 'Download levels list as Excel or CSV'
                                        ]"
                  />
            </div>
        </div>