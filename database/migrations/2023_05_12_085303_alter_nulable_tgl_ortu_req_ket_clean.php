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
        Schema::table('req_ket_cleans', function (Blueprint $table) {
            $table->date('tgl_lahir_ibu')->nullable()->change();
            $table->date('tgl_lahir_ayah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_cleans', function (Blueprint $table) {
            $table->date('tgl_lahir_ibu')->change();
            $table->date('tgl_lahir_ayah')->change();
        });
    }
};
