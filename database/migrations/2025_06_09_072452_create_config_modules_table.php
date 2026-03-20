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
        Schema::create('config_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('config_id')->constrained('configs')->restrictOnDelete();
            $table->foreignId('module_id')->constrained()->restrictOnDelete();
            $table->boolean('is_optional')->default(false);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_modules');
    }
};
