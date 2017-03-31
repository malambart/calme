<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('plan_id')->unsigned();
            $table->string('medicament');
            $table->string('posologie')->nullable();
            $table->string('actuel_traitement');
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
        Schema::dropIfExists('pharmacos');
    }
}
