<?php

use Illuminate\Support\Facades\DB;

uses(Tests\TestCase::class);

it('prints env for sanity', function () {
    dump([
        'APP_ENV'      => env('APP_ENV'),
        'DB_HOST_env'  => env('DB_HOST'),
        'DB_HOST_cfg'  => DB::connection()->getConfig('host'),
        'DB_NAME_cfg'  => DB::connection()->getConfig('database'),
        'DB_DRIVER'    => DB::getDriverName(),
    ]);

    expect(config('app.env'))->toBe('testing');
});
