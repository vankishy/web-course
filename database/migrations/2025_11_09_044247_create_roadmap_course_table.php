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
        // This is the missing pivot table
        Schema::create('roadmap_course', function (Blueprint $table) {
            
            // Foreign key to 'roadmap' table (BIGINT)
            $table->unsignedBigInteger('roadmap_id');
            $table->foreign('roadmap_id')->references('roadmap_id')->on('roadmap')->onDelete('cascade');

            // Foreign key to 'course' table (BIGINT)
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('course')->onDelete('cascade');

            // Set the primary key to be the combination of both IDs
            $table->primary(['roadmap_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadmap_course');
    }
};