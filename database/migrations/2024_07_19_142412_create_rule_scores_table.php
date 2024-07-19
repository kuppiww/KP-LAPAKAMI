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
        Schema::create('rule_scores', function (Blueprint $table) {
            $table->string('rule_score_id')->primary();
            $table->integer('rule_score');
            $table->string('description')->nullable();
            $table->integer('rule_score_position')->nullable();
            $table->string('user_score')->nullable();
            $table->text('user_score_description')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable();

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
        Schema::dropIfExists('rule_scores');
    }
};
