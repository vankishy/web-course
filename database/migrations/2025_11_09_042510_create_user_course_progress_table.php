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
        Schema::create('user_course_progress', function (Blueprint $table) {
            $table->increments('user_course_progress_id'); // Primary key (INT)

            // Foreign key to 'user' table (INT)
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');

            // Foreign key to 'detail_course' table (INT)
            $table->unsignedInteger('detail_course_id');
            $table->foreign('detail_course_id')->references('detail_course_id')->on('detail_course')->onDelete('cascade');

            $table->boolean('done')->default(false);
            
            $table->timestamps();
            $table->softDeletes();

            // Unique constraint
            $table->unique(['user_id', 'detail_course_id'], 'unique_user_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_course_progress');
    }
};