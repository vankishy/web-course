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
        Schema::create('user', function (Blueprint $table) {
            // Sesuai gambar: 'user_id', int, auto_increment
            $table->id('user_id'); 
            
            // Sesuai gambar: 'name', varchar(100), nullable
            $table->string('name', 100)->nullable(); 
            
            // Sesuai gambar: 'email', varchar(255), nullable
            $table->string('email', 255)->nullable(); 
            
            // Sesuai gambar: 'password', varchar(255), nullable
            $table->string('password', 255)->nullable(); 
            
            // Sesuai gambar: 'created_at', 'updated_at', nullable
            // timestamps() membuat created_at dan updated_at
            $table->timestamps(); 
            
            // Sesuai gambar: 'deleted_at', timestamp, nullable
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};