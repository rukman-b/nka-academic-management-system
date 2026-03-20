<?php

use Illuminate\Support\Facades\DB;

describe('Seed Verification', function () {
    beforeEach(function () {
        $this->artisan('migrate:fresh --seed');
    });

    it('seeds 4 FHEQ  levels correctly', function () {
        $levels = DB::table('levels')->get();
        expect($levels)->toHaveCount(4);
        expect($levels->pluck('fheq_level'))->toContain(4, 5, 6, 7);
    });

    it('seeds 11 programmes correctly', function () {
        $programmes = DB::table('programmes')->get();
        expect($programmes)->toHaveCount(11);
        expect($programmes->pluck('name'))->toContain('BSc Computer Science', 'BSc Data Science');
    });

    // it('seeds programme exit awards for programme 1', function () {
    //     $awards = DB::table('programme_exit_awards')->where('programme_id', 1)->get();
    //     expect($awards)->toHaveCount(3);
    //     expect($awards->pluck('award_title'))
    //         ->toContain('CertHE', 'DipHE', 'BSc (Hons)');
    // }); //Old version no longer been used

    it('seeds skill categories and skills correctly', function () {
        $categories = DB::table('skill_categories')->get();
        $skills = DB::table('skills')->get();
        expect($categories)->toHaveCount(5);
        expect($skills)->toHaveCount(10);
        expect($skills->pluck('name'))->toContain('Written Communication', 'Programming in Python');
    });

    it('links batch 1 with students and modules correctly', function () {
        $batchStudents = DB::table('batch_student')->where('batch_id', 1)->get();
        $batchModules = DB::table('batch_level_module')->where('batch_id', 1)->get();

        expect($batchStudents)->not->toBeEmpty();
        expect($batchModules)->not->toBeEmpty();
    });

    // it('verifies exit award has been issued to student 1', function () {
    //     $award = DB::table('student_exit_awards')->where('student_id', 1)->first();
    //     expect($award)->not->toBeNull();
    // }); //Old version no long been used

    it('seeds 10 configs correctly', function () {
        $configs = DB::table('configs')->get();
        // expect($configs)->toHaveCount(10);
        expect($configs)->toHaveCount(11);
        expect($configs->pluck('delivery_method'))->toContain('Online', 'NKA premises', 'Hybrid');
    });

    it('seeds 10 lecturers correctly', function () {
        $lecturers = DB::table('lecturers')->get();
        expect($lecturers)->toHaveCount(10);
        expect($lecturers->pluck('department'))->toContain('CS', 'Business', 'Hospitality');
    });
    
    it('seeds 20 config-level-modules records correctly', function () {
        $records = DB::table('config_level_modules')->get();
        expect($records)->toHaveCount(20);
        expect($records->pluck('is_optional')->map(fn($v) => (bool)$v))->toContain(true);
    });    

    it('seeds 11 batches correctly', function () {
        $batches = DB::table('batches')->get();
        expect($batches)->toHaveCount(11);
        foreach ($batches->pluck('code') as $code) {
            expect($code)->toMatch('/^B-2025-\\d{3}$/');
        }
    });

    it('seeds programme exit awards correctly', function () {
        $exitAwards = DB::table('programme_exit_awards')->get();
    
        expect($exitAwards->count())->toBeGreaterThan(0);
    
        $sample = $exitAwards->first();
        expect($sample)->toHaveKeys(['programme_id', 'level_id', 'award_title']);
    });


    it('seeds student_exit_awards correctly', function () {
        $count = DB::table('student_exit_awards')->count();
        expect($count)->toBeGreaterThan(0); // or use toBe(x) if exact expected count is known
    
        $record = DB::table('student_exit_awards')->first();
        expect($record)->toHaveKeys(['student_id', 'programme_exit_award_id', 'awarded_at']);
    });

    it('seeds student optional modules correctly', function () {
        $this->seed(\Database\Seeders\StudentOptionalModuleSeeder::class);
    
        $count = \App\Models\StudentOptionalModule::count();
        expect($count)->toBeGreaterThan(0);
    
        $module = \App\Models\StudentOptionalModule::first();
        expect($module->student)->not->toBeNull();
        expect($module->configLevelModule)->not->toBeNull();
    });
    
    
    
});
