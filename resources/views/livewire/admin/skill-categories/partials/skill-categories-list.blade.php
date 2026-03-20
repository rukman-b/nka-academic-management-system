<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Skill Categories Table View</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\SkillCategory::class"
            :columns="['id', 'name']"
            :column-labels="[
                'name' => 'Category Name',
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            :enable-export="true"
            search-column="name"
            :show-actions="true"
            :actionView="'livewire.admin.skill-categories.partials.actions'"
            :key="$refreshKey"
            :export-options="[
                'route' => 'admin.export.skill-categories',
                'label' => 'Export Categories',
                'filename' => 'skill_categories_export',
                'tooltip' => 'Download skill categories as Excel or CSV'
            ]"
        />
    </div>
</div>
