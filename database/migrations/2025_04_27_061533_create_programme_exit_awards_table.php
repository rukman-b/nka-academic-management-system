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
       
        Schema::create('programme_exit_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id')->constrained()->restrictOnDelete();
            $table->foreignId('exit_award_id')->constrained()->cascadeOnDelete();
            $table->boolean('default_award')->default(false);
            $table->timestamps();
        
            //  $table->unique(['programme_id', 'exit_award_id', 'level_id'], 'programme_exit_unique');
             $table->unique(['programme_id', 'exit_award_id'], 'programme_exit_unique');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_exit_awards');
 
    }
};
