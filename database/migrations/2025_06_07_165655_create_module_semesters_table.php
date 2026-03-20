<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('module_semesters', function (Blueprint $table) {
                $table->id();
                $table->foreignId('module_id')->constrained()->restrictOnDelete();
                $table->foreignId('semester_id')->constrained()->restrictOnDelete();

                // NEW FIELD to mark main/resit offering
                $table->enum('offering_type', ['main', 'resit'])->default('main');

                $table->timestamps();

                $table->unique(['module_id', 'semester_id', 'offering_type']);
            
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_semesters');
    }
};
