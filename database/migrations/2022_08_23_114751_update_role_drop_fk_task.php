<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoleDropFkTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_roles', function (Blueprint $table) {
           $table->dropForeign('sys_roles_task_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_roles', function($table) {
            $table->foreign('task_id')
                ->references('task_id')
                ->on('sys_tasks')
                ->onDelete('cascade');
        });
    }
}
