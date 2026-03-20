<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Skills Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\Skill::class"
            :columns="['id', 'name', 'skillCategory.name']"
            :column-labels="[
                'name' => 'Skill Name',
                'skillCategory.name' => 'Category',
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            :enable-export="true"
            search-column="name"
            :show-actions="true"
            :actionView="'livewire.admin.skills.partials.actions'"
            :key="$refreshKey"
            :export-options="[
                'route' => 'admin.export.skills',
                'label' => 'Export Skills',
                'filename' => 'skills_export',
                'tooltip' => 'Download skills list as Excel or CSV'
            ]"
        />
    </div>
</div>
