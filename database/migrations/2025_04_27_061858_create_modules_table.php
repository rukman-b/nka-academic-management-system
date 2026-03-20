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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('module_code')->unique();
            $table->string('name');
            $table->foreignId('fheq_level_id')->constrained('levels')->restrictOnDelete();
            $table->unsignedInteger('mark');
            $table->foreignId('lecturer_id')->nullable()->constrained()->nullOnDelete(); 

            $table->text('description')->nullable();
            $table->timestamps();
        }); 
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
