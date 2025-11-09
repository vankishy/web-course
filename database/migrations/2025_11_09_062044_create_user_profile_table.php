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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user', 'user_id')->onDelete('cascade');
            $table->json('lainnya')->nullable(); 
            $table->timestamps();

            // ▼▼▼ TAMBAHKAN BARIS INI ▼▼▼
            $table->softDeletes(); 
            // ▲▲▲ -------------------- ▲▲▲
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};