<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_roles', function (Blueprint $table) {
            $table->bigIncrements('role_id');
            $table->bigInteger('task_id');
            $table->string('group_id', 50);
            $table->dateTime('created_at');
            $table->bigInteger('created_by');
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('created_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('updated_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('task_id')
                ->references('task_id')
                ->on('sys_tasks')
                ->onDelete('cascade');

            $table->foreign('group_id')
                ->references('group_id')
                ->on('sys_user_groups')
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
        Schema::dropIfExists('sys_roles');
    }
}
