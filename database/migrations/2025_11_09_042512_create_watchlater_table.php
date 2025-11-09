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
        Schema::create('watchlater', function (Blueprint $table) {
            $table->increments('watchlater_id'); // Primary key (INT)

            // Foreign key to 'user' table (INT)
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('user_id')->on('user');

            // Foreign key to 'detail_course' table (INT)
            $table->unsignedInteger('detail_course_id')->nullable();
            $table->foreign('detail_course_id')->references('detail_course_id')->on('detail_course');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchlater');
    }
};