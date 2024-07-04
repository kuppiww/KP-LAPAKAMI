<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Requests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('request_id');
            $table->string('service_id');
            $table->string('request_status_id');
            $table->string('nik', 16)->nullable();
            $table->string('no_kk', 16)->nullable();
            $table->string('id_agama')->nullable();
            $table->string('tmp_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('id_jenkel')->nullable();
            $table->string('nama_warga', 50)->nullable();
            $table->string('kd_kel', 10);
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('pekerjaan', 30)->nullable();
            $table->string('no_surat_pengantar', 50)->nullable();
            $table->date('tgl_surat_pengantar')->nullable();
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

            $table->foreign('request_status_id')
                ->references('request_status_id')
                ->on('request_status')
                ->onDelete('cascade');
            
            $table->foreign('service_id')
                ->references('service_id')
                ->on('services')
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
        Schema::dropIfExists('requests');
    }
}
