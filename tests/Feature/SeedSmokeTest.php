<?php

use Illuminate\Support\Facades\DB;

it('has seeded core roles', function () {
    expect(DB::table('roles')->count())->toBeGreaterThan(0);
});
