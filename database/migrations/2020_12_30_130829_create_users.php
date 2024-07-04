<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_username')->unique();
            $table->string('user_password');
            $table->string('user_phone')->nullable();
            $table->string('user_email');
            $table->string('user_nik', 16)->unique();
            $table->string('user_kk', 16);
            $table->string('user_nama');
            $table->string('user_id_agama')->nullable();
            $table->string('user_tmp_lahir')->nullable();
            $table->string('user_tgl_lahir')->nullable();
            $table->integer('user_id_jenkel')->nullable();
            $table->string('user_pekerjaan')->nullable();
            $table->string('kd_kec')->nullable();
            $table->string('kd_kel')->nullable();
            $table->string('user_rw')->nullable();
            $table->string('user_rt')->nullable();
            $table->string('user_alamat')->nullable();
            $table->boolean('user_is_simkel')->default('0');
            $table->string('user_id_simkel')->nullable();
            $table->string('group_id', 50)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

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
        Schema::dropIfExists('users');
    }
}
