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
        Schema::create('exit_awards', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); // e.g., "Certificate of Higher Education"
            $table->string('short_code')->unique(); // e.g., "CertHE"
            $table->foreignId('level_id')->constrained('levels')->restrictOnDelete();
            $table->unsignedSmallInteger('min_credits')->default(120); // Minimum credits earned
            $table->text('description')->nullable(); // Optional academic description
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit_awards');
    }
};
