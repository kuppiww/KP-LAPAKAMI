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
        Schema::create('sys_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_username')->unique();
            $table->string('user_name')->unique();
            $table->string('user_password');
            $table->string('user_phone')->nullable();
            $table->string('user_email');
            $table->string('user_nip', 18)->unique();
            $table->string('kd_kec')->nullable();
            $table->string('kd_kel')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('sys_users');
    }
};
