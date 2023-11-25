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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('penulis')->nullable();
            $table->string('penerbitan')->nullable();
            $table->string('edisi')->nullable();
            $table->string('bulan')->nullable();
            $table->string('isbn')->nullable();
            $table->string('subyek')->nullable();
            $table->string('jenis');
            $table->string('path')->nullable();
            $table->string('volume')->nullable();
            $table->string('sampul_buku');

            $table->unsignedBigInteger('lokasi_buku_id');
            $table->unsignedBigInteger('tipe_buku_id');
            $table->unsignedBigInteger('jenis_buku_id');
            $table->unsignedBigInteger('sekolah_id');

            $table->foreign('lokasi_buku_id')->references('id')->on('lokasi_bukus')->onDelete('cascade');
            $table->foreign('tipe_buku_id')->references('id')->on('tipe_bukus')->onDelete('cascade');
            $table->foreign('jenis_buku_id')->references('id')->on('jenis_bukus')->onDelete('cascade');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
