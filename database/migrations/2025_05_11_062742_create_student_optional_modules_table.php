<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        //We will implement this later
        // Schema::create('student_optional_modules', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('student_id')->constrained()->restrictOnDelete();
        //     $table->foreignId('config_level_module_id')->constrained()->restrictOnDelete();
        //     $table->timestamp('selected_at')->nullable();
        //     $table->timestamps();

        //     $table->unique(['student_id', 'config_level_module_id'], 'unique_student_optional_module'); 
        // });
    }

    public function down(): void
    {
        // Schema::dropIfExists('student_optional_modules');
    }
};
