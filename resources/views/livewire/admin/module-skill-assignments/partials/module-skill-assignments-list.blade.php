<div id="datatable-scroll" class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Module-Skill Assignments</h3>
    </div>
    <div class="card-body table-responsive">
        <livewire:components.tables.data-table
            :model="\App\Models\ModuleSkill::class"
            :columns="[
                'module.name',
                'skill.name',
                'skill.skillCategory.name',
                // 'created_at',
                // 'updated_at'
            ]"
            :column-labels="[
                'module.name' => 'Module',
                'skill.name' => 'Skill',
                'skill.skillCategory.name' => 'Skill Category',
                'created_at' => 'Assigned At',
                'updated_at' => 'Last Updated'
            ]"
            :enable-search="true"
            :enable-sort="true"
            :enable-pagination="true"
            search-column="module.name"
            :show-actions="true"
            :actionView="'livewire.admin.module-skill-assignments.partials.actions'"
            :key="$refreshKey"
            :enable-export="true"
            :export-options="[
                'route' => 'admin.export.module_skills',
                'label' => 'Export Module-Skills',
                'filename' => 'module_skills_export',
                'tooltip' => 'Download all module-skill mappings as Excel or CSV'
            ]"
        />
    </div>
</div>