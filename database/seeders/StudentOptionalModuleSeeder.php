<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentOptionalModule;
use App\Models\Student;
use App\Models\ConfigLevelModule;

class StudentOptionalModuleSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::with('batches.config.configLevelModules')->get();

        foreach ($students as $student) {
            foreach ($student->batches as $batch) {
                $config = $batch->config;

                if (!$config) {
                    continue; // skip if config is missing
                }

                $optionalModules = $config->configLevelModules
                    ->where('is_optional', true);

                $selections = collect($optionalModules)
                    ->shuffle()
                    ->take(rand(1, 3));

                foreach ($selections as $module) {
                    StudentOptionalModule::firstOrCreate([
                        'student_id' => $student->id,
                        'config_level_module_id' => $module->id,
                    ], [
                        'selected_at' => now(),
                    ]);
                }
            }
        }
    }
}
