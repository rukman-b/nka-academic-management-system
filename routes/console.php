<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// ───── Custom Console Commands ─────
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


