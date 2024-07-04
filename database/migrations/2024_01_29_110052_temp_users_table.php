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
        Schema::create('user_temps', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_username');
            $table->string('user_password');
            $table->string('user_email');
            $table->string('user_nik', 16);
            $table->string('user_kk', 16);
            $table->string('user_nama');
            $table->string('user_email_token');
            $table->string('user_email_expired');
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
        Schema::dropIfExists('user_temps');
    }
};
