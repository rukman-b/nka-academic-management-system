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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->unique(); // e.g., BSC_CS, MSC_CHEM
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->foreignId('starting_level_id')->constrained('levels')->restrictOnDelete();
            $table->foreignId('offered_level_id')->constrained('levels')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};