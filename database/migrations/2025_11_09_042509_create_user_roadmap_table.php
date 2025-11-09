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
        Schema::create('user_roadmap', function (Blueprint $table) {
            $table->increments('user_roadmap_id'); // Primary key (INT)
            $table->text('lainnya')->nullable();

            // Foreign key to 'user' table (INT)
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('user_id')->on('user');

            // Foreign key to 'roadmap' table (BIGINT)
            $table->unsignedBigInteger('roadmap_id');
            $table->foreign('roadmap_id')->references('roadmap_id')->on('roadmap');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roadmap');
    }
};