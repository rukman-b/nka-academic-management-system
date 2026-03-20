<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->integer('fheq_level')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add check constraint after table creation
        DB::statement('ALTER TABLE levels ADD CONSTRAINT chk_fheq_level CHECK (fheq_level BETWEEN 3 AND 8)');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
