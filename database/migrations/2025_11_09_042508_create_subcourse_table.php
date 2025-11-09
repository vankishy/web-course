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
        Schema::create('subcourse', function (Blueprint $table) {
            $table->increments('subcourse_id'); // Primary key 'subcourse_id' (INT)
            $table->string('name', 100)->nullable();
            $table->text('image_path')->nullable();
            
            // Foreign key to 'course' table (BIGINT)
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('course');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcourse');
    }
};