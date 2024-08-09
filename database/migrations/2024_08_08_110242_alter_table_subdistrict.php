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
        Schema::table('m_sub_districts', function (Blueprint $table) {
            $table->char('unit_key_kec', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_sub_districts', function (Blueprint $table) {
            $table->dropColumn('unit_key_kec')->nullable();
        });
    }
};
