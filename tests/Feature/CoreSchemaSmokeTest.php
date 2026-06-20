<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

it('has core academic tables', function () {
    expect(Schema::hasTable('departments'))->toBeTrue();
    expect(Schema::hasTable('programmes'))->toBeTrue();
    expect(Schema::hasTable('levels'))->toBeTrue();
    expect(Schema::hasTable('students'))->toBeTrue();
});
