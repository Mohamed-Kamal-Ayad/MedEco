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
        Schema::create('pharmacy_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_id')->references('id')->on('pharmacies')->cascadeOnDelete();
            $table->string('phone');
            $table->string('address');
            $table->string('commercial_registration_number');
            $table->string('tax_number');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_branches');
    }
};
