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
                Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->string('address_line_1');
                $table->string('address_line_2')->nullable();
                $table->string('town_or_city');
                $table->string('county')->nullable();
                $table->string('postcode');
                $table->string('country')->default('United Kingdom');

                // Polymorphic relation
                $table->morphs('addressable'); // creates addressable_id + addressable_type

                $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
