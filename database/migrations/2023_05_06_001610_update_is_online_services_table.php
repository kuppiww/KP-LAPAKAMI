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
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_online')->default(true);
            $table->boolean('is_select')->default(true);
            $table->boolean('is_show_front')->default(true);
            $table->integer('position')->default(0);

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
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('is_online');
            $table->dropColumn('is_select');
            $table->dropColumn('is_show_front');
            $table->dropColumn('position');
        });
    }
};
