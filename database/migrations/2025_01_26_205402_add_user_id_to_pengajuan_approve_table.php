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
        Schema::table('Pengajuan_approved', function (Blueprint $table) {
            // Tambahkan kolom user_id
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Letakkan setelah kolom 'id'

            // Tambahkan foreign key ke tabel users
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('Pengajuan_approved', function (Blueprint $table) {
            // Hapus foreign key dan kolom user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
