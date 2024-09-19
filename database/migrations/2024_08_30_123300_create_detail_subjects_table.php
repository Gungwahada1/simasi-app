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
        Schema::create('detail_subjects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained('students');
            $table->foreignUuid('subject_id')->constrained('subjects');
            $table->timestamp('created_at');
            $table->timestamp('created_by');
            $table->timestamp('updated_at');
            $table->timestamp('updated_by');
            $table->timestamp('deleted_at');
            $table->timestamp('deleted_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_subjects');
    }
};
