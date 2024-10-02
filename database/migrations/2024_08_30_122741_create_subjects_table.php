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
        Schema::create('subjects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('subject_name');
            $table->text('subject-description')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
