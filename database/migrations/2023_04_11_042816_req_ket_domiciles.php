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
        Schema::create('req_ket_domiciles', function (Blueprint $table) {
            $table->bigIncrements('req_ket_domicile_id');
            $table->string('kewarganegaraan');
            $table->date('tgl_permohonan_izin');
            $table->string('nama_organisasi')->nullable();
            $table->string('jam_kerja')->nullable();
            $table->string('status_bangunan')->nullable();
            $table->string('peruntukan_bangunan')->nullable();
            $table->string('no_imb')->nullable();
            $table->string('no_akta_pendirian')->nullable();
            $table->string('tgl_akta_pendirian')->nullable();
            $table->string('jumlah_anggota')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('keperluan');
            $table->string('no_surat')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->date('tgl_imb')->nullable();
            $table->string('masa_berlaku');
            $table->string('nip_ttd');
            $table->string('f_ttd')->nullable();
            $table->string('l_ttd')->nullable();
            $table->integer('request_id');
            $table->dateTime('created_at');
            $table->bigInteger('created_by');
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('created_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('no action');

            $table->foreign('updated_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('no action');

            $table->foreign('request_id')
                ->references('request_id')
                ->on('requests')
                ->onDelete('cascade');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('req_ket_domiciles');
    }
};
