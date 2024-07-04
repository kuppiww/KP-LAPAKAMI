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
        Schema::table('req_ket_andon_merrieds', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_births', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_bussiness', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_cleans', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_comp_domiciles', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_crowds', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_deaths', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_domiciles', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_house', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_merrieds', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_mv_house', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_pilgrim_domicile', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_skck', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_ket_widow', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_sktm_educations', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_sktm_healths', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_sktm_judiciarys', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });

        Schema::table('req_sktm_plns', function (Blueprint $table) {
            $table->string('nip_ttd', 18)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('req_ket_andon_merrieds', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_births', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_bussiness', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_cleans', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_comp_domiciles', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_crowds', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_deaths', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_domiciles', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_house', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_merrieds', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_mv_house', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_pilgrim_domicile', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_skck', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_ket_widow', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_sktm_educations', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_sktm_healths', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_sktm_judiciarys', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });

        Schema::table('req_sktm_plns', function (Blueprint $table) {
            $table->string('nip_ttd', 16)->nullable()->change();
        });
    }
};
