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
        // Membuat tabel pivot 'roadmap_course'
        Schema::create('roadmap_course', function (Blueprint $table) {
            
            // Kolom untuk Foreign Key ke tabel 'roadmap'
            // Harus cocok dengan tipe data 'roadmap_id' di tabel 'roadmap'
            $table->unsignedBigInteger('roadmap_id');
            
            // Kolom untuk Foreign Key ke tabel 'course'
            // Harus cocok dengan tipe data 'course_id' di tabel 'course'
            $table->unsignedBigInteger('course_id');

            // Mendefinisikan Foreign Key Constraints
            $table->foreign('roadmap_id')
                  ->references('roadmap_id')
                  ->on('roadmap')
                  ->onDelete('cascade'); // Jika roadmap dihapus, entri ini ikut terhapus
            
            $table->foreign('course_id')
                  ->references('course_id')
                  ->on('course')
                  ->onDelete('cascade'); // Jika course dihapus, entri ini ikut terhapus

            // (Best Practice) Membuat Primary Key gabungan
            // Ini mencegah duplikat (roadmap_id + course_id yang sama)
            $table->primary(['roadmap_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadmap_course');
    }
};