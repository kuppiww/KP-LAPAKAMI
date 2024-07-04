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
        Schema::table('req_ket_domiciles', function (Blueprint $table) {
            $table->string('jenis_usaha')->nullable();
            $table->string('alamat')->nullable();
            $table->string('status_bangunan', 10)->nullable()->change();
            $table->string('peruntukan_bangunan')->nullable()->change();
            $table->string('no_imb')->nullable()->change();
            $table->string('no_akta_pendirian')->nullable()->change();
            $table->string('tgl_akta_pendirian')->nullable()->change();
            $table->string('penanggung_jawab')->nullable()->change();
            $table->string('masa_berlaku')->nullable()->change();
            $table->string('tgl_imb')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_domiciles', function (Blueprint $table) {
            $table->dropColumn('jenis_usaha');
            $table->dropColumn('alamat');
            $table->string('status_bangunan', 10)->change();
            $table->string('peruntukan_bangunan')->change();
            $table->string('no_imb')->change();
            $table->string('no_akta_pendirian')->change();
            $table->string('tgl_akta_pendirian')->change();
            $table->string('penanggung_jawab')->change();
            $table->string('masa_berlaku')->change();
            $table->string('tgl_imb')->change();
        });
    }
};
