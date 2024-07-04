<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('req_ket_crowds', function (Blueprint $table) {
            $table->date('tgl_kegiatan_akhir')->nullable();
            $table->string('waktu_akhir', 10)->nullable();
            $table->date('tgl_surat_pernyataan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_crowds', function (Blueprint $table) {
            $table->dropColumn('tgl_kegiatan_akhir');
            $table->dropColumn('waktu_akhir');
            $table->date('tgl_surat_pernyataan');
        });
    }
};
