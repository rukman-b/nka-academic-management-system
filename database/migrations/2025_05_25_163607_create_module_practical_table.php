<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module_practical', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->restrictOnDelete();
            $table->foreignId('practical_id')->constrained()->restrictOnDelete();
            $table->string('lab_room');
            $table->text('instructor_notes')->nullable();
            $table->timestamps();

            $table->unique(['module_id', 'practical_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_practical');
    }
};
