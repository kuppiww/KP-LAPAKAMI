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
        Schema::table('req_ket_comp_domiciles', function (Blueprint $table) {
            $table->string('jenis_usaha')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('jml_karyawan')->nullable();
            $table->string('jam_kerja')->nullable();
            $table->string('status_bangunan', 10)->nullable()->change();
            $table->string('no_imb')->nullable()->change();
            $table->string('penanggung_jawab')->nullable()->change();
            $table->string('masa_berlaku')->nullable()->change();
            $table->string('tgl_imb')->nullable()->change();
            $table->string('tlp_perusahaan')->nullable()->change();
            $table->string('no_akta_notaris')->nullable()->change();
            $table->string('tgl_akta_notaris')->nullable()->change();
            $table->string('no_sk_kehakiman')->nullable()->change();
            $table->string('tgl_surat_pernyataan')->nullable()->change();
            $table->string('tgl_perusahaan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_comp_domiciles', function (Blueprint $table) {
            $table->dropColumn('jenis_usaha');
            $table->dropColumn('alamat');
            $table->dropColumn('jml_karyawan');
            $table->dropColumn('jam_kerja');
            $table->string('status_bangunan', 10)->change();
            $table->string('no_imb')->change();
            $table->string('penanggung_jawab')->change();
            $table->string('masa_berlaku')->change();
            $table->string('tgl_imb')->change();
            $table->string('tlp_perusahaan')->change();
            $table->string('no_akta_notaris')->change();
            $table->string('tgl_akta_notaris')->change();
            $table->string('no_sk_kehakiman')->change();
            $table->string('tgl_surat_pernyataan')->change();
            $table->string('tgl_perusahaan')->change();
        });
    }
};
