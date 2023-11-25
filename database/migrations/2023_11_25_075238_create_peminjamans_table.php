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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('denda');
            $table->text('kondisi_buku');
            $table->enum('konfirmasi_pinjam',['tertunda','ditolak','diterima']);
            $table->enum('konfirmasi_kembali',['tertunda','ditolak','diterima']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('sekolah_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('restrict');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};