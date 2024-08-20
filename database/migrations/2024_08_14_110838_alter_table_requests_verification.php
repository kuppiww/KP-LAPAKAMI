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
        if (Schema::hasColumn('user_id_kec')){
            Schema::table('requests_verifications', function(Blueprint $table) {
                $table->renameColumn('user_id_kec', 'user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_id')){ 
            Schema::table('requests_verifications', function(Blueprint $table) {
                $table->renameColumn('user_id', 'user_id_kec');
            });
        }
    }
};
