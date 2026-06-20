<?php

use Database\Seeders\SpatieSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('has seeded core roles', function () {
    $this->seed(SpatieSeeder::class);

    expect(DB::table('roles')->count())->toBeGreaterThan(0);
});
