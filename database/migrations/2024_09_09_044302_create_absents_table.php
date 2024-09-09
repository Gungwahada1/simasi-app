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
        Schema::create('absents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('detail_subject_id')->constrained('detail_subjects');
            $table->enum('status', ['Present', 'Permission', 'Sick', 'Alpha'])->nullable();
            $table->timestamp('subject_start_datetime')->nullable();
            $table->timestamp('subject_end_datetime')->nullable();
            $table->text('proof_photo_start')->nullable();
            $table->text('proof_photo_end')->nullable();
            $table->string('location_start')->nullable();
            $table->string('location_end')->nullable();
            $table->text('daily_report')->nullable();
            $table->text('daily_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absents');
    }
};
