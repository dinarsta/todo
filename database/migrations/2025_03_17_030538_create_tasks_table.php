<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_task', 255);
            $table->text('deskripsi');
            $table->enum('prioritas', ['Rendah', 'Sedang', 'Tinggi'])->default('Sedang');
            $table->unsignedBigInteger('dikerjakan_oleh');
            $table->foreign('dikerjakan_oleh')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['Baru', 'Proses', 'Pending', 'Selesai'])->default('Baru');
            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
