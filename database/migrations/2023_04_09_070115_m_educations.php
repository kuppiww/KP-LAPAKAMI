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
        Schema::create('m_educations', function (Blueprint $table) {
            $table->bigIncrements('id_education');
            $table->string('education', 50);
            $table->dateTime('created_at');
            $table->bigInteger('created_by');
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('created_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('no action');

            $table->foreign('updated_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('no action');

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
        Schema::dropIfExists('m_educations');
    }
};
