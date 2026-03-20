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
        Schema::create('scheduler_logs', function (Blueprint $table) {
        $table->id();
        $table->string('command');
        $table->timestamp('started_at');
        $table->timestamp('finished_at')->nullable();
        $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        $table->text('output')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduler_logs');
    }
};
