<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impressions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('diagnostic');
            $table->string('confirme')->nullable();
            $table->integer('score_severite')->nullable();
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
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
        Schema::dropIfExists('impressions');
    }
}
