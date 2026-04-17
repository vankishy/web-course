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
        // Membuat tabel bernama 'course' sesuai Model Anda
        Schema::create('course', function (Blueprint $table) {
            
            // Sesuai gambar: 'course_id', bigint unsigned, auto_increment
            $table->id('course_id');
            
            // Sesuai gambar: 'name', varchar(255), nullable
            $table->string('name')->nullable();
            
            // Sesuai gambar: 'desc', text, nullable
            $table->text('desc')->nullable();
            
            // Sesuai gambar: 'image_path', text, nullable
            $table->text('image_path')->nullable();
            
            // Sesuai gambar: 'created_at' dan 'updated_at', timestamp, nullable
            $table->timestamps();
            
            // Sesuai gambar: 'deleted_at', timestamp, nullable
            // Ini juga cocok dengan 'use SoftDeletes' di Model Anda
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};