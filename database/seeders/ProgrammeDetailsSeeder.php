<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            ProgrammeSeeder::class,
            LevelSeeder::class,
            BatchSeeder::class,
            ModuleSeeder::class,
            ModuleDepartmentSeeder::class,
            SkillCategorySeeder::class,
            SkillSeeder::class,
            BatchStudentSeeder::class,
            BatchLevelModuleSeeder::class,
            PracticalSeeder::class,
            TheorySeeder::class,
            ConfigSeeder::class,
            ConfigLevelModuleSeeder::class,
            ProgrammeExitAwardSeeder::class, 
            StudentExitAwardSeeder::class,
        ]);
    }

}
