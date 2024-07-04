<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('req_ket_deaths', function (Blueprint $table) {
            $table->string('nik_warga_meninggal')->nullable();
            $table->string('tmp_lahir_warga_meninggal')->nullable();
            $table->date('tgl_lahir_warga_meninggal')->nullable();
            $table->integer('jk_warga_meninggal')->nullable();
            $table->integer('id_agama_warga_meninggal')->nullable();
            $table->string('pekerjaan_warga_meninggal')->nullable();
            $table->string('alamat_warga_meninggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_deaths', function (Blueprint $table) {
            $table->dropColumn('nik_warga_meninggal');
            $table->dropColumn('tmp_lahir_warga_meninggal');
            $table->dropColumn('tgl_lahir_warga_meninggal');
            $table->dropColumn('jk_warga_meninggal');
            $table->dropColumn('id_agama_warga_meninggal');
            $table->dropColumn('pekerjaan_warga_meninggal');
            $table->dropColumn('alamat_warga_meninggal');
        });
    }
};