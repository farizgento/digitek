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
        Schema::table('peminjamans',function(Blueprint $table){
                $table->date('tanggal_pengembalian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('peminjamans', function($table) {
            $table->dropForeign(['sekolah_id']);
            $table->dropColumn('sekolah_id');
        });
    }
};
