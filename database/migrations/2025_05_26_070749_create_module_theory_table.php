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
        Schema::create('module_theory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theory_id')->constrained()->restrictOnDelete();
            $table->foreignId('module_id')->constrained()->restrictOnDelete();
            $table->string('teaching_notes')->nullable();

            $table->timestamps();

            $table->unique(['theory_id','module_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_theory');
    }
};
