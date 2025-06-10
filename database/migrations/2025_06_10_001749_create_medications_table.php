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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained('prescriptions')->onDelete('cascade');
            $table->string('medicine_name', 255);
            $table->string('dosage', 255);
            $table->enum('frequency_type', ['daily', 'weekly', 'monthly', 'every_x_days']);
            $table->integer('frequency_count')->unsigned()->min(1);
            $table->json('specific_times')->nullable();
            $table->json('specific_days')->nullable();
            $table->enum('duration_type', ['days', 'weeks', 'months', 'indefinite']);
            $table->integer('duration_value')->nullable();
            $table->date('start_date');
            $table->softDeletes();
            $table->timestamps();

            $table->index('prescription_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medications');
    }
};
