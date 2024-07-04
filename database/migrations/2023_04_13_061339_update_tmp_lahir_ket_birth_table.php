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
        Schema::table('req_ket_births', function (Blueprint $table) {
            $table->string('tmp_lahir_anak', 50);
            $table->integer('id_jenkel_anak');

            $table->foreign('id_jenkel_anak')
                ->references('id_gender')
                ->on('m_gender')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_births', function($table) {
            $table->dropColumn('tmp_lahir_anak');
            $table->dropColumn('id_jenkel_anak');
        });
    }
};
