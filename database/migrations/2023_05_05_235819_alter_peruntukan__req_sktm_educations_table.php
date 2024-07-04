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
        Schema::table('req_sktm_educations', function (Blueprint $table) {
            $table->string('peruntukan')->nullable()->change();
            $table->string('no_kip')->nullable()->change();
        });

        Schema::table('req_sktm_healths', function (Blueprint $table) {
            $table->string('peruntukan')->nullable()->change();
            $table->string('no_kip')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_sktm_educations', function (Blueprint $table) {
            $table->string('peruntukan')->change();
            $table->string('no_kip')->change();
            
        });

        Schema::table('req_sktm_healths', function (Blueprint $table) {
            $table->string('peruntukan')->change();
            $table->string('no_kip')->change();
        });
    }
};
