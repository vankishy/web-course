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
        // Membuat tabel bernama 'roadmap' sesuai Model Anda
        Schema::create('roadmap', function (Blueprint $table) {
            
            // Sesuai gambar: 'roadmap_id', bigint unsigned, auto_increment
            $table->id('roadmap_id');
            
            // Sesuai gambar: 'name', varchar(255), nullable
            $table->string('name')->nullable();
            
            // Sesuai gambar: 'slug', varchar(255), nullable
            $table->string('slug')->nullable();
            
            // Sesuai gambar: 'description', text, nullable
            $table->text('description')->nullable();
            
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
        Schema::dropIfExists('roadmap');
    }
};