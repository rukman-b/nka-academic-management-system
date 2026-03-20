<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Theories Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\Theory::class"
            :columns="['title', 'department.name']"
            :column-labels="[
                'title' => 'Theory',
                'department.name' => 'Department Name'
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            :enable-export="true"
            search-column="title"
            :show-actions="true"
            :actionView="'livewire.admin.theories.partials.actions'"
            :key="$refreshKey"
            :export-options="[
                'route' => 'admin.export.theories',
                'label' => 'Export Theories',
                'filename' => 'theories_export',
                'tooltip' => 'Download Theories list as Excel or CSV'
            ]"
        />
    </div>
</div>
