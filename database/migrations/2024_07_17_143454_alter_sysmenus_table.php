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
        Schema::table('sys_menus', function (Blueprint $table) {
            $table->dropColumn(['menu_level']);
        });
    
        Schema::table('sys_menus', function (Blueprint $table) {
            $table->boolean('menu_is_sub')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_menus', function (Blueprint $table) {
            $table->smallInteger('menu_level');
        });

        Schema::table('sys_menus', function (Blueprint $table) {
            $table->dropColumn(['menu_is_sub']);
        });
    
    }
};
