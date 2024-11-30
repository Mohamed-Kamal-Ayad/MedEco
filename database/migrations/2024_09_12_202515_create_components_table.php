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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('component_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id');
            $table->foreign('component_id')->on('components')->references('id')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->unique(['locale', 'component_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_translations');
        Schema::dropIfExists('components');
    }
};
