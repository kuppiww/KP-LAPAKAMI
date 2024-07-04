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
        Schema::create('req_sktm_healths', function (Blueprint $table) {
            $table->bigIncrements('req_sktm_health_id');
            $table->string('nama_pasien');
            $table->text('tmp_lahir_pasien');
            $table->date('tgl_lahir_pasien');
            $table->integer('id_hub_kel')->nullable();
            $table->string('peruntukan');
            $table->string('no_surat')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->string('no_kip');
            $table->string('no_jamkesmas')->nullable();
            $table->integer('id_rumkit');
            $table->date('masa_berlaku')->nullable();
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
        Schema::dropIfExists('req_sktm_healths');
    }
};
