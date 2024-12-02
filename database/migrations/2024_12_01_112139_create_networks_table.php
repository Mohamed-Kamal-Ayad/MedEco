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
        Schema::create('networks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('pharmacy_branches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('receiver_id')->nullable()->constrained('pharmacy_branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('description');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('networks');
    }
};
