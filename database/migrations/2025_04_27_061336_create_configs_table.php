<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id')->constrained()->restrictOnDelete();
            // $table->foreignId('delivery_type_id')->constrained()->restrictOnDelete(); // new
            // $table->foreignId('experience_type_id')->nullable()->constrained()->restrictOnDelete(); // new
            $table->string('code')->unique();
            $table->text('description')->nullable();
            // $table->string('duration');
            // $table->string('delivery_method');
            // $table->string('language');
            $table->unsignedTinyInteger('pass_marks');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
