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
        Schema::table('req_ket_bussiness', function (Blueprint $table) {
            $table->string('nama_usaha')->nullable()->change();
            $table->string('tlp_tmp_usaha')->nullable()->change();
            $table->string('status_bangunan')->nullable()->change();
            $table->string('keperluan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_bussiness', function (Blueprint $table) {
            $$table->string('nama_usaha')->change();
            $table->string('tlp_tmp_usaha')->change();
            $table->string('status_bangunan')->change();
            $table->string('keperluan')->change();
        });
    }
};
