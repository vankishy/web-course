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
        Schema::create('roadmap', function (Blueprint $table) {
            $table->bigIncrements('roadmap_id'); // Primary key is 'roadmap_id' (BIGINT)
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable()->unique();
            $table->text('description')->nullable();
            $table->timestamps();
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