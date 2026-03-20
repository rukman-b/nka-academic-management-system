<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();     // e.g., FT, PT
            $table->string('label');              // e.g., Full-time, Part-time
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('delivery_types')->insert([
            ['code' => 'FT', 'label' => 'Full-time', 'status' => true],
            ['code' => 'PT', 'label' => 'Part-time', 'status' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_types');
    }
};
