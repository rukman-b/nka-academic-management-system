<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('experience_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();     // e.g., IE, IS
            $table->string('label');              // e.g., Industrial Experience, International Study
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('experience_types')->insert([
            ['code' => 'IE', 'label' => 'Industrial Experience', 'status' => true],
            ['code' => 'IS', 'label' => 'International Study', 'status' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('experience_types');
    }
};
