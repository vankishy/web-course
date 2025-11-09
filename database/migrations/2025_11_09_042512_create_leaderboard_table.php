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
        Schema::create('leaderboard', function (Blueprint $table) {
            $table->increments('leaderboard_id'); // Primary key (INT)
            $table->integer('urutan')->nullable()->unique();
            
            // Foreign key to 'user' table (INT)
            $table->unsignedInteger('user_id')->nullable()->unique();
            $table->foreign('user_id')->references('user_id')->on('user');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderboard');
    }
};