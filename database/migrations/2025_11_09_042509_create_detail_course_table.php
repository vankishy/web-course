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
        Schema::create('detail_course', function (Blueprint $table) {
            $table->increments('detail_course_id'); // Primary key 'detail_course_id' (INT)
            $table->string('name', 100)->nullable();
            $table->enum('type', ['PDF', 'Video'])->nullable();
            $table->text('path')->nullable();

            // Foreign key to 'subcourse' table (INT)
            $table->unsignedInteger('subcourse_id')->nullable();
            $table->foreign('subcourse_id')->references('subcourse_id')->on('subcourse');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_course');
    }
};